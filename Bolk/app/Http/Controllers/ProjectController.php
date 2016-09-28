<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Windmill;
use App\Component;
use App\Transport;
use DB;

class ProjectController extends Controller
{
    public function index($id){
	$windmills = Windmill::where('projectid','=', $id)->get();
	$components = Component::where('projectid', '=', $id)->whereNull('windmillid')->get();
	return view('/project', ['windmills' => $windmills, 'components' => $components]);
	}

	public static function countComponents($windmillid) {
		$numberofcomponents = Component::where('windmillid', '=', $windmillid)->count();
		return $numberofcomponents;
	}

	public static function countTransports($componentid) {
		$numberoftransports = Transport::where('componentid', '=', $componentid)->count();
		return $numberoftransports;
	}

}