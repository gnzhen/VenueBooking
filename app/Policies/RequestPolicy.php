<?php

namespace App\Policies;

use App\User;
use App\Booking;
use Illuminate\Auth\Access\HandlesAuthorization;
use Bouncer;

class RequestPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewRequest(User $user){

        return $user->can('view-request');
    }

    public function handleRequest(User $user){

        return $user->can('handle-request');
    }

    public function viewBooking(User $user){

        return $user->can('view-booking');
    }

    public function requestBooking(User $user){

        return $user->can('request-booking');
    }

    public function cancelBooking(User $user){

        return $user->can('cancel-booking');
    }
}
