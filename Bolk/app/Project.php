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

	public function windmills() {
		return $this->hasMany('App\Windmill', 'projectid');
	}

	public function components() {
		return $this->hasMany('App\Component', 'projectid');
	}
}
