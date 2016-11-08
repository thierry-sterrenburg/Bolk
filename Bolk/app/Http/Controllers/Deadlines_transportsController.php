<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Transport;
use App\Component_Transport;
use App\Requirement;

class Deadlines_transportsController extends Controller
{
	public function index() {
		$transports = Transport::all();
		return view('/deadlines_transports',['transports'=>$transports]);
	}

	public static function getProjectName($projectid) {
		$projectname = Project::where('id','=',$projectid)->pluck('name')->first();
		if(empty($projectname)) {
			$projectname = '-';
		}
		return $projectname;
	}

	public static function countComponents($transportid) {
		$numberofcomponents = Component_Transport::where('transportid','=', $transportid)->count();
		return $numberofcomponents;
	}

	public static function countRequirements($transportid) {
		$numberofRequirements = Requirement::where('transportid','=',$transportid)->count();
		return $numberofRequirements;
	}
	public static function getTransportColor($transport){
        $currentDateTime = date("Y-m-d");
        If($transport->unloadingdate!= null &&$transport->unloadingdate < $currentDateTime){
            return "success";
        }else if($transport->dateplanned != null){
            if($transport->loadingdate < $currentDateTime){
                return "warning";
            }else{
                return "info";
            }
        }
        return "";
    }
}