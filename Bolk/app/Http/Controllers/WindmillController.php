<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Component;
use DP;

class WindmillController extends Controller
{
    public function index($id){
    	$components = Component::where('windmillid','=', $id)->get();
    	return view('/windmill', ['components' => $components]);
    }
}
