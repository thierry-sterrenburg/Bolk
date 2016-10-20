<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use App\Windmill;
use App\Switchable;
use App\Component;
use App\Component_Transport;
use DB;

class WindmillController extends Controller
{
    public function index($id){
    	$windmill = Windmill::where('id','=',$id)->first();
    	$components = Component::where('mainwindmillid','=',$id)->get();
    	$project = Project::where('id', '=', Windmill::where('id','=', $id)->value('projectid'))->first();
		$windmills = Windmill::where('projectid','=', $project->id)->get();
        $allComponentsWithoutWindmill = Component::whereNull('mainwindmillid')->get();
    	return view('/windmill', ['components' => $components, 'windmill'=> $windmill, 'project' => $project, 'windmills'=>$windmills, 'allComponentsWithoutWindmill'=>$allComponentsWithoutWindmill]);
    }

    public function addComponent(Request $request) {
        if($request->ajax()) {
            Component::where('id','=',$request->componentid)->update(['mainwindmillid'=>$request->windmillid]);
            $newswitchable = new Switchable();
            $newswitchable->componentid = $request->componentid;
            $newswitchable->windmillid = $request->windmillid;
            $newswitchable->save();
        }
        return response()->json();
     }

	public static function countTransports($componentid) {
		$numberoftransports = Component_Transport::where('componentid','=',$componentid)->count();
		return $numberoftransports;
	}
}
