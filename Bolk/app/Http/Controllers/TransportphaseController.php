<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Transport;	
use App\Requirement;
use DB;

class TransportphaseController extends Controller
{
    public function index($id) {
    	$requirements = Requirement::where('transportid','=', $id)->get();
    	$transport = Transport::where('id','=', $id)->first();
    	$project = Project::where('id','=', $transport->projectid)->first();
    	return view('/transportphase',['transport'=>$transport, 'project'=>$project, 'requirements'=>$requirements]);
    }
	
	public function newRequirement(Request $request){
	   if($request->ajax()){
		   $requirement = new Requirement();
		   $this->checkInputRequirement($requirement, $request);
		   $requirement->save();
		   return response()->json($requirement);
	   }
   }
   
   public function newChecklist(Request $request){
	   if($request->ajax()){
		   $this->checkInputChecklist($request);
		   return response();
	   }
   }
   
    public function getUpdateRequirement(Request $request){
	  if ($request->ajax()){
		  $requirement=Requirement::find($request->id);
		  return Response($requirement);
	  }
   }
   public function newUpdateRequirement(Request $request){
	   if ($request->ajax()){
		   $requirement=Requirement::find($request->id);
		   $this->checkInputRequirement($requirement, $request);
		   $requirement->save();
		   return Response($requirement);
	   }
   }
   public function deleteRequirement(Request $request){
	   if ($request->ajax()){
		   Requirement::destroy($request->id);
		   return Response()->json(['sms'=>'delete successfully']);
	   }
   }
   
   public function checkInputRequirement($requirement, $request){
			$requirement->transportid=$request->transportid;
			$requirement->booked = $request->requirementbooked;
		   if($request->requirementname == ''){
			   $requirement->name=null;
		   }else{
			   $requirement->name=$request->requirementname;
		   }
		   if($request->requirementcountry == ''){
			   $requirement->country=null;
		   }else{
			   $requirement->country=$request->requirementcountry;
		   }
		   if($request->requirementstartdate == ''){
			   $requirement->startdate=null;
		   }else{
			   $requirement->startdate=$request->requirementstartdate;
		   }
		   if($request->requirementenddate == ''){
			   $requirement->enddate=null;
		   }else{
			   $requirement->enddate=$request->requirementenddate;
		   }
		   if($request->requirementplanner == ''){
			   $requirement->responsibleplanner=null;
		   }else{
			   $requirement->responsibleplanner=$request->requirementplanner;
		   }
		   if($request->requirementremarks == ''){
			   $requirement->remarks=null;
		   }else{
			   $requirement->remarks=$request->requirementremarks;
		   }
	   return $requirement;
   }
   
   public function checkInputChecklist($request){
	   if($request->checklistcmr == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='CMR';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistcmr == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='CMR';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
   }
}
