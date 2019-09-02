<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    // relation with folder 

    public function folder(){

    	return $this->hasMany('App\Folder');
    }

    // relation with documents 

    public function document(){
        return $this->hasMany('App\Document');
    }
}
