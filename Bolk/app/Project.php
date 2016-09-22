<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $table = "projects";
	public $timestamps = false;
	
	protected $fillable=[
		'regnumber',
		'name',
		'location',
		'startdate',
		'enddate',
		'remarks'
	];
}
