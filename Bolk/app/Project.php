<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $table = "projects";
	
	protected $fillable=[
		'regnumber',
		'name',
		'location',
		'startdate',
		'enddate',
		'remarks'
	];

	public function windmill() {
		return $this->hasMany('App\Windmill', 'projectid');
	}

	public function component() {
		return $this->hasMany('App\Component', 'projectid');
	}
}
