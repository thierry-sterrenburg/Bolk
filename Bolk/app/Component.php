<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'components';
    protected $touches = ['project','windmill'];
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

    public function projects() {
    	return $this->belongsTo('App\Project', 'projectid');
    }

    public function windmills() {
    	return $this->belongsTo('App\windmills', 'mainwindmillid');
    }
}

