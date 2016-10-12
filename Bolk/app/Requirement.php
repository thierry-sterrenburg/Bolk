<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $table = "requirements";
    protected $touches = ['transport'];

    protected function transport() {
    	return $this->belongsTo('App\Transport', 'transportid');
    }
}
