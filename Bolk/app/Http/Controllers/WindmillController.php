<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Windmill;
use App\Switchable;
use App\Component;
use App\Component_Transport;
use DB;

class WindmillController extends Controller
{
    public function index($id){
    	$windmill = Windmill::where('id','=',$id)->first();
    	$components = Component::where('mainwindmillid','=',$id)->get();
    	$project = Project::where('id', '=', Windmill::where('id','=', $id)->value('projectid'))->first();
		$windmills = Windmill::where('projectid','=', $project->id)->get();
        $allComponentsWithoutWindmill = Component::where('projectid','=',$project->id)->whereNull('mainwindmillid')->get();
    	return view('/windmill', ['components' => $components, 'windmill'=> $windmill, 'project' => $project, 'windmills'=>$windmills, 'allComponentsWithoutWindmill'=>$allComponentsWithoutWindmill]);
    }

    public function addComponent(Request $request) {
        if($request->ajax()) {
            Component::where('id','=',$request->componentid)->update(['mainwindmillid'=>$request->windmillid]);
            $newswitchable = new Switchable();
            $newswitchable->componentid = $request->componentid;
            $newswitchable->windmillid = $request->windmillid;
            $newswitchable->save();
        }
        return response()->json();
     }

	public static function countTransports($componentid) {
		$numberoftransports = Component_Transport::where('componentid','=',$componentid)->count();
		return $numberoftransports;
	}

        public static function getFromLocation($componentid) {
        $firstTransport = Component_Transport::where('componentid', '=', $componentid)->join('transports', 'component_transports.transportid','=','transports.id')->orderBy('datedesired','asc')->pluck('from')->first();
        if(count($firstTransport) < 1) {
            $firstTransport = '-';
        }
        return $firstTransport;
    }

    public static function getToLocation($componentid) {
        $lastTransport = Component_Transport::where('componentid', '=', $componentid)->join('transports', 'component_transports.transportid','=','transports.id')->orderBy('datedesired', 'asc')->pluck('to')->last();
        if(count($lastTransport) < 1) {
            $lastTransport = '-';
        }
        return $lastTransport;
    }

    public static function getCurrentLocation($componentid) {
        $allTransport = Component_Transport::where('componentid', '=', $componentid)->join('transports', 'component_transports.transportid','=','transports.id')->orderBy('datedesired', 'asc')->get();
        if(count($allTransport) < 1 ) {
            $currentLocation = self::getFromLocation($componentid);
            return $currentLocation;
        }
        $counter = 0;
        $allTransportsCount = count($allTransport);
        $currentDateTime = date("Y-m-d");
        foreach($allTransport as $transport) {
             $currentLocation = '';
            if (empty($transport->loadingdate) || $transport->loadingdate > $currentDateTime){
                $currentLocation = $transport->form;
                return $currentLocation;
            }  elseif (empty($transport->unloadingdate)) {
                $currentLocation = 'On Transport from '.$transport->from.' To '.$transport->to;
                return $currentLocation;
            } elseif ($transport->unloadingdate > $currentDateTime) {
                $currentLocation = 'On Transport from '.$transport->from.' To '.$transport->to;
                return $currentLocation;
            } elseif ($transport->unloadingdate <= $currentDateTime) {
                $currentLocation = $transport->to;
                if($counter >= $allTransportsCount) {
                    return $currentLocation;
                }
            } else {
                $currentLocation = 'error in location'; 
            }
            $counter = $counter++;
        }
        return $currentLocation;
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

    Public static function getComponentColor($componentid){
        $allTransport = Component_Transport::where('componentid', '=', $componentid)->join('transports', 'component_transports.transportid','=','transports.id')->get();
        $successAmount = 0;
        $geplandAmount = 0;
        $underway = 0;
        foreach($allTransport as $transport){
            $color = self::getTransportColor($transport);
            if($color == "success"){
                $successAmount++;
            }else if($color == "info"){
                $geplandAmount++;
            }else if($color == "warning"){
                $underway++;
            }
        
            if($successAmount >= count($allTransport)){
                return "success";
            }else if (($geplandAmount + $successAmount + $underway) >= count($allTransport)){
                if($underway > 0){
                    return "warning";
                }else{
                    return "info";
                }
            }
        }

        return "";
    }

}
