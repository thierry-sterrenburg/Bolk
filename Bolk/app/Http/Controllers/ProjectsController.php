<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use DB;

class ProjectsController extends Controller
{
   public function index(){
	$projects = Project::all();
	return view('modal', ['projects' => $projects]);
   }
   public function newProject(Request $request){
	   if($request->ajax()){
		   $project=Project::create($request->all());
		   return response()->json($project);
	   }
   }
	
}
