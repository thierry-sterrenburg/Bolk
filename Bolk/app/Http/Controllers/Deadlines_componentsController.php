<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Windmill;
use App\Component;
use App\Component_Transport;

class Deadlines_componentsController extends Controller
{
    public function index() {
    	$components = Component::all();
    	return view('/deadlines_components',['components'=>$components]);
    }

    public static function getProject($projectid) {
        $project = Project::where('id','=',$projectid)->first();
        return $project;
    }

    public static function getProjectName($projectid) {
    	$projectname = Project::where('id','=',$projectid)->pluck('name')->first();
    	if(empty($projectname)) {
    		$projectname = '-';
    	}
    	return $projectname;
    }

    public static function getWindmillName($windmillid) {
        $windmillName = Windmill::where('id','=', $windmillid)->pluck('name')->first();
        if(empty($windmillName)) {
            $windmillName = '-';
        }
        return $windmillName;
    }

    public static function getWindMills($projectid) {
        $windmills = Windmill::where('projectid','=',$projectid)->get();
        return $windmills;
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

    public static function getFinalDesiredDate($componentid) {
        $lastDate = Component_Transport::where('componentid', '=', $componentid)->join('transports', 'component_transports.transportid','=','transports.id')->orderBy('datedesired', 'asc')->pluck('datedesired')->last();
        if(count($lastDate) < 1) {
            $lastTransport = '-';
        }
        return $lastDate;
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
