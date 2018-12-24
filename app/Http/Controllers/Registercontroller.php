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
class Registercontroller extends Controller
{
  public function __construct()
  {
  	//$this->middleware('auth');
  }
   public function index(){
   	// return $id;
   	print_r("index");
   }

   public function create(){
   	view('create');
   }
   

  //  public function user_post(Request $request){

  //   $data = new larav_model();
  //   $data->email = session()->get('email');
  //   $data->title = $request->title;
  //   $data->description = $request->description;
  //   $video = $request->post_vdo->store('public/downloads');
  //   $video = explode("/",$video);
  //   $data->post_vdo = $video[2];
  //   $data->usr_id = Auth()->user()->id;
  //   DB::table('posts')->insert($data->toArray());
  //   return redirect('/profile');
  // }
  // public function request(Request $request){
  //   //friend status 0= pending, 1=accepted
    
  //   $data = new friendships();
  //   $data->requester = $request->requester;
  //   $data->user_requested = $request->user_requested;
  //   $data->status = '0';
  //   $data->save();
  // }
//   public function reqstatus(Request $request){
// //show accept or remove
//     return DB::table('friendships')->select('requester','status','profile_pic','name')
//     ->join('users','friendships.requester','=','users.id')
//     ->where(['user_requested'=>$request->sesid,'status'=>'0'])
//     ->get();
//   }
//    public function reqstatus_get(Request $request){
//     return DB::table('friendships')
//     ->select('user_requested','status')
//     ->where(['requester'=>$request->usr,'status'=>'0'])
//     ->get();
//   }

//   public function accept(Request $request){
//     DB::table('friendships')->where('requester', $request->accept_usr)->update(['status'=>'1']);
//   }
//   public function remove(Request $request){
//     $data = array(
//       'requester'=> $request->delete_usr,
//       'user_requested' => $request->sesid
//     );
//     DB::table('friendships')->where($data)->delete();
//   }

  // public function user_like(Request $request){
  //     $count = DB::table('likes')->select('user_like')->where(['user_id'=>$request->user_id,'post_id'=>$request->post_id])->count();
  //     // print_r($count);exit;
  //     if($count > 0){ 
  //   $db = DB::table('likes')->select('user_like')->where(['user_id'=>$request->user_id,'post_id'=>$request->post_id])->get();

  //   foreach ($db as $key => $value) {
  //     $array = json_decode(json_encode($value), True);
  //     // print_r();
  //     if($array['user_like'] == '1'){
  //         echo "updated";
  //       $data = array(
  //         'user_like' => '0'
  //       );
  //       DB::table('likes')->where(['user_id'=>$request->user_id,'post_id'=>$request->post_id])->update($data);
  //     }
  //     if($array['user_like'] == '0'){
  //         echo "updated";
  //       $data = array(
  //         'user_like' => '1'
  //       );
  //       DB::table('likes')->where(['user_id'=>$request->user_id,'post_id'=>$request->post_id])->update($data);
  //     }
  //   }
  //   }
  //   if($count == '0'){
  //     // print_r("first like");
  //     $new = DB::table('likes')->where(['user_id'=>$request->user_id,'post_id'=>$request->post_id])->get();

  //     if(empty(json_decode(json_encode($new)))){
  //       $fs_lk_wn_cmt = new user_likes_comments;
  //       $fs_lk_wn_cmt->user_like = '1';
  //       $fs_lk_wn_cmt->user_id = $request->user_id;
  //       $fs_lk_wn_cmt->post_id = $request->post_id;
  //       $fs_lk_wn_cmt->save();
  //     }
  //   }   
  // }
  
  // public function view_oldr_cmts(Request $request){
  //   $data = array(
  //     'post_id'=>$request->post_id,
  //        );
  //   $db = DB::table('comments')
  //   ->select('name','profile_pic','user_comments','user_id','comments.id')
  //   ->join('users','comments.user_id','=','users.id')
  //   ->where($data)
  //   ->orderBy('id', 'desc')
  //   ->get();
  //   return $db;
  // }
  // public function lk_cnt(Request $request){
  //   $data = array(
  //     'post_id'=>$request->lk_ct, 
  //     'user_like' => '1'
  //        );
  //   $db = DB::table('likes')
  //   ->select('users.id','name','profile_pic')
  //   ->join('users','likes.user_id','=','users.id')
  //   ->where($data)
  //   ->get();
  //   print_r(count($db));
  // }
  // public function like_status(Request $request){
  //   $data = array(
  //     'post_id'=>$request->lk_ct, 
  //     'user_like' => '1',
  //     'user_id' => Auth::user()->id
  //        );
  //   $user_requested2 = DB::table('likes')
  //   ->select('post_id')
  //   ->where($data)
  //   ->get();
  //   echo json_encode($user_requested2);
  // }

  // public function comments_viewable(Request $request){
  //   $data = array(
  //     'post_id'=>$request->lk_ct
  //   );
  //   $db = DB::table('comments')
  //   ->select('user_comments','post_id','profile_pic','name','comments.id')
  //   ->join('users','comments.user_id','=','users.id')
  //   ->where($data)
  //    ->orderBy('id', 'desc')
  //   ->get();
  //   echo json_encode($db);
  // }
    
}

