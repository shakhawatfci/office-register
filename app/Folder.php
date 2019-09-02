<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    // realtion with box 

    public function box(){

    	return $this->belongsTo('App\Box')->withDefault([
            'id' => 0,
            'box_name' => 'unknown'
        ]);
    }

    // relation with file 

   public function file(){

        return $this->hasMany('App\File');
     }

    // relation with documents 

   public function document(){
        return $this->hasMany('App\Document');
    } 
}
