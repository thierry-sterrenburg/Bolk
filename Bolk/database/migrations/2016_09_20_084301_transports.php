<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Transports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create("transports", function (Blueprint $table) {
			$table->increments('id');
			$table->integer('componentid');
			$table->integer('transportnumber');
			$table->string('company');
			$table->string('truck');
			$table->string('trailer');
			$table->string('configuration');
			$table->string('from');
			$table->string('to');
			$table->datetime('dateofloading');
			$table->datetime('dateofarrivalinitial');
			$table->datetime('dateofarrivalfinal');
			$table->longText('remarks');
			
		}
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
