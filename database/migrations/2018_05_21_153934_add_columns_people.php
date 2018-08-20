<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsPeople extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->date('data_nasc')->nullable()->after('nome');
            $table->string('rg')->nullable()->after('cpf');
            $table->string('rg_orgao')->nullable()->after('rg');
            $table->string('rg_estado')->nullable()->after('rg_orgao');

            $table->string('tipo_sanguineo')->nullable()->after('rg_estado');

            $table->date('entrada_exercicio')->nullable()->after('siape');
            $table->string('cargo')->nullable()->after('entrada_exercicio');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn([
                'data_nasc', 'rg',  'rg_orgao', 'rg_estado', 
                'tipo_sanguineo', 'entrada_exercicio', 'cargo'
            ]);
        });
    }
}
