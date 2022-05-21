<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        //Usuario admin
        User::factory(1)->create([
            "username" => "dev",
            "name" => "Developer",
            "password" => bcrypt("admin")
        ])->each(function (User $user){
            $user->syncRoles([Role::DEVELOPER]);
            $user->options()->sync(Option::pluck('id')->toArray());
            $user->shortcuts()->sync([
                3,//Usuarios
                4,//Roles
                5,//Permisos
                6,//Configuraciones
                12,//Tipos pago
                13,//Buscar recibos
                14,//Crear Recibo
            ]);
        });

        User::factory(1)->create([
            "username" => "Super",
            "name" => "Super Admin",
            "password" => bcrypt("123")
        ])->each(function (User $user){
            $user->syncRoles(Role::SUPERADMIN);
            $user->shortcuts()->sync([
                3,//Usuarios
                4,//Roles
                6,//Configuraciones
                13,//Buscar recibos
                14,//Crear Recibo
            ]);

        });

        User::factory(1)->create([
            "username" => "Admin",
            "name" => "Administrador",
            "password" => bcrypt("123")
        ])->each(function (User $user){
            $user->syncRoles(Role::ADMIN);
            $user->shortcuts()->sync([
                3,//Usuarios
                4,//Roles
                6,//Configuraciones
                12,//Tipos pago
                13,//Buscar recibos
                14,//Crear Recibo
            ]);

        });

        User::factory(1)->create([
            "username" => "lector",
            "name" => "LECTOR",
            "password" => bcrypt("123")
        ])->each(function (User $user){
            $user->syncRoles(Role::LECTOR);
            $user->shortcuts()->sync([
                13,//Buscar recibos
            ]);

        });

    }
}
