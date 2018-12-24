<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\larav_model;
use \App\friendships;
use \App\user_likes_comments;
use \App\user_comments;
use \App\posts_model;
use DB;
use Validator;
use Auth;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class friendship_status extends Controller
{
    public function request(Request $request){
    $data = new friendships();
    $data->requester = $request->requester;
    $data->user_requested = $request->user_requested;
    $data->status = '0';
    $data->save();
  }

   public function reqstatus(Request $request){
    return DB::table('friendships')->select('requester','status','profile_pic','name')
    ->join('users','friendships.requester','=','users.id')
    ->where(['user_requested'=>$request->sesid,'status'=>'0'])
    ->get();
  }

   public function reqstatus_get(Request $request){
    return DB::table('friendships')
    ->select('user_requested','status')
    ->where(['requester'=>$request->usr,'status'=>'0'])
    ->get();
  }

  public function accept(Request $request){
    DB::table('friendships')->where('requester', $request->accept_usr)->update(['status'=>'1']);
  }
  
  public function remove(Request $request){
    $data = array(
      'requester'=> $request->delete_usr,
      'user_requested' => $request->sesid
    );
    DB::table('friendships')->where($data)->delete();
  }
}
