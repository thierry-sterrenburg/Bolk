<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Windmill;
use App\Component;
use App\Transport;
use DB;

class ProjectsController extends Controller
{
   public function index(){
	$projects = Project::all();
	return view('projects', ['projects' => $projects]);
   }

   public static function countWindmills($projectid) {
   	$numberofwindmills = Windmill::where('projectid', '=', $projectid)->count();
   	return $numberofwindmills;
   }

   public static function countComponents($projectid) {
   	$numberofcomponents = Component::where('projectid', '=', $projectid)->count();
   	return $numberofcomponents;
   }

   public static function countTransports($projectid) {
	$components = Component::where('projectid', '=', $projectid)->get();
	$numberoftransports = 0;
	foreach($components as $component) {
		$numberoftransports = $numberoftransports+Transport::where('componentid', '=', $component->id)->count();
	}
	return $numberoftransports;
   }

   public function newProject(Request $request){
	   if($request->ajax()){
		   $project = new Project();
		   $this->checkInput($project, $request);
		   $project->save();
		   //$project=Project::create($request->all());
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
		   $this->checkInput($project, $request);
		   //$project->regnumber=$request->regnumber;
		   //$project->name=$request->name;
		   //$project->location=$request->location;
		   //$project->startdate=$request->startdate;
		   //$project->enddate=$request->enddate;
		   //$project->remarks=$request->remarks;
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
   
   public function checkInput($project, $request){
		   if($request->regnumber == ''){
			   $project->regnumber=null;
		   }else{
			   $project->regnumber=$request->regnumber;
		   }
		   if($request->name == ''){
			   $project->name=null;
		   }else{
			   $project->name=$request->name;
		   }
		   if($request->location == ''){
			   $project->location=null;
		   }else{
			   $project->location=$request->location;
		   }
		   if($request->startdate == ''){
			   $project->startdate=null;
		   }else{
			   $project->startdate=$request->startdate;
		   }
		   if($request->enddate == ''){
			   $project->enddate=null;
		   }else{
			   $project->enddate=$request->enddate;
		   }
		   if($request->remarks == ''){
			   $project->remarks=null;
		   }else{
			   $project->remarks=$request->remarks;
		   }
	   return $project;
   }
}
