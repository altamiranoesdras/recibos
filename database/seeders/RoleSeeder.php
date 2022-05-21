<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(["name" => "Developer"]);
        Role::create(["name" => "Superadmin"]);

        $role= Role::create(["name" => "Admin"]);
        $role->options()->sync([
            3,//Usuarios
            4,//Roles
            6,//Configuraciones
            13,//Buscar recibos
            14,//Crear Recibo
        ]);
        $role->syncPermissions(Permission::pluck('name')->toArray());

        $role = Role::create(["name" => "Lector"]);

        $role->options()->sync([
            13,//Buscar recibos
        ]);

        $role->syncPermissions([
            'Ver configuración',
            'Ver usuarios',
            'Ver Recibos',
            'Ver Tipo Pago',
        ]);


    }
}
