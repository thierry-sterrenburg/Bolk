<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Windmill;
use App\Component;
use App\Transport;
use Illuminate\Support\Facades\Input;
use DB;

class ProjectController extends Controller
{
	
	public function index($id){
	$windmills = Windmill::where('projectid','=', $id)->get();
	$components = Component::where('projectid', '=', $id)->whereNull('windmillid')->get();
	$projectid = $id;
	return view('/project', ['windmills' => $windmills, 'components' => $components,  'projectid' => $projectid]);
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

}