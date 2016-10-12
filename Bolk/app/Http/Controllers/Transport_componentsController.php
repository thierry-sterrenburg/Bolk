<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Component_Transport;
use App\Transport;

class Transport_componentsController extends Controller
{
    public function index($id) {
    	$transport = Transport::where('id','=',$id)->first();
    	$components = Component_Transport::where('transportid','=', $id)->join('components', 'component_transports.componentid', '=', 'components.id')->get();
    	$project = Project::where('id','=',$transport->id)->first();
    	return view('/transport_components',['transport'=>$transport,'components'=>$components,'project'=>$project]);
    }

    public static function countTransports($componentid) {
		$numberoftransports = Component_Transport::where('componentid','=',$componentid)->count();
		return $numberoftransports;
	}
}
