<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Windmill;
use DB;

class ProjectController extends Controller
{
    public function index($id){
	$windmills = Windmill::where('projectid','=', $id)->get();
	return view('/project', ['windmills' => $windmills]);
	}
}