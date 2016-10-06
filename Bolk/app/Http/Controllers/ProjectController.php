<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Windmill;
use App\Component;
use App\Component_Transport;
use App\Switchable;
use DB;

class ProjectController extends Controller
{
	
	public function index($id){
	$windmills = Windmill::where('projectid','=', $id)->get();
	$components = Component::where('projectid', '=', $id)->whereNull('mainwindmillid')->get();
	$switchables = Switchable::all();
	$project = Project::where('id','=',$id)->first();


	return view('/project', ['windmills' => $windmills, 'components' => $components,  'project' => $project]);
	}

	public static function countComponents($windmillid) {
		$numberofcomponents = Component::where('mainwindmillid','=', $windmillid)->count();
		return $numberofcomponents;
	}

	public static function countTransports($componentid) {
		$numberoftransports = Component_Transport::where('componentid','=',$componentid)->count();
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
		  $switchablewindmills = Switchable::where('componentid', '=', $request->id)->pluck('windmillid');
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
		   if($request->componentregnumber == ''){
			   $component->regnumber=null;
		   }else{
			   $component->regnumber=$request->componentregnumber;
		   }
		   if($request->componentname == ''){
			   $component->name=null;
		   }else{
			   $component->name=$request->componentname;
		   }
		    if($request->componentlength == ''){
			   $component->length=null;
		   }else{
			   $component->length=$request->componentlength;
		   }
		    if($request->componentwidth == ''){
			   $component->width=null;
		   }else{
			   $component->width=$request->componentwidth;
		   }
		    if($request->componentheight == ''){
			   $component->height=null;
		   }else{
			   $component->height=$request->componentheight;
		   }
		    if($request->componentweight == ''){
			   $component->weight=null;
		   }else{
			   $component->weight=$request->componentweight;
		   }
		    if($request->componentswitchable == ''){
			   $component->switchable=null;
		   }else{
			   $component->switchable=$request->componentswitchable;
		   }
		   if($request->componentremarks == ''){
			   $component->remarks=null;
		   }else{
			   $component->remarks=$request->componentremarks;
		   }
	   return $component;
   }
   
   public static function checkSwitchable($componentid, $windmillid){
	   if(!is_null(DB::table('switchables')->where('componentid', '=', $componentid)->where('windmillid', '=', $windmillid)->first())){
		   return true;
	   }
	   return false;
   }


}