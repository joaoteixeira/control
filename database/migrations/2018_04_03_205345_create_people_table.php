<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campi_id')->unsigned();

            $table->string('tipo');
            $table->string('nome')->nullable();
            $table->string('cpf')->nullable();
            $table->string('siape')->nullable();
            $table->string('email')->nullable();
            $table->text('qr_code')->nullable();
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
        Schema::drop('people');
    }
}
