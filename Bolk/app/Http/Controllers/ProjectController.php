<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Windmill;
use DB;

class ProjectController extends Controller
{
    public function index(){
	$windmills = Windmill::all();
	return view('project', ['windmills' => $windmills]);
	}
}