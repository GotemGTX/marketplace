<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('user_id');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('hourly_rate');
            $table->string('resume')->nullable();
            $table->string('avatar')->nullable();
            $table->string('cover_letter')->nullable();
            $table->string('skills')->nullable();
            $table->text('about')->nullable();
            $table->text('passport')->nullable();
            $table->text('driving_license')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
