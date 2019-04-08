<?php

namespace App\Models;
use App\Mail\Booking as BookingMail;
use Illuminate\Database\Eloquent\Model;
use Mail;
class Booking extends Model
{
 
    protected $fillable=['slot_id','game_id','user_id','players','booking_date'];    

    protected static function boot(){
        parent::boot();
        static::created(function ($booking){
            // Mail::to('pankaj@ucreate.co.in')->send(
            //     new BookingMail($booking)
            // );
        });
    }

    public function game(){
        return $this->belongsTo('App\Models\Game');
    }

    public function slot(){
        return $this->belongsTo('App\Models\Slot');
    }

    public function userBooking(){
        return $this->hasMany('App\Models\UserBooking','booking_id','id');
    }
    public function bookings(){
        return $this->hasMany('App\Models\UserBooking','booking_id','id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function addBooking(){
        return 'App\Models\UserBooking';
    }

}
