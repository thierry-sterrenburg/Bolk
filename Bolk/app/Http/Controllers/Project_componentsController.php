<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Windmill;
use App\Component;
use App\Component_Transport;

class Project_componentsController extends Controller
{
    public function index($id) {
    	$components = Component::where('projectid', '=', $id)->get();
    	$windmills = Windmill::where('projectid','=', $id)->get();
    	$project = Project::where('id','=',$id)->first();
    	return view('project_components', ['project'=>$project, 'components'=>$components, 'windmills'=>$windmills]);
    }

	public static function countTransports($componentid) {
		$numberoftransports = Component_Transport::where('componentid','=',$componentid)->count();
		return $numberoftransports;
	}

    public static function getWindmillName($windmillid) {
        $windmillName = Windmill::where('id','=', $windmillid)->pluck('name')->first();
        if(empty($windmillName)) {
            $windmillName = '-';
        }
        return $windmillName;
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
        $allTransport = Component_Transport::where('componentid', '=', $componentid)->join('transports', 'component_transports.transportid','=','transports.id')->whereNotNull('loadingdate')->orderBy('loadingdate', 'asc')->get();
        if(count($allTransport) < 1 ) {
            $currentLocation = self::getFromLocation($componentid);
            return $currentLocation;
        }

        $currentDateTime = new DateTime();
        foreach($allTransport as $transport) {
            if($transport->loadingdate > $currentDateTime) {
                $currentLocation = $transport->from;
                return $currentLocation;
            } elseif (empty($transport->unloadingdate)) {
                $currentLocation = 'On Transport from '.$transport->from.' To '.$transport->to;
                return $currentLocation;
            } elseif ($transport->unloadingdate < $currentDateTime) {
                $currentLocation = 'On Transport from '.$transport->from.' To '.$transport->to;
                return $currentDateTime;
            } else {
                $currentLocation = $transport->to;
                if (empty($currentLocation)) {
                    $currentLocation = 'something went is wrong!';
                }
                return $currentLocation
            }
        }
        return $currentLocation;
    }
}
