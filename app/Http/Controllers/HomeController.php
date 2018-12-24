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
class HomeController extends Controller
{
    public function show(){
        return DB::table('users')->select('name','datee','gender','phone','profile_pic','email')->where('email', session()->get('email'))->get();
    }
    public function store(Request $request){

    $this->validate($request,[
            'username' => 'required',
            'gender' => 'required',
            'datee' => 'required|date',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required|numeric'
        ]); 
      $data = new larav_model();
    $data->name = $request->username;
    $data->datee = $request->datee;
    $data->gender = $request->gender;
    $data->email = $request->email;
    $data->password =bcrypt($request->password);
    $data->phone = $request->phone;
    $image = $request->profile_pic;
    $data->profile_pic = "default.jpg";
    $data->catagories = $request->catagories;
    $data->terms = $request->terms;
    $data->save();
    $credentials = array(
    'email' => $request->email,
    'password' => $request->password
    );
    if(Auth::attempt($credentials)){
      $request->session()->put('email',Auth::user()->email);
      $request->session()->put('id',Auth::user()->id);
      check_online_model::insert(['user_id'=>Auth::user()->id,'status'=>'active']);
      return redirect('/');
    }
   }

   public function login_ck(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]); 
        $data = array(
          'email' => $request->email,
           'password' => $request->password
        );
       if(Auth::attempt($data)){
         $request->session()->put('email',Auth::user()->email);
         $request->session()->put('id',Auth::user()->id);
         $ck_online_status = check_online_model::where(['user_id'=>Auth::user()->id])->count();
         if($ck_online_status == '1'){
          check_online_model::where(['user_id'=>Auth::user()->id])->update(['status'=>'active']);
         }else{
          check_online_model::insert(['user_id'=>Auth::user()->id,'status'=>'active']);
         }
            return redirect('/');
       }else{
         return back()->with('error','wrong credential');
       }  
    }

   public function logout(Request $request){
      
      if ($request->session()->has('id')) {
        check_online_model::where(['user_id'=>Auth::user()->id])->update(['status'=>'offline']);
        session()->flush();
        return redirect('/login');
      }else{
        return redirect('/');
      }
   }  
}
