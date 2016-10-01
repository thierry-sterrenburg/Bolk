<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transport;
use App\Requirement;
use DB;

class ComponentController extends Controller
{
    public function index($id) {
    	$componentid = $id;
    	$transports = Transport::where('componentid','=', $componentid)->get();
    	return view('/component', ['transports' => $transports, 'componentid' => $componentid]);
    }

    public static function countRequirements($transportid) {
    	$numberofreq = Requirement::where('transportid', '=', $transportid)->count();
    	return $numberofreq;
    }
}
