<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles =[
            //Roles 
            'SuperAdmin', 'Subdirector', 'Estadista', 'Critico', 'Coordinador', 'Empadronador', 'Digitador'
        ];

        foreach ($roles as $rol) {
            Role::Create(['name'=>$rol]);
        }
       /* 
       $role1 = Role::create(['name'=>'Admin']);
       $Role2 = Role::create(['name'=>'Sistemas']);
       $Role3 = Role::create(['name'=>'Critico']);
       $Role4 = Role::create(['name'=>'Digitador']);
       $Role5 = Role::create(['name'=>'Supervisor']);
       $Role6 = Role::create(['name'=>'Encuestador']);
       */ 

       $permisos =[
        //Usuarios
        'ver_usuario', 
        'editar_usuario', 
        'crear_usuario', 
        'borrar_usuario',
        //Roles 
        'ver_rol', 
        'editar_rol', 
        'crear_rol', 
        'borrar_rol', 
        //Encuetas
        'ver_encuesta', 
        'crear_encuesta',
        'editar_encuesta',
        'borrar_encuesta',
    ];

    foreach ($permisos as $permiso) {
        Permission::Create(['name'=>$permiso]);
    }
    }
}
