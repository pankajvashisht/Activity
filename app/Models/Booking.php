<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
 
    protected $fillable=['slot_id','game_id','user_id','players','booking_date'];    
    public function game(){
        return $this->belongsTo('App\Models\Game');
    }

    public function slot(){
        return $this->belongsTo('App\Models\Slot');
    }

    public function userBooking(){
        return $this->hasMany('App\Models\UserBooking','booking_id','id');
    }

    public function addBooking(){
        return 'App\Models\UserBooking';
    }

}
