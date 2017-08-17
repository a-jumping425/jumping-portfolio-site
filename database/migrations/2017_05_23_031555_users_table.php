<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTable extends Migration
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
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('email')->unique();
            $table->string('username', 30)->unique();
            $table->string('password');
            $table->integer('user_level');
            $table->string('avatar')->nullable();
            $table->string('avatar_url')->nullable();
            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');

        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
