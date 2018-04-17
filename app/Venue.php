<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
	protected $table = 'venues';

    public function bookings(){

         return $this->hasMany(Booking::class);
    }
}
