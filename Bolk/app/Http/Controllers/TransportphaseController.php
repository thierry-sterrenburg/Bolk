<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Requirement;
use DB;

class TransportphaseController extends Controller
{
    public function index() {
    	$requirements = Requirement::all();
    	return view('transportphase', ['requirements' => $requirements]);
    }
}
