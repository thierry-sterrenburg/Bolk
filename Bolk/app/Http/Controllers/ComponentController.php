<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Windmill;
use App\Component;
use App\Component_Transport;
use App\Transport;
use App\Requirement;
use DB;

class ComponentController extends Controller
{
    public function index($id) {
        $transports = Component_Transport::where('componentid','=', $id)->join('transports', 'component_transports.transportid', '=', 'transports.id')->get();
        $component = Component::where('id','=',$id)->first();
    	$windmill = Windmill::where('id', '=', $component->mainwindmillid)->first();
    	$project = Project::where('id', '=',  $component->projectid)->first();
    	$allTransports = Transport::where('projectid','=',$project->id)->get();
    	return view('/component', ['transports' => $transports, 'component' => $component, 'windmill' => $windmill, 'project' => $project, 'allTransports'=>$allTransports]);
    }

    public static function countTransports($componentid) {
		$numberoftransports = Component_Transport::where('componentid','=',$componentid)->count();
		return $numberoftransports;
	}   

	public static function countRequirements($transportid) {
		$numberofRequirements = Requirement::where('transportid','=',$transportid)->count();
		return $numberofRequirements;
	}

	public function addTransport(Request $request) {
		if($request->ajax()) {
			$component_transport = new Component_Transport();
			$component_transport->componentid = $request->componentid;
			$component_transport->transportid = $request->transportid;
			$component_transport->save();
			$transportrow = Transport::where('id','=',$request->transportid)->first();
			return response()->json($transportrow);
		}
	}

	public function newTransport(Request $request){
	   if($request->ajax()){
		   $transport = new Transport();
		   $this->checkInputTransport($transport, $request);
		   $transport->save();
		   $component_transport = new Component_Transport();
		   $component_transport->componentid=$request->componentid;
		   $component_transport->transportid=$transport->id;
		   $component_transport->save();
		   return response()->json($transport);
	   }
   }
   public function getUpdateTransport(Request $request){
	  if ($request->ajax()){
		  $transport=Transport::find($request->id);
		  return Response($transport);
	  }
   }
   public function newUpdateTransport(Request $request){
	   if ($request->ajax()){
		   $transport=Transport::find($request->id);
		   $this->checkInputTransport($transport, $request);
		   $transport->save();
		   return Response($transport);
	   }
   }

    public function deleteTransportFromComponent(Request $request) {
   		if ($request->ajax()){
   			Component_Transport::where('transportid', $request->id)->delete();
   			return Response()->json(['sms'=>'delete successfully']);
   		}
    }
    public static function getTransportColor($transport){
    	$currentDateTime = date("Y-m-d");
    	If($transport->unloadingdate!= null &&$transport->unloadingdate < $currentDateTime){
    		return "success";
    	}else if($transport->dateplanned != null){
    		if($transport->loadingdate < $currentDateTime){
    			return "warning";
    		}else{
    			return "info";
    		}
    	}
    	return "";
    }

	public function checkInputTransport($transport, $request){
		   if($request->transportnumber == ''){
			   $transport->transportumber=null;
		   }else{
			   $transport->transportnumber=$request->transportnumber;
		   }
		   if($request->transportcompany == ''){
			   $transport->company=null;
		   }else{
			   $transport->company=$request->transportcompany;
		   }
		    if($request->transporttruck == ''){
			   $transport->truck=null;
		   }else{
			   $transport->truck=$request->transporttruck;
		   }
		    if($request->transporttrailer == ''){
			   $transport->trailer=null;
		   }else{
			   $transport->trailer=$request->transporttrailer;
		   }
		    if($request->transportconfiguration == ''){
			   $transport->configuration=null;
		   }else{
			   $transport->configuration=$transport->transportconfiguration;
		   }
		    if($request->transportfrom == ''){
			   $transport->from=null;
		   }else{
			   $transport->from=$request->transportfrom;
		   }
		    if($request->transportto == ''){
			   $transport->to=null;
		   }else{
			   $transport->to=$request->transportto;
		   }
		    if($request->loadingdate == ''){
			   $transport->dateofloading=null;
		   }else{
			   $transport->dateofloading= date(‘Y-m-d’ , strtotime($request->loadingdate));
		   }
		    if($request->datedesired == ''){
			   $transport->datedesired=null;
		   }else{
			   $transport->datedesired=date(‘Y-m-d’ , strtotime($request->datedesired));
		   }
		    if($request->dateplanned == ''){
			   $transport->dateplanned=null;
		   }else{
			   $transport->dateplanned=date(‘Y-m-d’ , strtotime($request->dateplanned));
		   }
		    if($request->dateestimated == ''){
			   $transport->dateestimated=null;
		   }else{
			   $transport->dateestimated=date(‘Y-m-d’ , strtotime($request->dateestimated));
		   }
		    if($request->dateactual == ''){
			   $transport->dateactual=null;
		   }else{
			   $transport->dateactual=date(‘Y-m-d’ , strtotime($request->dateactual));
		   }
		   if($request->unloadingdate == ''){
			   $transport->unloadingdate=null;
		   }else{
			   $transport->unloadingdate=date(‘Y-m-d’ , strtotime($request->unloadingdate));
		   }
		   if($request->transportremarks == ''){
			   $transport->remarks=null;
		   }else{
			   $transport->remarks=$request->transportremarks;
		   }
	   return $transport;
   }
   
   public static function checkOnTransport($componentid, $transportid){
	    if(is_null(Component_Transport::where('componentid', '=', $componentid)->where('transportid', '=', $transportid)->first())){
		   return true;
	   }
   }
   
}
