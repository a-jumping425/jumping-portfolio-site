<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('overview');
            $table->string('url')->nullable();
            $table->date('completed_date')->nullable();
            $table->bigInteger('ordering');
            $table->timestamps();
        });

        Schema::table('portfolios', function (Blueprint $table) {
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
        Schema::drop('portfolios');

        Schema::table('portfolios', function (Blueprint $table) {
            //
        });
    }
}
