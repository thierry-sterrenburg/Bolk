<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'components';
    protected $touches = ['project','windmill'];

    public function projects() {
    	return $this->belongsTo('App\Project', 'projectid');
    }

    public function windmills() {
    	return $this->belongsTo('App\windmills', 'mainwindmillid');
    }
}

