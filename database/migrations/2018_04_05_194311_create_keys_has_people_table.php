<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeysHasPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys_has_people', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('key_id')->unsigned()->nullable();
            $table->foreign('key_id')->references('id')
                ->on('keys')->onDelete('cascade');

            $table->integer('people_id')->unsigned()->nullable();
            $table->foreign('people_id')->references('id')
                ->on('people')->onDelete('cascade');

            // $table->integer('user_id')->unsigned()->nullable();
            // $table->foreign('user_id')->references('id')
            //     ->on('users')->onDelete('cascade');

            $table->dateTime('retirada');
            $table->dateTime('devolucao')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keys_has_people');
    }
}
