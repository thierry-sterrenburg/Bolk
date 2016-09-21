<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Windmills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("windmills", function (Blueprint $table) {
			$table->increments('id');
			$table->integer('projectid');
			$table->integer('tasknumber');
			$table->string('name');
			$table->string('location')->nullable();
			$table->datetime('startdate')->nullable();
			$table->datetime('enddate')->nullable();
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