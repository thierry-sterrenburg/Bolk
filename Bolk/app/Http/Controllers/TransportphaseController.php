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


    	//!!!!! needs repairing for multipal components!!!!!\\\\\\
    	$component = Component_Transport::where('transportid','=', $id)->join('components', 'component_transports.componentid', '=', 'components.id')->first();



    	$windmill = Windmill::where('id', '=', $component->windmillid)->first();
    	$project = Project::where('id','=', $component->projectid)->first();

    	return view('/transportphase', ['requirements' => $requirements, 'transport' => $transport, 'component' => $component, 'windmill' => $windmill, 'project' => $project]);
    }
}
