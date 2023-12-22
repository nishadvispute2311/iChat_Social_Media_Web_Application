<!DOCTYPE html>
<html>
<head>
<title>Dpost {{$data->name}}'s Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{asset('/css/profile.css')}}">
<link rel="stylesheet" href="{{asset('/css/login_and_signup.css')}}">




<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
div.scroll {
            margin:4px, 4px;
            padding:4px;
            background-color: rgb(223, 233, 223);
            width: 730px;
            height: 700px;
            overflow-x: hidden;
            overflow-y: auto;
            text-align:justify;
        }
        .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      transition: 0.2s;
      width: 100%;
    }

    .card:hover {
      box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
    }

    .container {
      padding: 2px 16px;
    }
    div.scroll_request{
      margin: 4px, 4px;
      padding: 4px;
      background-color: rgb(223, 233, 223);
      width: 200px;
      height: 200px;
      overflow-x: hidden;
      overflow-y: auto;
      text-align: justify;
    }
</style>
</head>
<body class="w3-theme-l5">

<!-- Navbar -->
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="dashboard" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-users w3-margin-right"></i>iChat</a>
  <a href="{{route('postpage')}}" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Posts"><i class="fa fa-newspaper-o"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>

  <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-button w3-padding-large"><i class="fa fa-bell"></i><span class="w3-badge w3-right w3-small w3-green">{{count($allmyrequest)}}</span></button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
      <ul class="list-group list-group-flush">
        @foreach ($allmyrequest as $req)
        
          <li class="list-group-item ">
            <span><img src="{{asset('social_media_dp')}}/{{$req->sender_image}}" style="width:40px;height: 40px;" class="w3-left w3-circle w3-margin-right"></span>
            <span><h6><em>{{$req->sender_name}} has sent you friend request</em></h6></span>
        </li>
        @endforeach
        
      </ul>
    </div>
  </div>

  {{-- Account Settings --}}
  <div class="w3-dropdown-hover w3-hide-small">
    <button class="w3-button w3-padding-large"><i class="fa fa-user"></i></button>     
    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
      <a href="#" class="w3-bar-item w3-button" data-bs-toggle="modal" data-bs-target="#modelId"><i class="fa fa-pencil"></i> Edit Profile</a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user-times"></i> Delete Account</a>
      <a href="logout" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i> Logout</a>
    </div>
  </div>
  
  <a href="{{route('logout')}}" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Logout">
    <img src="{{asset('social_media_dp')}}/{{$data->image}}" class="w3-circle" style="height:23px;width:23px" alt="Avatar">
  </a>
  
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">

      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
         <h4 class="w3-center">Welcome! {{$data->name}}</h4>
         <p class="w3-center"><img src="{{asset('social_media_dp')}}/{{$data->image}}" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
         <hr>
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> {{$data->occupation}}</p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> {{$data->country}}</p>
         <p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i> {{$data->email}}</p>
        </div>
      </div>
      {{-- Profile End --}}
      <br>
      
      <!-- Accordion -->
      <div class="w3-card w3-round">
        <div class="w3-white">
          <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa fa-group fa-fw w3-margin-right"></i> My Friends<span
            class="w3-badge w3-right w3-small w3-black">{{count($allmyfriends)}}</span></button>
          <div id="Demo1" class="w3-hide w3-container">
            <ul class="list-group list-group-flush">
              @if (count($allmyfriends)>0)
              @foreach ($allmyfriends as $friend)
              <li class="list-group-item ">
                  <span><img src="{{asset('social_media_dp')}}/{{$friend->frnds_image}}" style="width:40px;height: 40px;" class="w3-left w3-circle w3-margin-right"></span>
                  <span><h6><em>{{$friend->frnds_name}}</em></h6></span>
              </li>
              @endforeach
              @else
              <li class="list-group-item ">
                  <span><h6><em>Send requests to make friends</em></h6></span>
              </li>
              @endif
            </ul>
          </div>



          <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> My Events</button>
          <div id="Demo2" class="w3-hide w3-container">
            <p>Some other text..</p>
          </div>
          <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> My Photos</button>
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
           <div class="w3-half">
             <img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
           <div class="w3-half">
             <img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
           </div>
         </div>
          </div>
        </div>      
      </div>
      <br>
      
      <!-- Interests --> 
      <div class="w3-card w3-round w3-black w3-hide-small">
        <div class="w3-container" style="height: 300px;">
          <center>
            <h4><b>Suggestions</b></h4>
          </center><br>
          <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="card" style="color: black">
                  <center><img src="{{asset('social_media_dp')}}/Nishad_1657605803.jpg" alt="Avatar" width="100px"
                      height="100px"></center>
                  <br>
                  <center>
                    <p>Nirupam Gangurde</p>
                    <button type="submit" class="w3-button w3-theme">Send Request</button>
                  </center><br>

                </div>
              </div>

              @foreach ($allusers as $user)
              @if ($user->user_name != $data->name)
              <div class="carousel-item">
                <div class="card" style="color: black">
                  <center><img src="{{asset('social_media_dp')}}/{{$user->image}}" class="rounded-circle" alt="Avatar"
                      width="100px" height="100px"></center>
                  <br>
                  <center>
                    <p>{{$user->user_name}}</p>
                    <button type="button" onclick="sendmyrequest({{$user->id}},'{{$data->name}}','{{$data->email}}','{{$data->image}}','{{$user->smuser_id}}')"  class="w3-button w3-theme requestbtn{{$user->id}}">Send Request</button>
                  </center><br>
                </div>
              </div>
              @endif
              @endforeach

              <script>
                function sendmyrequest(id,s_name,s_email,s_img,rec_email){
                      console.log(id)
                      $.get("sendrequest/"+s_name+'/'+s_email+'/'+s_img+'/'+rec_email,function(response){
                        console.log(response);
                        if(!(response.status == 1)){
                            $(".requestbtn"+id).text("Request Sent");
                        }
                        else{
                          $(".requestbtn"+id).text(response.message);
                        }
                  }); 
                }
              </script>


            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
              data-bs-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="color: black"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
              data-bs-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="color: black"></span>
              {{-- <i class="fa fa-sign-out"> --}}
                <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>
      <br>

      {{-- --------------------------------------------------------------------------------- --}}
      {{-- Weather section --}}
      <div
          class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border " style="background-image: url('data:image/jpeg;base64,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');background-size: cover;">
          
           
          
          <div>
            <div class="d-flex">
              <h5 class="flex-grow-1"><b>{{$weather['location']['name']}}</b></h5>
              <h6><b>{{$weather['location']['localtime']}}</b></h6>
            </div>

            <div class="d-flex flex-column text-center mt-5 mb-4">
              <h6 class="display-4 mb-0 font-weight-bold" style="color: #1C2331;"> {{$weather['current']['temp_c']}}°C </h6>
              <span class="small" style="color: #050505"><h5>{{$weather['current']['condition']['text']}}</h5></span>
            </div>

            
            <div class="d-flex align-items-center">
              <div class="flex-grow-1" style="font-size: 1rem;">
                <div><i class="fas fa-wind fa-fw" style="color: #080809;"></i> <span class="ms-1"> {{$weather['current']['wind_kph']}} km/h
                  </span></div>
                <div><i class="fas fa-tint fa-fw" style="color: #0a0a0a;"></i> <span class="ms-1"> {{$weather['current']['humidity']}}% </span>
                </div>
                <div><i class="fas fa-sun fa-fw" style="color: #000309;"></i> <span class="ms-1"> {{$weather['current']['wind_mph']}}h </span>
                </div>
              </div>
              <div>
                <img src="{{$weather['current']['condition']['icon']}}"
                  width="60px" height="60px" style="border-radius: 50%;box-shadow: 0px 6px 5px rgb(5, 5, 5);">
              </div>
            </div>
          </div>
          
        </div>
      {{-- Weather section ends --}}
      {{-- --------------------------------------------------------------------------------- --}}
      
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
  
    <div class="w3-col m6">

      <div class="w3-row-padding">
        <div class="w3-col m10">
          <div class="w3-card w3-round w3-white" style="width:650px">
            <div class="w3-container w3-padding">
        <div class="panel-body bio-graph-info">
            
          <center><h1 style="color:black;"><b>Posts</b></h1></center>        
       </div>
        <div class="wrapper1 rounded bg-white scroll" style="width:100%">

          {{-- POSTS WITH COMMENTS SECTION --}}
          @foreach ($allpost as $post)
          {{-- Post creation --}}
          <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
            <img src="{{asset('social_media_dp')}}/{{$post->image}}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px;height:50px;">
            <span class="w3-right w3-opacity">{{$post->time}}</span>
            <h4>{{$post->name}}</h4><br>
            <hr class="w3-clear">
            <p>{{$post->post}}</p>
            <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom" onclick="updatelikes({{$post->id}})"><i class="fa fa-thumbs-up"></i><span class="w3-badge w3-right w3-small w3-green" id="mylikes{{$post->id}}">{{$post->likes}}</span></button>
            <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom commentsbtn{{$post->id}}" onclick="comsec({{$post->id}})"><i class="fa fa-comment"></i></button>
            {{-- Comments section starts --}}
            <div class="panel-body bio-graph-info comments{{$post->id}}" id="comments{{$post->id}}" style="display:none;">

              <hr class="w3-clear">
              <form action="newcomments/{{$post->id}}" method="post">
              @csrf
              <div class="d-flex flex-row bd-highlight mb-3">
                <div><img class src="{{asset('social_media_dp')}}/{{$data->image}}" alt="Avatar"  class="w3-left w3-circle w3-margin-right" style="width:60px;height:50px;border-radius: 50%;"></div>
                <div class="p-2 bd-highlight"><input type="text" class="form-control" name="my_new_comment" id="" aria-describedby="helpId" placeholder="Write your comment"></div>
                <div class="p-2 bd-highlight"><button type="submit" class="w3-button w3-theme-d2 w3-margin-bottom" id="comment_ok"><i class="fa fa-check"></i></button></div>
              </div>
            </form>
              <hr class="w3-clear">


              <div id="mycomments{{$post->id}}">
              
              </div>
  
          </div>
          {{-- Comments section ends --}}

          {{-- Post creation ends --}}

          {{-- ------------------------------------------------------------------------------------------------------------------------------------- --}}

          {{-- Comments section starts --}}

          {{-- <div class="panel-body bio-graph-info comments{{$post->id}}" id="comments{{$post->id}}" style="display:none;">

            <hr class="w3-clear">
            <div class="d-flex flex-row bd-highlight mb-2">
              <div><img class src="https://media.istockphoto.com/photos/path-through-sunlit-forest-picture-id1205214235?k=20&m=1205214235&s=612x612&w=0&h=TUNxmXOyHZ67rtPr8u9kmpn5lQAp9E-oMA2LfEshiu0=" alt="Avatar"  class="w3-left w3-circle w3-margin-right" style="width:60px;border-radius: 50%;"></div>
              <div class="p-2 bd-highlight"><input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Write your comment" value="{{$post->id}}"></div>
              <div class="p-2 bd-highlight"><button type="button" class="w3-button w3-theme-d2 w3-margin-bottom" id="commentbtn"><i class="fa fa-check"></i></button></div>
            </div> --}}

            {{-- <div class="d-flex flex-row bd-highlight mb-2">
              <div><img class src="" style="width:60px;border-radius: 50%;"></div>
              <div class="p-2 bd-highlight">
                    <div class="d-flex flex-column bd-highlight mb-3">
                      <div class="p-2 bd-highlight" style="color: black;"><h6>Kunal Chaudhary</h6></div>
                      <div class="p-2 bd-highlight">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo nostrum blanditiis a accusantium magni eveniet cumque officia, recusandae obcaecati. Aliquam!</div>
                    </div>
              </div>
            </div>

            <div class="d-flex flex-row bd-highlight mb-2">
              <div><img class src="" style="width:60px;border-radius: 50%;"></div>
              <div class="p-2 bd-highlight">
                    <div class="d-flex flex-column bd-highlight mb-3">
                      <div class="p-2 bd-highlight" style="color: black;"><h6>Kunal Chaudhary</h6></div>
                      <div class="p-2 bd-highlight">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo nostrum blanditiis a accusantium magni eveniet cumque officia, recusandae obcaecati. Aliquam!</div>
                    </div>
              </div>
            </div> --}}

          </div>
{{-- 
  comment: "This is the comment"
comments_id: 1
id: 28
image: "Swapnil_1657773006.jpg"
image_of_commenter: "Nishad Vispute_1657693763.jpg"
likes: 12
name: "Swapnil"
name_of_commenter: "Nishad"
post: "What a lovely day it is today......#14/7/22"
post_id: 28
smuser_id: 18
time: "2022-07-14 04:31:34"
time_of_comment: "12-22-37" --}}
{{-- 
  <div class="d-flex flex-row bd-highlight mb-2 maincom">
                <div><img src="" style="width:60px;border-radius: 50%;" id="image_of_commenter"></div>
                <div class="p-2 bd-highlight">
                      <div class="d-flex flex-column bd-highlight mb-3">
                        <div class="p-2 bd-highlight" style="color: black;"><h6 id="name_of_commenter">Kunal Chaudhary</h6></div>
                        <div class="p-2 bd-highlight" id="comment_to_post">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo nostrum blanditiis a accusantium magni eveniet cumque officia, recusandae obcaecati. Aliquam!</div>
                      </div>
                </div>
                <div class="p-2 bd-highlight">ddd</div>
              </div>
  --}}
  {{-- $("#image_of_commenter").attr('src',base_url+'/social_media_dp/'+value_of_comments.image_of_commenter); --}}
          <script>
            function comsec(id){
              // e.preventDefault();
              $.get('getcomments/'+id,function(response,e){
                // e.preventDefault();
                console.log(response.comments.length);
                console.log(response);
                
                var base_url = {!! json_encode(url('/')) !!};
                console.log(base_url);
                var comment_div = $("#mycomments"+id);
                if ($('.maincom_'+id).length){
                    console.log('comments already present');
                }else{
                  console.log("in else block");
                  $.each(response.comments, function (key_of_comments, value_of_comments){ 
                    let flexR = document.createElement('div');
                    flexR.className="d-flex flex-row bd-highlight mb-2 maincom_"+id;
                    comment_div.append(flexR);
                    console.log("flexR created");

                    


                    let imgdiv=document.createElement('div'); //#
                    flexR.append(imgdiv);
                    console.log("imgdiv created");


                    let imgtag=document.createElement('img');
                    imgtag.src=base_url+'/social_media_dp/'+value_of_comments.image_of_commenter;
                    imgtag.style.width="40px";
                    imgtag.style.height="40px";
                    imgtag.style.borderRadius="50%";
                    imgdiv.append(imgtag);
                    console.log("imgtag created");


                    let contentdiv=document.createElement('div');
                    contentdiv.className="p-2 bd-highlight"; //#
                    flexR.append(contentdiv);

                    let coldiv=document.createElement('div');
                    coldiv.className="d-flex flex-column bd-highlight mb-3";
                    contentdiv.append(coldiv);

                    let namediv=document.createElement('div');
                    namediv.className="p-2 bd-highlight";
                    namediv.style.color="black";
                    coldiv.append(namediv);
                    let cname=document.createElement('h6');
                    cname.textContent=value_of_comments.name_of_commenter;
                    namediv.append(cname);

                    let commentdiv=document.createElement('div');
                    commentdiv.className="p-2 bd-highlight";
                    coldiv.append(commentdiv);
                    let comm=document.createElement('h6');
                    comm.textContent=value_of_comments.comment;
                    commentdiv.append(comm);

                    // let timediv=document.createElement('div');
                    // timediv.className="p-2 bd-highlight w3-right";
                    // timediv.textContent=value_of_comments.time_of_comment;
                    // flexR.append(timediv);






                });
              }
              });
              $(".comments"+id).toggle();
            }
          </script>

          {{-- Comments section ends --}}





          @endforeach
          {{-- POSTS WITH COMMENTS SECTION ENDS --}}
        </div>
    </div>
  </div>
