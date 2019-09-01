<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    // realtion with box 

    public function box(){

    	return $this->belongsTo('App\Box');
    }

    // relation with file 

    public function file(){

        return $this->hasMany('App\File');
    }
}
