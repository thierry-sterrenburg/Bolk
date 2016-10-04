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
    	$windmill = Windmill::where('id', '=', $component->windmillid)->first();
    	$project = Project::where('id', '=',  $component->projectid)->first();
    	return view('/component', ['transports' => $transports, 'component' => $component, 'windmill' => $windmill, 'project' => $project]);
    }   
}
