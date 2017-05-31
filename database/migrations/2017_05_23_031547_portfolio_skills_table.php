<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PortfolioSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();;
            $table->string('slug')->unique();;
            $table->text('description')->nullable();
        });

        Schema::table('portfolio_skills', function (Blueprint $table) {
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
        Schema::drop('portfolio_skills');

        Schema::table('portfolio_skills', function (Blueprint $table) {
            //
        });
    }
}
