<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLocalizacoes2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localizacoes2', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 255); 
            $table->integer('localizacao1_id')->unsigned();
            $table->foreign('localizacao1_id')->references('id')->on('localizacoes1');           
            $table->integer('praca_id')->unsigned();
            $table->foreign('praca_id')->references('id')->on('pracas');
            $table->softDeletes();
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
        Schema::dropIfExists('localizacoes2');
    }
}
