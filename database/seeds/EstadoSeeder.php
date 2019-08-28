<?php

use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d H:i:s");

      DB::table("estados")->insert([
          [
              "id"         => 0,
              "nome"       => "",
              "uf"         => "",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 11,
              "nome"       => "Rondônia",
              "uf"         => "RO",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 12,
              "nome"       => "Acre",
              "uf"         => "AC",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 13,
              "nome"       => "Amazonas",
              "uf"         => "AM",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 14,
              "nome"       => "Roraima",
              "uf"         => "RR",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 15,
              "nome"       => "Pará",
              "uf"         => "PA",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 16,
              "nome"       => "Amapá",
              "uf"         => "AP",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 17,
              "nome"       => "Tocantins",
              "uf"         => "TO",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 21,
              "nome"       => "Maranhão",
              "uf"         => "MA",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 22,
              "nome"       => "Piauí",
              "uf"         => "PI",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 23,
              "nome"       => "Ceará",
              "uf"         => "CE",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 24,
              "nome"       => "Rio Grande do Norte",
              "uf"         => "RN",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 25,
              "nome"       => "Paraíba",
              "uf"         => "PB",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 26,
              "nome"       => "Pernambuco",
              "uf"         => "PE",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 27,
              "nome"       => "Alagoas",
              "uf"         => "AL",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 28,
              "nome"       => "Sergipe",
              "uf"         => "SE",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 29,
              "nome"       => "Bahia",
              "uf"         => "BA",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 31,
              "nome"       => "Minas Gerais",
              "uf"         => "MG",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 32,
              "nome"       => "Espírito Santo",
              "uf"         => "ES",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 33,
              "nome"       => "Rio de Janeiro",
              "uf"         => "RJ",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 35,
              "nome"       => "São Paulo",
              "uf"         => "SP",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 41,
              "nome"       => "Paraná",
              "uf"         => "PR",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 42,
              "nome"       => "Santa Catarina",
              "uf"         => "SC",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 43,
              "nome"       => "Rio Grande do Sul",
              "uf"         => "RS",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 50,
              "nome"       => "Mato Grosso do Sul",
              "uf"         => "MS",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 51,
              "nome"       => "Mato Grosso",
              "uf"         => "MT",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 52,
              "nome"       => "Goiás",
              "uf"         => "GO",
              "created_at" => $now,
              "updated_at" => $now,
          ], [
              "id"         => 53,
              "nome"       => "Distrito Federal",
              "uf"         => "DF",
              "created_at" => $now,
              "updated_at" => $now,
          ],
      ]);
    }
}
