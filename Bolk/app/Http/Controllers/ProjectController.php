<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Windmill;
use App\Component;
use DB;

class ProjectController extends Controller
{
    public function index($id){
	$windmills = Windmill::where('projectid','=', $id)->get();
	$components = Component::where('projectid', '=', $id)->whereNull('windmillid')->get();
	return view('/project', ['windmills' => $windmills, 'components' => $components]);

	}
}