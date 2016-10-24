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
		   //return response();
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
	   
	   if($request->checklistaddressloading == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='Register Address of Loading';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistaddressloading == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='Register Address of Loading';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
	   
	   if($request->checklistempty == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='Permit Empty Truck(EN)';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistempty == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='Permit Empty Truck(EN)';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
	   
	    if($request->checklistloaded == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='Permit Loaded Truck(EN)';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistempty == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='Permit Loaded Truck(EN)';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
	   
	    if($request->checklistpar70 == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='Nachtrag Par. 70';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistpar70 == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='Nachtrag Par. 70';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
	   
	    if($request->checklistsert == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='Trailer papers/SERT';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistsert == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='Trailer papers/SERT';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
	   
	    if($request->checklistroute == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='Route Report';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistroute == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='Route Report';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
	   
	    if($request->checklistvlm == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='VLM';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistvlm == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='VLM';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
	   
	    if($request->checklistescort == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='Escort';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistescort == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='Escort';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
	   
	    if($request->checklistpolice == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='Registered by the Police';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistpolice == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='Registered by the Police';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
	   
	    if($request->checklistferry == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='Ferry Booked';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistferry == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='Ferry Booked';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
	   
	    if($request->checklistaddressarrival == 'yes'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'yes';
		   $requirement->name='Register Address of Arrival';
		   $requirement->responsibleplanner='Admin';
		   $requirement->save();
	   }else if($request->checklistaddressarrival == 'no'){
		   $requirement = new Requirement();
		   $requirement->transportid=$request->transportid;
		   $requirement->booked = 'no';
		   $requirement->name ='Register Address of Arrival';
		   $requirement->responsibleplanner ='Admin';
		   $requirement->save();
	   }
	   
	   
   }
   
   public static function checkStatusRequirement($requirementid){
	    $requirement=Requirement::find($requirementid);
	   if($requirement->booked == 'no'){
		   return 'danger';
	   }else if($requirement->booked == 'yes'){
		   return 'success';
	   }else if($requirement->booked == 'pending'){
		   return 'warning';
	   }else{
		   return;
	   }
   }
}
