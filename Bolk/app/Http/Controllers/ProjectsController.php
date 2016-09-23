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
   public function getUpdate(Request $request){
	  if ($request->ajax()){
		  $project=Project::find($request->id);
		  return Response($project);
	  }
   }
   public function newUpdate(Request $request){
	   if ($request->ajax()){
		   $project=Project::find($request->id);
		   $project->regnumber=$request->regnumber;
		   $project->name=$request->name;
		   $project->location=$request->location;
		   $project->startdate=$request->startdate;
		   $project->enddate=$request->enddate;
		   $project->remarks=$request->remarks;
		   $project->save();
		   return Response($project);
	   }
   }
   public function deleteProject(Request $request){
	   if ($request->ajax()){
		   Project::destroy($request->id);
		   return Response()->json(['sms'=>'delete successfully']);
	   }
   }
}
