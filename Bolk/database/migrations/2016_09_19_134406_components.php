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
			$table->integer('windmillid');
			$table->integer('tasknumber');
			$table->double('length', 8,2);
			$table->double('height', 8,2);
			$table->double('width', 8,2);
			$table->double('weigth', 8,2);
			$table->string('switchable');
			$table->enum('status', ['storage','transport','delivered','installed']);
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
