<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Component;
use DP;

class WindmillController extends Controller
{
    public function index(){
    	$components = Component::all();
    	return view('windmill', ['components' => $components]);
    }
}
