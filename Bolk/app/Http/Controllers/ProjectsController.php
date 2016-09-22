<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Project;
use DB;

class ProjectsController extends Controller
{
   public function index(){
	$projects = Project::all();
	return view('modal', ['projects' => $projects]);
   }
}
