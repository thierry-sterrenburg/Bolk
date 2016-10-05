<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $table = 'transports';

    public function requirement() {
    	return $this->hasMany('App\Requirement', 'transportid');
    }
}
