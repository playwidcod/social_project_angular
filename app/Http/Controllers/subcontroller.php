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
class subcontroller extends Controller
{
   public function upd_post(Request $request){
    $data = array(
      'title'=>$request->title,
      'description'=>$request->description
    );
    DB::table('posts')->where(['id'=>$request->id])->update($data);
  }
   public function deletepost(Request $request){
    $data = array(
      'id' => $request->user_post
    );
    DB::table('posts')->where($data)->delete();
     unlink("file:///home/bsetec/Downloads/htdocs/blog/storage/app/public/downloads/videofolder/".$request->src.".mp4");
     unlink("file:///home/bsetec/Downloads/htdocs/blog/storage/app/public/downloads/thumbnail/".$request->src.".jpg");
  }
    public function profile(){
    $test = DB::table('posts')
    ->select('posts.id','email','title','post_vdo','description')
    // ->join('likes','posts.id','=','likes.post_id')
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
  public function changeoldpwd(Request $request){
     // $user = Auth::User();
   	$data['email'] = session()->get('email');
    $data['password'] = $request->current;
    $data['new'] = $request->new;
    $current_password = auth::user()->password;                                                                             
     if(Hash::check($data['password'], $current_password)){  
        DB::table('users')->where('email',$data['email'])->update(['password' => bcrypt($data['new'])]);
        session()->flush();
        return redirect('/login');
      }else{  
        return back()->with('error','current password is wrong');
      }                                                                                                                
   }
}
