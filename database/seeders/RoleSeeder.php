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

        //seeder para roles y permisos   admin, secretaria, doctor, paciente, usuario
        $admin = Role::create(['name' => 'admin']);
        $secretaria = Role::create(['name' => 'secretaria']);
        $doctor = Role::create(['name' => 'doctor']);
        $paciente = Role::create(['name' => 'paciente']);
        $usuario = Role::create(['name' => 'usuario']);

        Permission::create(['name' => 'admin.index']);

        // Ruta para admin/usuarios
        Permission::Create(['name' => 'admin.usuarios.index'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.usuarios.create'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.usuarios.store'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.usuarios.show'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.usuarios.edit'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.usuarios.update'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.usuarios.confirmDelete'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.usuarios.destroy'])->syncRoles($admin);

        //rutas admin/secretarias
        Permission::Create(['name' => 'admin.secretarias.index'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.secretarias.create'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.secretarias.store'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.secretarias.show'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.secretarias.edit'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.secretarias.update'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.secretarias.confirmDelete'])->syncRoles($admin);
        Permission::Create(['name' => 'admin.secretarias.destroy'])->syncRoles($admin);

        //rutas admin/pacientes
        Permission::Create(['name' => 'admin.pacientes.index'])->syncRoles($admin, $secretaria,$doctor);
        Permission::Create(['name' => 'admin.pacientes.create'])->syncRoles($admin, $secretaria,$doctor);
        Permission::Create(['name' => 'admin.pacientes.store'])->syncRoles($admin, $secretaria,$doctor);
        Permission::Create(['name' => 'admin.pacientes.show'])->syncRoles($admin, $secretaria,$doctor);
        Permission::Create(['name' => 'admin.pacientes.edit'])->syncRoles($admin, $secretaria,$doctor);
        Permission::Create(['name' => 'admin.pacientes.update'])->syncRoles($admin, $secretaria,$doctor);
        Permission::Create(['name' => 'admin.pacientes.confirmDelete'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.pacientes.destroy'])->syncRoles($admin, $secretaria);

        //rutas admin/consultorios
        Permission::Create(['name' => 'admin.consultorios.index'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.consultorios.create'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.consultorios.store'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.consultorios.show'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.consultorios.edit'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.consultorios.update'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.consultorios.confirmDelete'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.consultorios.destroy'])->syncRoles($admin, $secretaria);

        //rutas admin/doctores
        Permission::Create(['name' => 'admin.doctores.index'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.doctores.create'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.doctores.store'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.doctores.show'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.doctores.edit'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.doctores.update'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.doctores.confirmDelete'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.doctores.destroy'])->syncRoles($admin, $secretaria);

        //rutas admin/horarios
        Permission::Create(['name' => 'admin.horarios.index'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.horarios.create'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.horarios.store'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.horarios.show'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.horarios.edit'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.horarios.update'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.horarios.confirmDelete'])->syncRoles($admin, $secretaria);
        Permission::Create(['name' => 'admin.horarios.destroy'])->syncRoles($admin, $secretaria);


        // ajax
        Permission::Create(['name' => 'admin.horarios.cargar_datos_consultorios'])->syncRoles($admin, $secretaria);        
        //persimos de usuarios
        Permission::Create(['name' => 'cargar_datos_consultorios'])->syncRoles($admin, $usuario,$secretaria);
        Permission::Create(['name' => 'cargar_reserva_doctores'])->syncRoles($admin, $usuario,$secretaria);
        Permission::Create(['name' => 'ver_reservas'])->syncRoles($admin, $usuario,$secretaria);
        Permission::Create(['name' => 'admin.eventos.create'])->syncRoles($admin, $usuario,$secretaria);
        Permission::Create(['name' => 'admin.eventos.destroy'])->syncRoles($admin, $usuario,$secretaria);

    }
}
