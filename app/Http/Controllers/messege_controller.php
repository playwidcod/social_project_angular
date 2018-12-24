<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\larav_model;
use \App\friendships;
use \App\user_likes_comments;
use \App\user_comments;
use \App\posts_model;
use \App\check_online_model;
use \App\chats;
use DB;
use Validator;
use Auth;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class messege_controller extends Controller
{
    public function messege(Request $request){
    	$data = array(
    		'user_id'=>Auth::user()->id,
    		'friend_id'=>$request->frdid,
    		'user_chat'=>$request->mesge
    	);
    	chats::insert($data);
    }

    public function get_chats(Request $request){
    	$data = array(
    		'friend_id'=>$request->frdid,
    		'user_id'=>Auth::user()->id
    	);
    	$chats = DB::table('chat_details')->where($data)->get();
    	$data1 = array(
    		'user_id'=>$request->frdid,
    		'friend_id'=>Auth::user()->id
    	);
    	$chats1 = DB::table('chat_details')->where($data1)->get();
    	
    	$arr = json_decode($chats);
    	$arr1 = json_decode($chats1);
    	$main = array_merge($arr,$arr1);
    	echo json_encode($main);
    }
}
