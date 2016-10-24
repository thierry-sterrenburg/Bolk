<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Component_Transport;
use App\Transport;
use App\Component;
use App\Windmill;

class Transport_componentsController extends Controller
{
    public function index($id) {
    	$transport = Transport::where('id','=',$id)->first();
    	$components = Component_Transport::where('transportid','=', $id)->join('components', 'component_transports.componentid', '=', 'components.id')->get();
    	$project = Project::where('id','=',$transport->projectid)->first();
		$allComponents = Component::where('projectid', '=', $project->id)->get();
    	return view('/transport_components',['transport'=>$transport,'components'=>$components,'project'=>$project,'allComponents'=>$allComponents]);
    }

    public static function countTransports($componentid) {
		$numberoftransports = Component_Transport::where('componentid','=',$componentid)->count();
		return $numberoftransports;
	}

	public static function getWindmillName($windmillid) {
		$windmillName = Windmill::where('id', '=', $windmillid)->pluck('name')->first();
		if(empty($windmillName)) {
			$windmillName = '-';
		}
		return $windmillName;
	}
	
	public function addComponent(Request $request){
		 if($request->ajax()){
		   $component_transport = new Component_Transport();
		   $component_transport->componentid = $request->componentid;
		   $component_transport->transportid = $request->transportid;
		   $component_transport->save();
		   return response()->json($component_transport);
	   }
	}
	
	public function deleteComponent(Request $request){
		if ($request->ajax()){
		   Component_Transport::where('componentid', $request->id)->delete();
		   return Response()->json(['sms'=>'delete successfully']);
	   }
	}	
}
