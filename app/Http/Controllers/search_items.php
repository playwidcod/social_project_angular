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

class search_items extends Controller
{
    public function posts_on_search(Request $request){
      $request->keyy;
      $request->search;
      $test = DB::table('posts')
    ->select('posts.id','email','title','post_vdo','description')
    // ->join('likes','posts.id','=','likes.post_id')
    ->where($request->keyy, 'like', '%'.$request->search.'%')
    ->where("posts.usr_id",session()->get('id'))
    ->get();

    $tests = array();
    foreach ($test as $key => $value) {
       $id = get_object_vars($value)['id'];
     $s = DB::table('likes')->select('user_like')->where(['post_id' => $id])->get();
        $s = json_decode(json_encode($s),True);
        foreach ($s as $key => $values) {
          $s = $values['user_like'];
        }
        // print_r($s);
        // exit;
       $fnl_wth_lk = get_object_vars($value);
       $fnl_wth_lk['likes'] = $s;
       array_push($tests, $fnl_wth_lk);
    } 
    echo json_encode($tests);
    }

}