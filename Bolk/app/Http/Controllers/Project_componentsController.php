<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if(empty($firstTransport)) {
            $firstTransport = '-';
        }
        return $firstTransport;
    }

    public static function getToLocation($componentid) {
        $lastTransport = Component_Transport::where('componentid', '=', $componentid)->join('transports', 'component_transports.transportid','=','transports.id')->orderBy('datedesired', 'asc')->pluck('to')->last();
        if(empty($lastTransport)) {
            $lastTransport = '-';
        }
        return $lastTransport;
    }

    public static function getCurrentLocation($componentid) {
        $allTransport = Component_Transport::where('componentid', '=', $componentid)->join('transports', 'component_transports.transportid','=','transports.id')->get();
        $currentTimestamp = null;
        return 'null';
    }
}
