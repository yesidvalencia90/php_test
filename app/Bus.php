<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'buses';

    public function route(){
    	return $this->hasOne('App\Route');
    }

}
