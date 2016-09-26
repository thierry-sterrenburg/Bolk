<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Components extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("components", function (Blueprint $table) {
			$table->increments('id');
			$table->integer('projectid');
            $table->foreign('projectid')->references('id')->on('projects');
			$table->integer('windmillid')->nullable();
            $table->foreign('windmillid')->references('id')->on('windmills');
			$table->string('regnumber');
            $table->string('name')->nullable();
			$table->double('length', 8,2)->nullable();
			$table->double('height', 8,2)->nullable();
			$table->double('width', 8,2)->nullable();
			$table->double('weigth', 8,2)->nullable();
			$table->string('switchable');
			$table->enum('status', ['storage','transport','delivered','installed','unknown']);
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
