<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Windmill;
use App\Component;
use App\Transport;
use DB;

class WindmillController extends Controller
{
    public function index($id){
    	$windmill = Windmill::where('id','=',$id)->first();
    	$components = Component::where('windmillid','=', $id)->get();
    	$project = Project::where('id', '=', Windmill::where('id','=', $id)->value('projectid'))->first();
    	return view('/windmill', ['components' => $components, 'windmill'=> $windmill, 'project' => $project]);
    }
}
