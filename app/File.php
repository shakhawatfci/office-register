<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    // relation with folder 

    public function folder(){
      
        return $this->belongsTo('App\Folder');

    }
}