</div>
</div>



      
      {{-- User Info --}}
      
      {{-- User Info End --}}
      
    <!-- End Middle Column -->
   
    </div>

 
    
    <!-- Right Column -->
    <div class="w3-col m2">


      {{-- ------------------------------------------------------------------------------------------------------ --}}
        {{-- News Section --}}
        <!-- <div class="w3-card w3-round w3-white w3-center" style="height: 355px">
          <div class="w3-container">
            <h6>Interesting News Feed</h6><br>

 
            {{-- ============================ --}}
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="card" style="width: 100%;">
                    <img src="https://images.wsj.net/im-585691/social" class="card-img-top" alt="...">
                    <div class="card-body">
                     
                      <div  style="max-height: 100px;overflow: auto;min-height: 100px;">
                        <p class="card-text" style="color: black">Yellen vows tough U.S. measures against countries abusing economic order - Reuters.com</p>
                      </div><br>
                      <a href="#" class="btn btn-primary">Read full article</a>
                    </div>
                  </div>
                </div>

                @foreach ($newsfeed['articles'] as $news)

                <div class="carousel-item">
                  <div class="card" style="width: 100%;">
                    <img src="{{$news['urlToImage']}}" class="card-img-top" alt="..." width="183.33px" height="94.16px">
                    <div class="card-body">
                      <div  style="max-height: 100px;overflow: auto;min-height: 100px;">
                        <p class="card-text text-wrap" style="color: black">{{$news['title']}}</p>
                      </div><br>
                      <a href="{{$news['url']}}" class="btn btn-primary" target="_blank">Read full article</a>
                    </div>
                  </div>
                </div>
                    
                @endforeach

                
              </div>
              
            </div>
            {{-- ============================ --}}


            
          </div>
        </div>
        <br> -->

        {{-- News Section ends--}}
        {{-- ------------------------------------------------------------------------------------------------------ --}}

        <!-- -------------------------------------------------------------------------------------------------------- -->
        <!-- Image Post Section -->
        <div class="w3-card w3-round w3-white w3-center" style="height: 763px;width: 340px">
        <div class="w3-container w3-padding">
        <div class="panel-body bio-graph-info">
            
            <center><h1 style="color:black;"><b>Image Feed</b></h1></center>        
         </div>
         <div class="wrapper1 rounded bg-white scroll" style="width:100%">

         @foreach ($allimgposts as $imgpost)
               <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                <img src="{{asset('social_media_dp')}}/{{$imgpost->user_image}}" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:40px;height:35px;">
                <!-- <span class="w3-right w3-opacity"></span> -->
                <p style="margin-bottom: 0rem;font-size: 17px;">{{$imgpost->name}}</p><br>
                <hr class="w3-clear" style="margin-top: 0;">
                <img src="{{asset('User_post_photos')}}/{{$imgpost->image_name}}" alt="Avatar" style="width:100%; margin-bottom: 10px;height: 300px;">
                <div>
                <p>{{$imgpost->caption}}</p>
                </div>            
              </div>
         @endforeach

          {{-- <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
            <img src="{{asset('social_media_dp')}}/Aditi Gunjal_1662666650.jpg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:40px;height:35px;">
            <!-- <span class="w3-right w3-opacity"></span> -->
            <p style="margin-bottom: 0rem;font-size: 17px;">Aditi Gunjal</p><br>
            <hr class="w3-clear" style="margin-top: 0;">
            <img src="{{asset('social_media_dp')}}/Aditi Gunjal_postImage_1663701289.jpg" alt="Avatar" style="width:100%; margin-bottom: 10px;height: 300px;">
            <div>
            <p>After a long time...Ganpati celebration at home...!!</p>
            </div>            
          </div> --}}

          {{-- <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
            <img src="{{asset('social_media_dp')}}/Aditi Gunjal_1662666650.jpg" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:40px;height:35px;">
            <!-- <span class="w3-right w3-opacity"></span> -->
            <p style="margin-bottom: 0rem;font-size: 17px;">Aditi Gunjal</p><br>
            <hr class="w3-clear" style="    margin-top: 0;">
            <img src="{{asset('social_media_dp')}}/Aditi Gunjal_postImage_1663701334.jpg" alt="Avatar" style="width:100%; margin-bottom: 10px;height: 300px;">
            <div>
            <!-- <p>After a long time...Ganpati celebration at home...!!</p> -->
            <p>With my dear besties..!!!</p>
            </div>            
          </div> --}}
          

        </div>
      </div>
        
          </div>

        <!-- Image Post Section Ends-->
        <!-- -------------------------------------------------------------------------------------------------------- -->

      
      
      {{-- ------------------------------------------------------------------------------------------------------ --}}
      {{-- FRIEND REQUEST SECTION --}}
      @if (count($allmyrequest)>0)
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container" style="height:250px;">
          <p>Friend Request</p>
          <div class="wrapper1 rounded bg-white scroll_request">
          @foreach ($allmyrequest as $request)
          {{-- @if ($request->progress != "accepted") --}}
          <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
          <center><img
            src="{{asset('social_media_dp')}}/{{$request->sender_image}}"
            alt="Avatar" style="width:50%"><br></center>
          <center><span>{{$request->sender_name}}</span></center>
          <div class="w3-row w3-opacity">
            <div class="w3-half">
              <a href="requestaccept/{{$request->sender_name}}/{{$request->sender_image}}/{{$request->sender_email}}"><button class="w3-button w3-block w3-green w3-section" id="request_accept" title="Accept"><i
                  class="fa fa-check"></i></button></a>
            </div>
            <div class="w3-half">
              <a href="requestreject/{{$request->sender_email}}"><button class="w3-button w3-block w3-red w3-section" id="request_reject" title="Decline"><i
                  class="fa fa-remove"></i></button></a>
            </div>
          </div>
      </div>
      {{-- @endif --}}
          @endforeach
      </div>
        </div>
      </div>
      @endif
      <br>
      {{-- FRIEND REQUEST SECTION ENDS--}}
      {{-- ------------------------------------------------------------------------------------------------------ --}}
      
      {{-- <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
        <p>ADS</p>
      </div>
      <br> --}}
      
      {{-- <div class="w3-card w3-round w3-white w3-padding-32 w3-center">
        <p><i class="fa fa-bug w3-xxlarge"></i></p>
      </div> --}}
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Edit Modal -->

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                {{-- Modal Body --}}
                <div class="wrapper1 rounded bg-white">

                    <div class="h3"><center><h3><b>Update profile</b></h3></center></div><br>
            
                    <form action="{{route('update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form">
                            <div class="row">
                                <div class="col-md-6 mt-md-0 mt-3">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$data->name}}">
                                    
                                </div>
                                <div class="col-md-6 mt-md-0 mt-3">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" value="{{$data->email}}" disabled>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-md-0 mt-3">
                                    <label>Birthday</label>
                                    <input type="date" class="form-control" name="birthdate" value="{{$data->birthday}}">
                                    
                                </div>
                                <div class="col-md-6 mt-md-0 mt-3">
                                    <label>Country</label>
                                    <input type="text" class="form-control" name="country" value="{{$data->country}}">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-md-0 mt-3">
                                    <label>Number</label>
                                    <input type="text" class="form-control" name="number" value="{{$data->number}}">
                                    
                                </div>
                                <div class="col-md-6 mt-md-0 mt-3">
                                    <label>Gender</label>
                                    <input type="text" class="form-control" name="gender" value="{{$data->gender}}">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-md-0 mt-3">
                                    <label>Occupation</label>
                                    <input type="text" class="form-control" name="occupation" value="{{$data->occupation}}">
                                    
                                </div>
                                <div class="col-md-6 mt-md-0 mt-3">
                                    <label>Hobby</label>
                                    <input type="text" class="form-control" name="hobby" value="{{$data->hobby}}">
                                    
                                </div>
                            </div>
                            <div class=" my-md-2 my-3">
                              <label>Bio</label>
                              <input type="text" class="form-control" name="bio" value="{{$data->bio}}">
                            </div>
                           
                            <div class=" my-md-2 my-3">
                                <label>Profile Photo</label>
                                <input type="file" class="form-control" name="primage">
                            </div>
                            <center><button class="btn btn-primary mt-3" type="submit">Submit</button></center>
                           
                        </div>
                    </form>
            
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Likes Increment --}}
<script>
  function updatelikes(id){
    console.log(id);
    $.get('sendmelikes/'+id,function(response){
      console.log(response);
      $("#mylikes"+id).text(response.like);
    });
  }
</script>

<script>
    var modelId = document.getElementById('modelId');

    modelId.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          let button = event.relatedTarget;
          // Extract info from data-bs-* attributes
          let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });
</script>




<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html> 
