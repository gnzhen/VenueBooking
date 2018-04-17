<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'requests';

    protected $fillable = [
		'book_from',
		'book_to',
		'venue_id',
		'user_id',
	];


    public function venue(){

    	 return $this->belongsTo(Venue::class);
    }

    public function user(){

    	 return $this->belongsTo(User::class);
    }
}
