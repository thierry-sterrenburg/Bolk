<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Requirement;
use DB;

class TransportphaseController extends Controller
{
    public function index($tid) {
    	$requirements = Requirement::where('transportid','=', $id)->get();
    	return view('/transportphase', ['requirements' => $requirements]);
    }
}
