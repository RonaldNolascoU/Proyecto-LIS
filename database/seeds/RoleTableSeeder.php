<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Veterinario';
        $role->save();

        $role = new Role();
        $role->name = 'Secretaria';
        $role->save();

        $role = new Role();
        $role->name = 'Administrador';
        $role->save();
    }
}
