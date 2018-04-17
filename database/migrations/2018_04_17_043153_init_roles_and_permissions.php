<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

class InitRolesAndPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Define Roles
        $admin = Bouncer::role()->create([
            'name' => 'admin',
            'title' => 'Admin',
        ]);

        $user = Bouncer::role()->create([
            'name' => 'user',
            'title' => 'User',
        ]);

        //Define Abilities
        $handleRequest = Bouncer::ability()->create([
            'name' => 'handle-request',
            'title' => 'Handle Request',
        ]);

        $viewRequest = Bouncer::ability()->create([
            'name' => 'view-request',
            'title' => 'View Request',
        ]);

        $viewBooking = Bouncer::ability()->create([
            'name' => 'view-booking',
            'title' => 'View Booking',
        ]);

        $requestBooking = Bouncer::ability()->create([
            'name' => 'request-booking',
            'title' => 'Request Booking',
        ]);

        $cancelBooking = Bouncer::ability()->create([
            'name' => 'cancel-booking',
            'title' => 'Cancel Booking'
        ]);

        //Assign abilities to roles
        Bouncer::allow($admin)->to($handleRequest);
        Bouncer::allow($admin)->to($viewRequest);
        Bouncer::allow($user)->to($viewBooking);
        Bouncer::allow($user)->to($requestBooking);
        Bouncer::allow($user)->to($cancelBooking);

        //Assign role to user
        $firstUser = User::find(1);
        Bouncer::assign('admin')->to($firstUser);
        $otherUsers = User::where('id', '<>', 1)->get();
        foreach($otherUsers as $otherUser)
            Bouncer::assign('user')->to($otherUser);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
