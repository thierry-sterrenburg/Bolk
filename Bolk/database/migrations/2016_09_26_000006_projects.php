<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("projects", function (Blueprint $table) {
            $table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('regnumber');
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
