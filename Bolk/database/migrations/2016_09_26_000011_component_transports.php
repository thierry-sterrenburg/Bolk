<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ComponentTransports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("component_transports", function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('componentid')->unsigned();
            $table->foreign('componentid')->references('id')->on('components')->onDelete('cascade');
            $table->integer('transportid')->unsigned();
            $table->foreign('transportid')->references('id')->on('transports')->onDelete('cascade');
            $table->primary(array('componentid','transportid'));
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
