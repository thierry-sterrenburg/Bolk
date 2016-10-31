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
            $table->engine = 'InnoDB';
			$table->increments('id');
            $table->integer('projectid')->unsigned();
            $table->foreign('projectid')->references('id')->on('projects')->onDelete('cascade'); 
			$table->string('transportnumber')->nullable();
			$table->string('company')->nullable();
			$table->string('truck')->nullable();
			$table->string('trailer')->nullable();
			$table->string('configuration')->nullable();
			$table->string('from')->nullable();
			$table->string('to')->nullable();
			$table->date('loadingdate')->nullable();
            $table->date('datedesired');
            $table->date('dateestimated')->nullable();
            $table->date('dateplanned')->nullable();
            $table->date('dateactual')->nullable();
            $table->date('unloadingdate')->nullable();
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
