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

class fileController extends Controller
{
   public function user_post(Request $request){

    $this->validate($request, [
        'title' => 'required',
        'description' => 'required',
        'post_vdo' => 'required',
    ]);
    $data = new posts_model();
    $data->email = session()->get('email');
    $data->title = $request->title;
    $data->description = $request->description;
    $file = $request->file('post_vdo');
    $video = uniqid().".".$file->getClientOriginalExtension();
    $file->move(public_path()."/storage/downloads/videofolder/",$video);
    $video_arr = explode(".",$video);
    $vido_url = public_path()."/downloads/videofolder/".escapeshellcmd($video);
    $cmd = "ffmpeg -i $vido_url 2>&1";
    $second = 5;

    if (preg_match('/Duration: ((\d+):(\d+):(\d+))/s', `$cmd`, $time)) {
        $total = ($time[2] * 3600) + ($time[3] * 60) + $time[4];
        $second = rand(1, ($total - 1));
    }
    $image  = "/opt/lampp/htdocs/blog/public/storage/downloads/thumbnail/$video_arr[0].jpg";
    $cmdd = "ffmpeg -i /opt/lampp/htdocs/blog/public/storage/downloads/videofolder/$video -deinterlace -an -ss $second -t 00:00:01 -r 1 -y -vcodec mjpeg -f mjpeg $image 2>&1";
    exec($cmdd);

    if($video_arr['1'] !== "mp4"){
        clearstatcache(); 
        $exc_path = "ffmpeg -i /opt/lampp/htdocs/blog/public/storage/downloads/videofolder/".$video." -c copy /opt/lampp/htdocs/blog/public/storage/downloads/videofolder/".$video_arr[0].".mp4";
        exec($exc_path);
        unlink("file:///opt/lampp/htdocs/blog/public/storage/downloads/videofolder/".$video);
        $data->post_vdo = $video_arr[0].".mp4";
    }else{
        $data->post_vdo = $video;
    } 

    $data->usr_id = Auth()->user()->id;
    $data->save();
    $like_update = array(
                        'user_id' => Auth::user()->id,
                        'post_id' => $data->id,
                        'user_like' => 0
                    );
    user_likes_comments::insert($like_update);
    echo "success";
    // return redirect('/profile');
  }
}
