<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(NivelSeeder::class);
        $this->call(SituacaoSeeder::class);
        $this->call(PracaSeeder::class);
        $this->call(PermissaoSeeder::class);


    }
}
