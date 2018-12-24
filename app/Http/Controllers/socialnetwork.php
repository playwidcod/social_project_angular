<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class socialnetwork extends Controller
{
    public function first_api(){
    	$data = [
    		'name'=>'siva',
    		'city'=>'pondy'
    	];
    	return response()->json($data);
    }
}
