<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Requirements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create("requirements", function (Blueprint $table) {
			$table->increments('id');
			$table->integer('transportid');
			$table->string('name');
			$table->string('country');
			$table->datetime('startdate');
			$table->datetime('enddate');
			$table->boolean('booked');
			$table->longText('remarks');
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
