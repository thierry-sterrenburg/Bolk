<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $table = 'transports';

    public function requirements() {
    	return $this->hasMany('App\Requirement', 'transportid');
    }
}
