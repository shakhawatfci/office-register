<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    // relation with folder 

    public function folder(){
      
        return $this->belongsTo('App\Folder')->withDefault(
            [
                'id' => 0,
                'folder_name' => 'Deleted Folder'
            ]
        );

    }

    // relation with documents 

       public function document(){
        return $this->hasMany('App\Document');
    }
}
