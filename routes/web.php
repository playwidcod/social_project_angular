<?php

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
Auth::routes();

Route::get('/', function () {
    return view('home');
})->middleware('ck_session1');

Route::get('/display', function () {
    return view('display');
});

Route::get('/register', function () {
    $test = "test";//DB::table('users')->get();
    return view('register',['test' => $test]);                              
});     

Route::get('/create', function () {
    return view('create');                      
});

Route::get('/login', function () {
   return view('login'); 
})->middleware('ck_session');

Route::get('/editpro', function () {
    return view('editpro');                             
})->middleware('ck_session1');

Route::get('/changepass', function () {
    return view('changepass');                              
})->middleware('ck_session1');

Route::get('/post', function () {
    return view('user_posts');                
})->middleware('ck_session1');

Route::get('/find_friends', function () {
    return view('find_friends');               
})->middleware('ck_session1');

Route::get('/profile', function () {
    return view('profile');           
})->middleware('ck_session1');

Route::get('/search', function () {
    return view('searchbox/search');           
})->middleware('ck_session1');



Route::get('/login/facebook','Auth\LoginController@redirectToProvider');
            // ->where('social','facebook|twitter|linkedin|google|github|yahoo');

Route::get('/facebook/callback','Auth\LoginController@HandleProviderCallback');
            // ->where('social','facebook|twitter|linkedin|google|github|yahoo');
// Route::get('/testing', 'Registercontroller@testing')->middleware('ck_session1');




// Route::post('/lk_cnt', 'Registercontroller@lk_cnt')->middleware('ck_session1');
// Route::post('/like_status', 'Registercontroller@like_status')->middleware('ck_session1');
// Route::post('/liked_person', 'Registercontroller@liked_person')->middleware('ck_session1');

//angular
Route::get('/bas', function () {
    return view('testing/basics');           
});
//angular




// register and authorization controller registercontroller


// all main page controller
Route::get('/home', 'indexcontroller@home')->middleware('ck_session1');
Route::post('/updatepro', 'indexcontroller@edit')->middleware('ck_session1'); 
Route::post('/getstatus', 'indexcontroller@getstatus')->middleware('ck_session1');


// sub controller
Route::post('/deletepost', 'subcontroller@deletepost')->middleware('ck_session1');
Route::post('/upd_post', 'subcontroller@upd_post')->middleware('ck_session1');
Route::get('/profile_dat', 'subcontroller@profile')->middleware('ck_session1');
Route::post('/changepwd', 'subcontroller@changeoldpwd')->middleware('ck_session1'); 

//social status
Route::post('/like', 'upload_status@user_like')->middleware('ck_session1');
Route::post('/comments_viewable', 'upload_status@comments_viewable')->middleware('ck_session1');
Route::post('/comments_viewable_opt', 'upload_status@comments_viewable_opt')->middleware('ck_session1');
Route::post('/comment', 'upload_status@user_comment')->middleware('ck_session1');
Route::post('/view_oldr_cmts', 'upload_status@view_oldr_cmts')->middleware('ck_session1');
Route::post('/view_oldr_cmts_opt', 'upload_status@view_oldr_cmts_opt')->middleware('ck_session1');
Route::post('/deletecomment', 'upload_status@deletecomment')->middleware('ck_session1');

//home controller
Route::get('/test', 'HomeController@show')->middleware('ck_session1');  
Route::post('/store', 'HomeController@store')->middleware('ck_session');
Route::post('/ck_login', 'HomeController@login_ck');  
Route::get('/logout', 'HomeController@logout');


//freindship controller status
Route::post('/reqstatus_get', 'friendship_status@reqstatus_get')->middleware('ck_session1');
Route::post('/accept', 'friendship_status@accept')->middleware('ck_session1');
Route::post('/remove_user', 'friendship_status@remove')->middleware('ck_session1');
Route::post('/reqstatus', 'friendship_status@reqstatus')->middleware('ck_session1');
Route::post('/request', 'friendship_status@request')->middleware('ck_session1');

// fileController
Route::post('/user_post', 'fileController@user_post')->middleware('ck_session1');
Route::get('/testing', 'fileController@testing')->middleware('ck_session1');


//check_online controller
Route::get('/check_online', 'check_online@check_status_friends')->middleware('ck_session1');


//messege_controller
Route::post('/messege', 'messege_controller@messege')->middleware('ck_session1');
Route::post('/get_chats', 'messege_controller@get_chats')->middleware('ck_session1');


//search controller
Route::post('/on_search', 'search_items@posts_on_search')->middleware('ck_session1');
