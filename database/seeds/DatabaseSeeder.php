<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(Tipo_MascotaTableSeeder::class);
        $this->call(Tipo_MedicamentoSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
