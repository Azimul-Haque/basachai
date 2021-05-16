<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disdatas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('file')->nullable();
            $table->integer('discategory_id')->unsigned();
            $table->integer('districtscord_id')->unsigned();
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
        Schema::drop('disdatas');
    }
}
