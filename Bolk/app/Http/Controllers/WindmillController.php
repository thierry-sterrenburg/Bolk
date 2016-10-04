<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Windmill;
use App\Component;
use App\Component_Transport;
use DB;

class WindmillController extends Controller
{
    public function index($id){
    	$windmill = Windmill::where('id','=',$id)->first();
    	$components = Component::where('mainwindmillid','=',$id)->get();
    	$project = Project::where('id', '=', Windmill::where('id','=', $id)->value('projectid'))->first();
    	return view('/windmill', ['components' => $components, 'windmill'=> $windmill, 'project' => $project]);
    }

	public static function countTransports($componentid) {
		$numberoftransports = Component_Transport::where('componentid','=',$componentid)->count();
		return $numberoftransports;
	}
}
