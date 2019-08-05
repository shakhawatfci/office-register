<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    // realtion with box 

    public function box(){

    	return $this->belongsTo('App\Box');
    }
}
