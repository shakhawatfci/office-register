<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','facebook_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

      // relation with documents 

      public function document(){
        return $this->hasMany('App\Document');
    } 

    //  facebook login 
public function addNew($input)

    {

        $check = static::where('facebook_id',$input['facebook_id'])->first();


        if(is_null($check)){

            return static::create($input);

        }


        return $check;

    }
}
