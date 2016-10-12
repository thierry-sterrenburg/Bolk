<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Windmill;
use App\Component;
use App\Transport;
use App\Component_Transport;	
use App\Requirement;
use DB;

class TransportphaseController extends Controller
{
    public function index($id) {
    	$requirements = Requirement::where('transportid','=', $id)->get();
    	$transport = Transport::where('id','=', $id)->first();
    	//!!!!! needs repairing for multipal components per transport!!!!!\\\\\\
    	$component = Component_Transport::where('transportid','=', $id)->join('components', 'component_transports.componentid', '=', 'components.id')->first();
    	$windmill = Windmill::where('id', '=', $component->mainwindmillid)->first();
    	$project = Project::where('id','=', $component->projectid)->first();
    	return view('/transportphase', ['requirements' => $requirements, 'transport' => $transport, 'component' => $component, 'windmill' => $windmill, 'project' => $project]);
    }
	
	public function newRequirement(Request $request){
	   if($request->ajax()){
		   $requirement = new Requirement();
		   $this->checkInputRequirement($requirement, $request);
		   $requirement->save();
		   return response()->json($requirement);
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
}
