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

class Project_transportsController extends Controller
{
	
	public function index($id){
		$transports = Transport::where('projectid','=', $id)->get();
		$components = Component::where('projectid', '=', $id)->get();
		$project = Project::where('id','=',$id)->first();
		$windmills = Windmill::where('projectid','=', $id)->get();

	return view('/project_transports', ['transports' => $transports,'windmills' => $windmills, 'components' => $components,  'project' => $project]);
	}


	public static function countRequirements($transportid) {
		$numberofRequirements = Requirement::where('transportid','=',$transportid)->count();
		return $numberofRequirements;
	}


	public static function countComponents($transportid) {
		$numberofcomponents = Component_Transport::where('transportid','=', $transportid)->count();
		return $numberofcomponents;
	}

}