<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBorders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create user_borders table; used to check what borders a user has
        Schema::create('user_borders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->foreignId('user_id'); //which user unlocked the border?
            $table->foreignId('border_id'); //which border has the user unlocked?
        });

        //update character_profiles table to add the border_id column
        Schema::table('character_profiles', function (Blueprint $table) {
            $table->foreignId('border_id')->nullable; //what border is this character currently using?
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::update('character_profiles', function (Blueprint $table) {
            $table->dropColumn('border_id');
        });
        Schema::dropIfExists('user_borders');
    }
}
