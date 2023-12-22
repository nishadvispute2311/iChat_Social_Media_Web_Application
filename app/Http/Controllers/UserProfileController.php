<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\SmUserModel;
use App\Models\PostModel;
use App\Models\CommentModel;
use App\Models\AllUsers;
use App\Models\RequestModel;
use App\Models\FriendsModel;
use App\Models\MessageModel;
use App\Models\ResetLinkModel;
use App\Models\BdayModel;
use App\Models\ImagePostModel;
use Hash;
use Session;

class UserProfileController extends Controller
{

    public function insertdata(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:smuser',
            'country'=>'required',
            'number'=>'required',
            'gender'=>'required',
            'occupation'=>'required',
            'hobby'=>'required',
            'birthdate'=>'required',
            'password'=>'required|min:5|max:12|confirmed'
        ]);

        $image = $request->file('primage');
        $imagename = $request->name.'_'.time().'.'.$image->extension();
        $image->move(public_path('social_media_dp'),$imagename);
        
        $data = new SmUserModel();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->number=$request->number;
        $data->country=$request->country;
        $data->gender=$request->gender;
        $data->occupation=$request->occupation;
        $data->hobby=$request->hobby;
        $data->birthday=$request->birthdate;
        $data->password=Hash::make($request->password);
        $data->image=$imagename;
        $data->save();

        $user = new AllUsers();
        $user->user_name=$request->name;
        $user->image=$imagename;
        $user->smuser_id=$request->email;
        $user->save();

        return redirect('login')->with('success','You have successfully registered!!');
        
    }

    public function validatelogindata(Request $request){
        $request->validate([
            'username'=>'required|email',
            'password'=>'required'
        ]);
        $user = SmUserModel::where('email','=',$request->username)->first();
        if($user){
            if(Hash::check($request->password,$user->password)){
                Session::put('loginid',$user->id);
                return redirect('dashboard');
            }else{
        return redirect('login')->with('fail','Password does not match!!');
                
            }
        }else{
            return redirect('login')->with('fail','This email is not registered!!');

        }
    }

    public function gotoprofile(){
        if(Session::has('loginid')){
            $data=SmUserModel::find(Session::get('loginid'));
            
            $id=Session::get('loginid');

            $userpostdata = SmUserModel::join(
                'posts',
                'posts.smuser_id','=','smuser.id'
            )->where('smuser.id', '=', $id)->orderBy('posts.id','DESC')->get([
                'posts.name',
                'posts.post',
                'posts.image',
                'posts.likes',
                'posts.time',
                'posts.id'
            ]);
            $allusers=AllUsers::all();
            $allmyrequest=SmUserModel::join(
                'requests',
                'requests.receiver_email','=','smuser.email'
            )->where('smuser.email','=',$data->email)->where('requests.progress','=','sent')->get();
            $allmyfriends=FriendsModel::where('user_email',$data->email)->get();
            
            $allmymessages=MessageModel::where('m_receiver_email',$data->email)->where('status','not_replied')->get();
           

            $newsfeed=Http::get('https://newsapi.org/v2/top-headlines?country=in&category=technology&apiKey=d7d00df6597748acbc6c16ce35dfdc56')->json();         
            $weather=Http::get('https://api.weatherapi.com/v1/current.json?key=d2489a8a2c8444e4b80115930221907&q='.$data->country.'&aqi=yes')->json();

            $birthdate=$data->birthday;
            $current_date=Carbon::now()->toDateString();
            $bdate=explode('-',$birthdate);
            $cdate=explode('-',$current_date);
            if($bdate[2]==$cdate[2] && $bdate[1]==$cdate[1]){
                Session::put('bdstatus',1);
                return view('dashboard1',compact(['data','userpostdata','allusers','allmyrequest','allmyfriends','newsfeed','weather','allmymessages']));
            }
            else{
                if(Session::has('bdstatus')){
                    Session::pull('bdstatus');
                }
                return view('dashboard1',compact(['data','userpostdata','allusers','allmyrequest','allmyfriends','newsfeed','weather','allmymessages']));
            }

        }
    }

    public function removebdaysession(){
        Session::pull('bdstatus');
        return response()->json([
            'message'=>'done'
        ]);
    }


    public function updatedata(Request $request){
        if(Session::has('loginid')){
            $mypostnameupdate = SmUserModel::join(
                'posts',
                'posts.smuser_id','=','smuser.id'
            )->where('smuser.id','=',Session::get('loginid'))->get([
                'posts.name',
                'posts.post',
                'posts.image',
                'posts.likes',
                'posts.time',
                'posts.id'
            ]);
            // return $mypostnameupdate;
            // die();
            if(!$request->has('primage')){
                $data = SmUserModel::find(Session::get('loginid'));
                $data->name=$request->name;
                $data->number=$request->number;
                $data->country=$request->country;
                $data->gender=$request->gender;
                $data->occupation=$request->occupation;
                $data->hobby=$request->hobby;
                $data->birthday=$request->birthdate;
                $data->bio=$request->bio;
                $data->save();

                // Updating all users data
                $getalluserdata=AllUsers::where('smuser_id',$data->email)->first();
                $updateallusersdata=AllUsers::find($getalluserdata->id);
                $updateallusersdata->user_name=$request->name;
                $updateallusersdata->save();

                // Updating comments data
                $getcommentsdata=CommentModel::where('email_of_commenter',$data->email)->get();
                foreach($getcommentsdata as $cdata){
                    $mycomment=CommentModel::find($cdata->id);
                    $mycomment->name_of_commenter=$data->name;
                    $mycomment->save();
                }

                // Updating posts data
                foreach($mypostnameupdate as $mypostdata){
                    $mydata=PostModel::find($mypostdata->id);
                    $mydata->name=$data->name;
                    $mydata->save();
                }

                // Updating friends data
                $getfriendsdata=FriendsModel::where('frnd_email',$data->email)->get();
                foreach($getfriendsdata as $mydata){
                    $updatefrnddata=FriendsModel::find($mydata->id);
                    $updatefrnddata->frnds_name=$data->name;
                    $updatefrnddata->save();
                }

                // Updating requests data
                $getrequestdata=RequestModel::where('sender_email',$data->email)->get();
                foreach($getrequestdata as $myrequests){
                    $mydata=RequestModel::find($myrequests->id);
                    $mydata->sender_name=$data->name;
                    $mydata->save();
                }
                
                
            }else{
                $image = $request->file('primage');
                $imagename = $request->name.'_'.time().'.'.$image->extension();
                $image->move(public_path('social_media_dp'),$imagename);

                $data = SmUserModel::find(Session::get('loginid'));
                $data->name=$request->name;
                $data->number=$request->number;
                $data->country=$request->country;
                $data->gender=$request->gender;
                $data->occupation=$request->occupation;
                $data->hobby=$request->hobby;
                $data->birthday=$request->birthdate;
                $data->bio=$request->bio;
                $data->image=$imagename;
                $data->save();

                // Updating all users data
                $getalluserdata=AllUsers::where('smuser_id',$data->email)->first();
                $updateallusersdata=AllUsers::find($getalluserdata->id);
                $updateallusersdata->user_name=$request->name;
                $updateallusersdata->image=$imagename;
                $updateallusersdata->save();

                // Updating comments data
                $getcommentsdata=CommentModel::where('email_of_commenter',$data->email)->get();
                foreach($getcommentsdata as $cdata){
                    $mycomment=CommentModel::find($cdata->id);
                    $mycomment->name_of_commenter=$data->name;
                    $mycomment->image_of_commenter=$imagename;
                    $mycomment->save();
                }

                // Updating posts data
                foreach($mypostnameupdate as $mypostdata){
                    $mydata=PostModel::find($mypostdata->id);
                    $mydata->name=$data->name;
                    $mydata->image=$imagename;
                    $mydata->save();
                }

                // Updating friends data
                $getfriendsdata=FriendsModel::where('frnd_email',$data->email)->get();
                foreach($getfriendsdata as $mydata){
                    $updatefrnddata=FriendsModel::find($mydata->id);
                    $updatefrnddata->frnds_name=$data->name;
                    $updatefrnddata->frnds_image=$imagename;
                    $updatefrnddata->save();
                }

                // Updating requests data
                $getrequestdata=RequestModel::where('sender_email',$data->email)->get();
                foreach($getrequestdata as $myrequests){
                    $mydata=RequestModel::find($myrequests->id);
                    $mydata->sender_name=$data->name;
                    $mydata->sender_image=$imagename;
                    $mydata->save();
                }
            }
            
            return redirect('dashboard');
        }
    }

    public function gotopostspage(){
        if(Session::has('loginid')){
            $data=$data = SmUserModel::find(Session::get('loginid'));
            $allpost = PostModel::orderBy('id','DESC')->get();
            $allusers=AllUsers::all();
            $allmyrequest=SmUserModel::join(
                'requests',
                'requests.receiver_email','=','smuser.email'
            )->where('smuser.email','=',$data->email)->where('requests.progress','=','sent')->get();

            $allimgposts=ImagePostModel::orderBy('id','DESC')->get();

            $allmyfriends=FriendsModel::where('user_email',$data->email)->get();

            // $newsfeed=Http::get('https://newsapi.org/v2/top-headlines?country=in&category=technology&apiKey=d7d00df6597748acbc6c16ce35dfdc56')->json();
            $newsfeed=Http::get('https://newsapi.org/v2/top-headlines?country=in&category=entertainment&apiKey=d7d00df6597748acbc6c16ce35dfdc56')->json();
            // https://newsapi.org/v2/top-headlines?country=in&category=entertainment&apiKey=d7d00df6597748acbc6c16ce35dfdc56
            
            $weather=Http::get('https://api.weatherapi.com/v1/current.json?key=d2489a8a2c8444e4b80115930221907&q='.$data->country.'&aqi=yes')->json();

            // return view('posts',compact(['data','allpost','allusers','allmyrequest','weather','newsfeed','allmyfriends']));
            return view('dpost',compact(['data','allpost','allusers','allmyrequest','weather','newsfeed','allmyfriends','allimgposts']));


        }
        
    }

    public function createmypost(Request $request){
        if($request->posts != ""){
            $current_date_time = date('Y-m-d H:i:s');
            if(Session::has('loginid')){
                $user = SmUserModel::find(Session::get('loginid'));
                $post = new PostModel();
                $post->name=$user->name;
                $post->post=$request->posts;
                $post->image=$user->image;
                $post->time=$current_date_time;
                $post->smuser_id=Session::get('loginid');
                $post->save();
                // return redirect('dashboard')->with('success','Post created successfully!');
                return redirect('dashboard')->with('success','Post created successfully!');
            }
        }else{
            // return redirect('dashboard1');
            return redirect('dashboard');

        }
        

    }

    public function insertnewcomment($id,Request $request){
        if(Session::has('loginid')){
            $user = SmUserModel::find(Session::get('loginid'));
            $comment=new CommentModel();
            $comment->name_of_commenter=$user->name;
            $comment->image_of_commenter=$user->image;
            $comment->email_of_commenter=$user->email;
            $comment->comment=$request->my_new_comment;
            $comment->time_of_comment=date('Y-m-d H:i:s');
            $comment->post_id=$id;
            $comment->save();
            return redirect('posts')->with('success','Comment added successfully..!!');
        }
    }

    public function sendupdatedlikes($id){
        $post_data = PostModel::find($id);
        $updated_like = $post_data->likes + 1;
        $post_data->likes=$updated_like;
        $post_data->save();
        // $updated_like = $post_data->likes;


        return response()->json([
            'message'=>'id received',
            'id'=>$id,
            'like'=>$post_data->likes
        ]);
    }

    public function userpostsondashboard(){
        $data = SmUserModel::join(
            'posts',
            'posts.smuser_id','=','smuser.id'
        )->get([
            'posts.id',
            'posts.name',
            'posts.post',
            'posts.image',
            'posts.likes',
            'posts.time'
        ]);
    
    }

    public function showpostcomments($id){
        $comments = PostModel::join(
            'comments',
            'comments.post_id','=','posts.id'
        )->where(
            'posts.id','=',$id
        )->orderBy('comments.id','DESC')->get();
        return response()->json([
            'comments'=>$comments,
            'message'=>'received'
        ]);
    }

    public function editpost($id){
        $mypost=PostModel::find($id);
        return response()->json([
                'id'=>$id,
                'message'=>'id received',
                'post'=> $mypost
        ]);
    }

    public function updatemynewpost(Request $request){
        $post=PostModel::find($request->id);
        $post->post=$request->mypost;
        $post->save();
        
        return redirect('dashboard')->with('success','Post Updated successfully');

    }

    public function deletemypost($id){
        $post=PostModel::find($id);
        $post->delete();
        
        return redirect('dashboard')->with('success','Post Deleted successfully');

    }

    public function updaterequestinDB($sender_name,$sender_email,$sender_img,$receiver_email){
        $checkrequest = RequestModel::where('receiver_email',$receiver_email)->where('sender_email',$sender_email)->get();
        
        if($checkrequest->count()>0){
            if($checkrequest[0]->progress == "accepted"){
                return response()->json([
                    'message'=>'Request is already Accepted',
                    'status'=>1
                ]);
            }else{
                return response()->json([
                    'message'=>'Request Already Sent',
                    'status'=>1
                ]);
            }
        }else{
            $newrequest=new RequestModel();
            $newrequest->sender_name=$sender_name;
            $newrequest->sender_image=$sender_img;
            $newrequest->receiver_email=$receiver_email;
            $newrequest->sender_email=$sender_email;
            $newrequest->status=1;
            $newrequest->save();
            return response()->json([
                'message'=>'request sent successfully',
            ]);
        }

    }

    public function acceptrequest($sender_name,$sender_img,$sender_email){
        $friend = new FriendsModel();
        if(Session::has('loginid')){
            $friend->user_name=SmUserModel::find(Session::get('loginid'))->name;
            $friend->frnds_name=$sender_name;
            $friend->frnds_image=$sender_img;
            $friend->user_email	=SmUserModel::find(Session::get('loginid'))->email;
            $friend->frnd_email=$sender_email;
            $friend->save();

            $request=RequestModel::where('receiver_email',SmUserModel::find(Session::get('loginid'))->email)->where('sender_email',$sender_email)->first();
            $id=$request->id;
            $progress=RequestModel::find($id);
            $progress->progress="accepted";
            $progress->save();
            
        }
        return redirect('dashboard')->with('success',$sender_name.' is successfully added as your friend');
    }

    public function rejectrequest($sender_email){
        if(Session::has('loginid')){
            $request=RequestModel::where('receiver_email',SmUserModel::find(Session::get('loginid'))->email)->where('sender_email',$sender_email)->delete();
        }
        return redirect('dashboard')->with('success','Request rejected successfully');
    }

    public function sendmessage(Request $request){
        if(Session::has('loginid')){
            $user=SmUserModel::find(Session::get('loginid'));
            $sender1_email=$user->email;
            $sender1_name=$user->name;
            $receiver_email = $request->reciever_email;
            $receiver_name = $request->reciever_name;
            $details = array(
                'messages'=>$request->message,
                'sender_name'=>$sender1_name
            );
            
            Mail::send('emails.sendmsg',$details, function($message) use ($receiver_email, $receiver_name, $sender1_name, $sender1_email){
                $message->to($receiver_email,$receiver_name)
                        ->replyto($sender1_email,$sender1_name)
                        ->subject($sender1_name.' just messaged you through iChat');
            });

            $msg_in_db = new MessageModel();
            $msg_in_db->m_sender_name=$sender1_name;
            $msg_in_db->m_sender_email=$sender1_email;
            $msg_in_db->m_sender_image=$user->image;
            $msg_in_db->m_receiver_name=$receiver_name;
            $msg_in_db->m_receiver_email=$receiver_email;
            $msg_in_db->all_message=$request->message;
            $msg_in_db->save();
            
            return redirect('dashboard')->with('success','Message sent successfully to '.$receiver_name);

        }
    }

    public function sendmyreply(Request $request){
        if(Session::has('loginid')){
            $user = SmUserModel::find(Session::get('loginid'));
            $reply_to_email = $request->receiver_email;
            $reply_to_name = $request->receiver_name;
            $reply_from_name = $user->name;
            $reply_from_email = $user->email;
            $msg = $request->msg;
            $reply=$request->reply;
            $data = array(
                'myreply'=>$reply,
                'reply_to_msg'=>$msg,
                'replied_by'=>$reply_from_name
            );
            
            Mail::send('emails.replymsg',
                        $data,
                        function($message) use ($reply_to_email,$reply_to_name,$reply_from_email,$reply_from_name,$msg){
                            $message->to($reply_to_email,$reply_to_name)
                                    ->replyTo($reply_from_email,$reply_from_name)
                                    ->subject($reply_from_name.' has replied to your message via iChat');
                        });

            $updatemsg = MessageModel::find($request->my_reply_id);
            $updatemsg->status="replied";
            $updatemsg->save();

            $addmessage = new MessageModel();
            $addmessage->m_sender_name=$reply_from_name;
            $addmessage->m_sender_email=$reply_from_email;
            $addmessage->m_sender_image=$user->image;
            $addmessage->m_receiver_name=$reply_to_name;
            $addmessage->m_receiver_email=$reply_to_email;
            $addmessage->all_message=$request->reply;
            $addmessage->save();

            return redirect('dashboard');


        }
    }

    public function deleteaccount(){
        $getallmypost = SmUserModel::join(
            'posts',
            'posts.smuser_id','=','smuser.id'
        )->where('smuser.id','=',Session::get('loginid'))->get([
            'posts.name',
            'posts.post',
            'posts.image',
            'posts.likes',
            'posts.time',
            'posts.id'
        ]);

        if(Session::has('loginid')){
            $data=SmUserModel::find(Session::get('loginid'));

            //delete comments data
            $getcomments=CommentModel::where('email_of_commenter',$data->email)->get();
            foreach($getcomments as $comm){
                $mycom=CommentModel::find($comm->id);
                $mycom->delete();
            }

            //delete posts data
            foreach($getallmypost as $mypost){
                $post=PostModel::find($mypost->id);
                $post->delete();
            }

            //delete in all users table
            $getallusersdata=AllUsers::where('smuser_id',$data->email)->first();
            if($getallusersdata){
                $getallusersdata->delete();
            }

            //delete requests data
            $getallrequests=RequestModel::where('sender_email',$data->email)->get();
            foreach ($getallrequests as $allreq) {
                $req=RequestModel::find($allreq->id);
                $req->delete();
            }

            $getsendrequests=RequestModel::where('receiver_email',$data->email)->get();
            foreach ($getsendrequests as $allreq) {
                $req=RequestModel::find($allreq->id);
                $req->delete();
            }

            // Delete all friends data
            $getfrndsdata=FriendsModel::where('frnd_email',$data->email)->get();
            $getmyfrndsdata=FriendsModel::where('user_email',$data->email)->get();
            foreach ($getfrndsdata as $myfrnd) {
                $frnd=FriendsModel::find($myfrnd->id);
                $frnd->delete();
            }

            foreach ($getmyfrndsdata as $myfrnd) {
                $frnd=FriendsModel::find($myfrnd->id);
                $frnd->delete();
            }

            //delete message data
            $getallsendmessages=MessageModel::where('m_sender_email',$data->email)->get();
            $getallreceivedmessages=MessageModel::where('m_receiver_email',$data->email)->get();
            foreach ($getallsendmessages as $smsg) {
                $msg=MessageModel::find($smsg->id);
                $msg->delete();
            }

            foreach ($getallreceivedmessages as $rmsg) {
                $msg=MessageModel::find($rmsg->id);
                $msg->delete();
            }
            
            //Delete the user
            $data->delete();
            
            
        }
        return redirect('login')->with('success','Your account is successfully deleted!!');
    }

    public function getemail(){
        return view('auth.enteremailforpdchange');
    }

    public function validateemail(Request $request){
        $request->validate([
            'email'=>'required'
        ]);
        $email=$request->email;
        $data=SmUserModel::where('email',$email)->first();
        if($data){
            $link_data=ResetLinkModel::where('user_email',$email)->first();
            $link_token=time();
            $link="http://localhost/ichat/public/newpassword/".$link_token."/".$data->id;
            $user_email=$data->email;
            $user_name=$data->name;

            $sendlink=array(
                    'name'=>$data->name,
                    'link'=>$link
            );

            Mail::send('emails.pdresetlink',
                        $sendlink,
                        function($message) use ($user_email,$user_name){
                        $message->to($user_email,$user_name)
                                ->subject("Password reset link from iChat");
                    }
            );
            if($link_data){
                $link_sent_time=date('Y-m-d H:i:s');
                $my_link_data=ResetLinkModel::find($link_data->id);
                $my_link_data->link=$link;
                $my_link_data->link_token=$link_token;
                $my_link_data->sent_time=$link_sent_time;
                $my_link_data->save();
            }else{
                $link_sent_time=date('Y-m-d H:i:s');
                $savelink= new ResetLinkModel();
                $savelink->user_email=$user_email;
                $savelink->link=$link;
                $savelink->link_token=$link_token;
                $savelink->sent_time=$link_sent_time;
                $savelink->save();
            }
            return redirect('enteremail')->with('success',"Password reset link sent successfully");
            
        }else{
            return redirect('enteremail')->with('fail',"This email is not registered");
        }
    }

    
    public function changepdpage($token,$id){
        $user_data = SmUserModel::find($id);
        $user_name = $user_data->name;
        $user_id=$id;
        $linkdata = ResetLinkModel::where('user_email',$user_data->email)->first();
        if($linkdata){
            if($linkdata->link_token == $token){
                $sent_time = Carbon::parse($linkdata->sent_time);
                $end_time = Carbon::parse(date('Y-m-d H:i:s'));
                $duration = $end_time->diffInSeconds($sent_time);
                if($duration<600){
                    return view('auth.enternewpd',compact('user_id'));
                }else{
                    return view('auth.linkexpirepage',compact('user_name'));
                }
            }else{
                return view('auth.invalidlink',compact('user_name'));
            }
        }else{
            return view('auth.invalidlink',compact('user_name'));
        }
    }

    public function updatepassword(Request $request){
        $request->validate([
                'password'=>'required|min:5|max:12|confirmed'
            ]);
            $data=SmUserModel::find($request->id);
            $data->password=Hash::make($request->password);
            $data->save();
            $link_data = ResetLinkModel::where('user_email',$data->email)->first();
            $get_data=ResetLinkModel::find($link_data->id)->delete();
            return redirect('login')->with('success','New password set successfully');
    
        
    }

    public function postmyimage(Request $request){
        if(Session::has('loginid')){
            $data=SmUserModel::find(Session::get('loginid'));
            $image = $request->file('postimg');
            $imagename = $data->name.'_postImage_'.time().'.'.$image->extension();
            $image->move(public_path('User_post_photos'),$imagename);
            $current_date_time = date('Y-m-d H:i:s');
            
            $post = new ImagePostModel();
            $post->name=$data->name;
            $post->user_image=$data->image;
            $post->email=$data->email;
            $post->caption=$request->caption;
            $post->image_name=$imagename;
            $post->time=$current_date_time;
            $post->save();
            return redirect('dashboard')->with('success','Your image is posted successfully');
        }
    }

    public function logout(){
        if(Session::has('loginid')){
            Session::pull('loginid');
            return redirect('login')->with('success','Logout Successfull');
        }
    }

    
}
