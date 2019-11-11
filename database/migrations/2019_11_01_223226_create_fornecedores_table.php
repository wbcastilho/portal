<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 150); 
            $table->string('ie', 50)->nullable();
            $table->string('cnpj', 50)->nullable();
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->string('endereco', 200)->nullable(); 
            $table->string('numero', 50)->nullable();
            $table->string('bairro', 100)->nullable(); 
            $table->string('telefone', 25)->nullable(); 
            $table->string('celular', 25)->nullable(); 
            $table->string('email', 150)->nullable();                         
            $table->string('descricao', 250); 
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
        Schema::dropIfExists('fornecedores');
    }
}
