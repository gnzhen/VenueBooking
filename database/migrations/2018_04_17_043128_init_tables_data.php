<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

class InitTablesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert([
            ['user_id' => 'admin', 'password' => Hash::make('123123')],
            ['user_id' => 'lecturer', 'password' => Hash::make('123123')],
            ['user_id' => 'lecturer1', 'password' => Hash::make('123123')],
            ['user_id' => '1404206', 'password' => Hash::make('123123')],
            ['user_id' => '1401234', 'password' => Hash::make('123123')],
        ]);

        DB::table('venues')->insert([
            ['name' => 'KB101'],
            ['name' => 'KB102'],
            ['name' => 'KB103'],
            ['name' => 'KB201'],
            ['name' => 'KB202'],
            ['name' => 'KB203'],
            ['name' => 'KB301'],
            ['name' => 'KB302'],
            ['name' => 'KB303'],
            ['name' => 'KB401'],
            ['name' => 'KB402'],
            ['name' => 'KB403'],
            ['name' => 'KB501'],
            ['name' => 'KB502'],
            ['name' => 'KB503'],
        ]);

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
