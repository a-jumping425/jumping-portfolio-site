<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PortfolioMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('portfolio_id');
            $table->string('meta_key');
            $table->text('meta_value');
            $table->index('portfolio_id', 'portfolio_id');
            $table->index('meta_key', 'meta_key');
        });

        Schema::table('portfolio_meta', function (Blueprint $table) {
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
        Schema::drop('portfolio_meta');

        Schema::table('portfolio_meta', function (Blueprint $table) {
            //
        });
    }
}
