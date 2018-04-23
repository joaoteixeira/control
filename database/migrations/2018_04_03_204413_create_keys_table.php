<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id')->unsigned();

            $table->integer('copia')->nullable();
            $table->boolean('disponivel')->default(1)->nullable();
            $table->string('qr_code')->nullable();
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('rooms');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('keys');
    }
}
