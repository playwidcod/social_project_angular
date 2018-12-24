<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\larav_model;
use \App\friendships;
use \App\user_likes_comments;
use \App\user_comments;
use \App\posts_model;
use \App\check_online_model;
use DB;
use Validator;
use Auth;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class check_online extends Controller
{
    public function check_status_friends(){
    	$main = check_online_model::select('user_id','online_status.status','users.name','users.profile_pic')
    	->join('users','users.id','=','online_status.user_id')
    	->whereIn('online_status.user_id',function($q){
    		$q->select('user_requested')->from('friendships')->where(['requester'=>auth()->user()->id,'status'=>1]);
    	})
    	->where(['online_status.status'=>'active'])
    	->where('users.id','!=',Auth::user()->id)
    	->get();
    	$main1 = check_online_model::select('user_id','online_status.status','users.name','users.profile_pic')
    	->join('users','users.id','=','online_status.user_id')
    	->whereIn('online_status.user_id',function($q){
    		$q->select('requester')->from('friendships')->where(['user_requested'=>auth()->user()->id,'status'=>1]);
    	})
    	->where(['online_status.status'=>'active'])
    	->where('users.id','!=',Auth::user()->id)
    	->get();
    	$arr = json_decode($main);
    	$arr1 = json_decode($main1);
 		$jsonArray1 = array_merge($arr,$arr1);
 		echo json_encode($jsonArray1);
    }	
}
