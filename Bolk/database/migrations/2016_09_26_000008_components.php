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
            $table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('projectid')->unsigned();
            $table->foreign('projectid')->references('id')->on('projects')->onDelete('cascade');
			$table->integer('windmillid')->nullable()->unsigned();
            $table->foreign('windmillid')->references('id')->on('windmills')->onDelete('set null');
			$table->string('regnumber');
            $table->string('name')->nullable();
			$table->double('length', 8,2)->nullable();
			$table->double('height', 8,2)->nullable();
			$table->double('width', 8,2)->nullable();
			$table->double('weight', 8,2)->nullable();
			$table->string('switchable')->nullable();
			$table->enum('status', ['storage','transport','delivered','installed','unknown']);
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
