<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBooking extends Model
{
    protected $fillable=['user_id','booking_id','booking_date'];
    
}
