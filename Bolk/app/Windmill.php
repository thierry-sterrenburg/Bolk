<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Windmill extends Model
{
	protected $table = 'windmills';
	
	protected $fillable=[
		'projectid',
		'regnumber',
		'name',
		'location',
		'startdate',
		'enddate',
		'remarks'
	];
}
