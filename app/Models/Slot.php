<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
 protected $fillable=['from','to'];

 public function game(){
    return $this->hasMany('App\Models\Game');
 }
 public function booking(){
    return $this->hasMany('App\Models\Booking');
 }

}
