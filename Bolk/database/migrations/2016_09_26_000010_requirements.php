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
            $table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('transportid')->unsigned();
            $table->foreign('transportid')->references('id')->on('transports')->onDelete('cascade');
			$table->string('name');
			$table->string('country')->nullable();
			$table->datetime('startdate')->nullable();
			$table->datetime('enddate')->nullable();
			$table->enum('booked', ['no','pending','yes']);
            $table->string('responsibleplanner');
			$table->longText('remarks')->nullable();
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
