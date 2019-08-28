<?php

use Illuminate\Database\Seeder;

class NivelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        $now = date("Y-m-d H:i:s");    
        DB::table("niveis")->insert([
            [            
                "nome"       => "Administrador",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [                     
                "nome"       => "Gestor",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "nome"       => "Técnico",             
                "created_at" => $now,
                "updated_at" => $now,
            ],
        ]);
    }
}
