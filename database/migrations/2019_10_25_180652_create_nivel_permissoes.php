<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNivelPermissoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nivel_permissoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permissao_id')->unsigned();
            $table->integer('nivel_id')->unsigned();

            $table->foreign('permissao_id')->references('id')->on('permissoes')->onDelete('cascade');
            $table->foreign('nivel_id')->references('id')->on('niveis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nivel_permissoes');
    }
}
