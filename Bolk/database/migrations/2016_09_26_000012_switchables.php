<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Switchables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("switchables", function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('componentid')->unsigned();
            $table->foreign('componentid')->references('id')->on('components');
            $table->integer('windmillid')->unsigned();
            $table->foreign('windmillid')->references('id')->on('windmills');
            $table->primary(array('componentid','windmillid'));
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
        //
    }
}
