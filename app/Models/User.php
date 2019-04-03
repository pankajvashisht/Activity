<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable=['email','name','social_id','social_token','authorization_key','social_image'];

    public function userBooking(){
        return  $this->hasMany('App\Models\UserBooking');
     }
    
}
