<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campi_id')->unsigned();
            $table->integer('numero')->nullable();
            $table->string('descricao')->nullable();
            $table->boolean('agendavel')->nullable();

            $table->timestamps();
            $table->foreign('campi_id')->references('id')->on('campis');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rooms');
    }
}
