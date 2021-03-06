<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_img');
            $table->string('skill')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('profession')->nullable();
            $table->string('main_intrest')->nullable();
            $table->string('biography')->nullable();
            $table->integer('role_id')->nullable();
			$table->string('fb')->nullable();
			$table->string('insta')->nullable();
			$table->string('twitter')->nullable();
			$table->string('gmail')->nullable();
			$table->string('lin')->nullable();
			$table->string('b')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
