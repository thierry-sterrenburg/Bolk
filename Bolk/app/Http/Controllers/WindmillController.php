<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Component;
use App\Transport;
use DP;

class WindmillController extends Controller
{
    public function index($id){
    	$windmillid = $id;
    	$components = Component::where('windmillid','=', $windmillid)->get();
    	return view('/windmill', ['components' => $components, 'windmillid'=> $windmillid]);
    }

    public static function countTransports($componentid) {
		$numberoftransports = Transport::where('componentid', '=', $componentid)->count();
		return $numberoftransports;
	}
}
