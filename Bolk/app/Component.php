<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'components';
    protected $touches = ['project'];
	protected $fillable=[
		'projectid',
		'windmillid',
		'regnumber',
		'name',
		'length',
		'height',
		'width',
		'weight',
		'switchable',
		'currentlocation',
		'status',
		'remarks'		
	];

    public function project() {
    	return $this->belongsTo('App\Project', 'projectid');
    }

    public function windmill() {
    	return $this->belongsTo('App\Windmill', 'mainwindmillid');
    }
}

