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
            $table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('projectid')->unsigned();
            $table->foreign('projectid')->references('id')->on('projects')->onDelete('cascade');
			$table->string('regnumber');
			$table->string('name');
			$table->string('location')->nullable();
			$table->date('startdate')->nullable();
			$table->date('enddate')->nullable();
			$table->longText('remarks')->nullable();
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
