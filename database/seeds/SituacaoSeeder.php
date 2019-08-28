<?php

use Illuminate\Database\Seeder;

class SituacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d H:i:s");    
        DB::table("situacoes")->insert([
            [            
                "nome"       => "Cadastrado",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [                     
                "nome"       => "Movimentado",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "nome"       => "Excluído",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "nome"       => "Reativado",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "nome"       => "Assistência Técnica",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "nome"       => "Empréstimo",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "nome"       => "Doação",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "nome"       => "Descarte",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "nome"       => "Extravio",             
                "created_at" => $now,
                "updated_at" => $now,
            ],
        ]);
    }
}
