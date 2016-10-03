<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Windmill;
use App\Component;
use App\Transport;
use DB;

class ProjectController extends Controller
{
	
	public function index($id){
	$windmills = Windmill::where('projectid','=', $id)->get();
	$components = Component::where('projectid', '=', $id)->whereNull('windmillid')->get();
	$project = Project::where('id','=',$id)->first();
	return view('/project', ['windmills' => $windmills, 'components' => $components,  'project' => $project]);
	}

	public static function countComponents($windmillid) {
		$numberofcomponents = Component::where('windmillid', '=', $windmillid)->count();
		return $numberofcomponents;
	}

	public static function countTransports($componentid) {
		$numberoftransports = Transport::where('componentid', '=', $componentid)->count();
		return $numberoftransports;
	}
	
	public function newWindmill(Request $request){
	   if($request->ajax()){
		   $windmill = new Windmill();
		   $this->checkInput($windmill, $request);
		   $windmill->save();
		   return response()->json($windmill);
	   }
   }
   public function getUpdateWindmill(Request $request){
	  if ($request->ajax()){
		  $windmill=Windmill::find($request->id);
		  return Response($windmill);
	  }
   }
   public function newUpdateWindmill(Request $request){
	   if ($request->ajax()){
		   $windmill=Windmill::find($request->id);
		   $this->checkInput($windmill, $request);
		   $windmill->save();
		   return Response($windmill);
	   }
   }
   public function deleteWindmill(Request $request){
	   if ($request->ajax()){
		   Windmill::destroy($request->id);
		   return Response()->json(['sms'=>'delete successfully']);
	   }
   }
   
   public function newComponent(Request $request){
	   if($request->ajax()){
		   $component = new Component();
		   $this->checkInputComponent($component, $request);
		   $component->save();
		   return response()->json($component);
	   }
   }
   public function getUpdateComponent(Request $request){
	  if ($request->ajax()){
		  $component=Component::find($request->id);
		  return Response($component);
	  }
   }
   public function newUpdateComponent(Request $request){
	   if ($request->ajax()){
		   $component=Component::find($request->id);
		   $this->checkInput($component, $request);
		   $component->save();
		   return Response($component);
	   }
   }
   public function deleteComponent(Request $request){
	   if ($request->ajax()){
		   Component::destroy($request->id);
		   return Response()->json(['sms'=>'delete successfully']);
	   }
   }
   
   
   public function checkInput($windmill, $request){
			$windmill->projectid=$request->projectid;
		   if($request->regnumber == ''){
			   $windmill->regnumber=null;
		   }else{
			   $windmill->regnumber=$request->regnumber;
		   }
		   if($request->name == ''){
			   $windmill->name=null;
		   }else{
			   $windmill->name=$request->name;
		   }
		   if($request->location == ''){
			   $windmill->location=null;
		   }else{
			   $windmill->location=$request->location;
		   }
		   if($request->startdate == ''){
			   $windmill->startdate=null;
		   }else{
			   $windmill->startdate=$request->startdate;
		   }
		   if($request->enddate == ''){
			   $windmill->enddate=null;
		   }else{
			   $windmill->enddate=$request->enddate;
		   }
		   if($request->remarks == ''){
			   $windmill->remarks=null;
		   }else{
			   $windmill->remarks=$request->remarks;
		   }
	   return $windmill;
   }
   
   public function checkInputComponent($component, $request){
			$component->projectid=$request->projectid;
		   if($request->regnumber == ''){
			   $component->regnumber=null;
		   }else{
			   $component->regnumber=$request->regnumber;
		   }
		   if($request->name == ''){
			   $component->name=null;
		   }else{
			   $component->name=$request->name;
		   }
		    if($request->length == ''){
			   $component->length=null;
		   }else{
			   $component->length=$request->length;
		   }
		    if($request->width == ''){
			   $component->width=null;
		   }else{
			   $component->width=$request->width;
		   }
		    if($request->height == ''){
			   $component->height=null;
		   }else{
			   $component->height=$request->height;
		   }
		    if($request->weight == ''){
			   $component->weight=null;
		   }else{
			   $component->weight=$request->weight;
		   }
		    if($request->switchable == ''){
			   $component->switchable=null;
		   }else{
			   $component->switchable=$request->switchable;
		   }
		   if($request->remarks == ''){
			   $component->remarks=null;
		   }else{
			   $component->remarks=$request->remarks;
		   }
	   return $component;
   }


}