<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\larav_model;
use \App\friendships;
use \App\user_likes_comments;
use \App\user_comments;
use \App\posts_model;
use \App\chats;
use DB;
use Validator;
use Auth;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
class indexcontroller extends Controller
{
   public function home(){
// DB::enableQueryLog();
    $user_requested = DB::table('posts')
    ->select('posts.id','posts.title','posts.description','posts.post_vdo','users.name','users.profile_pic')  
    ->join('users','posts.usr_id','=','users.id')
    ->join('friendships','posts.usr_id','=','friendships.user_requested')
    ->where('friendships.requester',auth::user()->id)
    ->where('friendships.status',1)
    ->get();
    $user_requested1 = DB::Table('posts')
    ->select('posts.id','posts.title','posts.description','posts.post_vdo','users.name','users.profile_pic') 
    ->join('users','posts.usr_id','=','users.id')
    ->join('friendships','posts.usr_id','=','friendships.requester')
    ->where('friendships.user_requested',auth::user()->id)
    ->where('friendships.status',1)
    ->get();

    $arr1 = json_decode($user_requested1);
    $arr = json_decode($user_requested);
    $jsonArray1 = array_merge($arr1,$arr);

 $post_id_arr['likes'] = array();
 $post_id_arr['total_comments'] = array();
    foreach ($jsonArray1 as $key => $value) {
      $value = get_object_vars($value);
      $dat = array(
        'post_id' => $value['id'],
        'user_like'=> '1'
      );

      $dat_cmt = array(
        'post_id' => $value['id']
      );

      $get_like = user_likes_comments::select('user_id','post_id','user_like')->where($dat)->get();
      $get_cmts['count'] = user_comments::select('user_id','post_id','user_comments')->where('post_id',$dat_cmt)->count();
      $get_cmts['post_id'] = $value['id'];
      array_push($post_id_arr['total_comments'],$get_cmts);
      $get_like = json_decode($get_like);
     foreach ($get_like as $key => $value) {
       $liked = get_object_vars($value); 
       array_push($post_id_arr['likes'],$liked);
     }
    }
    array_push($jsonArray1, $post_id_arr);
    return $jsonArray1;

      // dd(DB::getQueryLog());
   }
   public function edit(Request $request){
   	$data = new larav_model();
   	$data->datee = $request->datee;
   	$data->gender = $request->gender;
   	$data->email = $request->email;
   	$data->phone = $request->phone; 
    // print_r($data);exit;
    if($request->profile_pic){
      $file = $request->file('profile_pic');
      $extension = $file->getClientOriginalExtension();
      $image = time().'.'.$extension;
      $file->move(public_path()."/storage/downloads/",$image);
      // $image = explode(".",$image);
      $data->profile_pic = $image;
    }
   	DB::table('users')->where('id', Auth()->user()->id)->update($data->toArray());
    echo "Updated";
   	// return redirect('/editpro');
   }
     public function getstatus(Request $request){

    $new = DB::table('users')
      ->WhereNotIn('id',function($q){
        $q->select('requester')->from('friendships')->where('user_requested',auth()->user()->id);
      })
      ->WhereNotIn('id',function($q){
        $q->select('user_requested')->from('friendships')->where('requester',auth()->user()->id);
      })
      ->WhereNotIn('id',function($q){
        $q->select('id')->from('users')->where('id',auth()->user()->id);
      })
      ->select('name','id','profile_pic')
      ->orderBy('id','desc')
      ->offset($request->offset)
      ->limit($request->limit)
      ->get();
      foreach ($new as $key => $value) {
        $this_arr = get_object_vars($value);
        print_r("<table border='1' class='post li-item hide'  style='border-color:white;margin-left: 300px;'><tr><td style='padding:10px;width:67px;'>
          <img name='profile_pic' src='".URL('/')."/storage/downloads/".$this_arr['profile_pic']."' height='70' width='70'><div class='frdname' name='frdname'>".$this_arr['name']."</div>
          <input type='hidden' class='frdid' name='frdid' id='".$this_arr['id']."' value='".$this_arr['id']."'></td><td width='700' align='right'><button class='btn'>Send Request</button></td></tr></table>");
      }
  }
}
