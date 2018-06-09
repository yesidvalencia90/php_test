<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = "routes";

    public function bus(){
    	return $this->belongsTo('App\Bus');
    }

}
