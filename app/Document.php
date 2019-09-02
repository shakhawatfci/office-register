<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
 
    //    relation with user 
  
     public function user(){

        return $this->belongsTo('App\User')->withDefault([
            'id' => 0,
            'name' => 'unknown'
        ]);
     }

    //  relation with box 

    public function box(){
     
        return $this->belongsTo('App\Box')->withDefault([
            'id' => 0,
            'box_name' => 'unknown box'
        ]);

    }

    // relation with folder 

    public function folder(){

        return $this->belongsTo('App\Folder')->withDefault([
            'id' => 0,
            'folder_name' => 'unknown'
        ]);
    }


    // relation with file 

    public function file(){

        return $this->belongsTo('App\File')->withDefault([
           'id' => 0,
           'file_name' => 'unknown file' 
        ]);
    }



}
