<?php

use Illuminate\Database\Seeder;

class PracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d H:i:s");    
        DB::table("pracas")->insert([
            [            
                "nome"       => "EPTV Campinas",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [                     
                "nome"       => "EPTV Ribeirão Preto",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "nome"       => "EPTV São Carlos",             
                "created_at" => $now,
                "updated_at" => $now,
            ], [
                "nome"       => "EPTV Sul de Minas",             
                "created_at" => $now,
                "updated_at" => $now,
            ],
        ]);
    }
}
