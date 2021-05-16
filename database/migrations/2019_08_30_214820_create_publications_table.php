<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('code');
            $table->string('publishing_date');
            $table->string('file')->nullable();
            $table->string('image')->nullable();
            $table->text('body');
            $table->integer('submitted_by')->unsigned();
            $table->timestamps();
        });

        Schema::create('publication_user', function (Blueprint $table) {
            $table->integer('publication_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('publication_id')->references('id')->on('publications')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['publication_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('publications');
        Schema::drop('publication_user');
    }
}
