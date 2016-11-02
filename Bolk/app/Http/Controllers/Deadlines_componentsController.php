<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Component;

class Deadlines_componentsController extends Controller
{
    public function index() {
    	$components = Component::all();
    	return view('/deadlines_components',['components'=>$components]);
    }
}
