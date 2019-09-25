<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalizacaoEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizacao_equipamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->string('observacao', 255)->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('equipamento_id')->unsigned();
            $table->foreign('equipamento_id')->references('id')->on('equipamentos');
            $table->integer('situacao_id')->unsigned();
            $table->foreign('situacao_id')->references('id')->on('situacoes');
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->integer('localizacao1_id')->unsigned();
            $table->foreign('localizacao1_id')->references('id')->on('localizacoes1');
            $table->integer('localizacao2_id')->unsigned();
            $table->foreign('localizacao2_id')->references('id')->on('localizacoes2');
            $table->integer('localizacao3_id')->unsigned();
            $table->foreign('localizacao3_id')->references('id')->on('localizacoes3');
            $table->integer('localizacao4_id')->unsigned();
            $table->foreign('localizacao4_id')->references('id')->on('localizacoes4');           
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
        Schema::dropIfExists('localizacao_equipamentos');
    }
}
