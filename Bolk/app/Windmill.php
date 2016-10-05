<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Windmill extends Model
{
	protected $table = 'windmills';
	protected $touches = ['project'];
	
	protected $fillable=[
		'projectid',
		'regnumber',
		'name',
		'location',
		'startdate',
		'enddate',
		'remarks'
	];

	public function projects() {
		return $this->belongsTo('App\Project', 'projectid');
	}

	public function components() {
		return $this->hasMany('App\Component', 'mainwindmillid');
	}
}
