<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transport;
use DB;

class ComponentController extends Controller
{
    public function index() {
    	$transports = Transport::all();
    	return view('component', ['transports' => $transports]);
    }
}
