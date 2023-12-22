<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Social media project routes
Route::view('register','auth.loginsignup');
Route::view('login','auth.login');
Route::get('dashboard',[UserProfileController::class,'gotoprofile']);
Route::post('insertdata',[UserProfileController::class,'insertdata'])->name('datainsert');
Route::post('logindata',[UserProfileController::class,'validatelogindata'])->name('validatelogin');
Route::post('updatedata',[UserProfileController::class,'updatedata'])->name('update');
Route::get('posts',[UserProfileController::class,'gotopostspage'])->name('postpage');
Route::post('createpost',[UserProfileController::class,'createmypost'])->name('createpost');
Route::get('sendmelikes/{id}',[UserProfileController::class,'sendupdatedlikes']);
Route::get('getcomments/{id}',[UserProfileController::class,'showpostcomments']);
Route::post('newcomments/{id}',[UserProfileController::class,'insertnewcomment'])->name('newcomment');
Route::get('editpost/{id}',[UserProfileController::class,'editpost']);
Route::post('getmyupdatedpost',[UserProfileController::class,'updatemynewpost']);
Route::get('deletepost/{id}',[UserProfileController::class,'deletemypost']);
Route::get('sendrequest/{sender_name}/{sender_email}/{sender_img}/{receiver_email}',[UserProfileController::class,'updaterequestinDB']);
Route::get('requestaccept/{sender_name}/{sender_image}/{sender_email}',[UserProfileController::class,'acceptrequest']);
Route::get('requestreject/{sender_email}',[UserProfileController::class,'rejectrequest']);
Route::post('sendmymessage',[UserProfileController::class,'sendmessage'])->name('sendprivatemessage');
Route::post('sendreply',[UserProfileController::class,'sendmyreply'])->name('sendreply');
Route::get('logout',[UserProfileController::class,'logout'])->name('logout');
Route::get('deletemyaccount',[UserProfileController::class,'deleteaccount']);
Route::get('enteremail',[UserProfileController::class,'getemail']);
Route::post('validatemyemail',[UserProfileController::class,'validateemail']);
Route::get('newpassword/{token}/{id}',[UserProfileController::class,'changepdpage']);
Route::post('updatepassword',[UserProfileController::class,'updatepassword']);
Route::get('del_session_bday',[UserProfileController::class,'removebdaysession']);
Route::post("img_post",[UserProfileController::class,'postmyimage'])->name('postimage');


