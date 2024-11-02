<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Consultorio;
use App\Models\Horario;
use App\Models\Secretaria;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
//use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([RoleSeeder::class,]);

        //administrador
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('admin');

        //secretaria
        User::create([
            'name' => 'Secretaria',
            'email' => 'secretaria@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('secretaria');

        Secretaria::create([
            'nombres' => 'Secretaria',
            'apellidos' => '1',
            'dpi' => '111111',
            'celular' => '777777777',
            'fecha_nacimiento' => '10/10/2000',
            'direccion' => 'Zona Miraflores calle 5',
            'user_id' => 2
        ]);

        //Doctor
        User::create([
            'name' => 'Doctor1',
            'email' => 'doctor1@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('doctor');
        Doctor::create([
            'nombres' => 'Doctor1',
            'apellidos' => 'Swift',
            'telefono' => '747774631',
            'licencia_medica' => '8871734',
            'especialidad' => 'PEDIATRIA',
            'user_id' => '3'
        ]);

        User::create([
            'name' => 'Doctor2',
            'email' => 'doctor2@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('doctor');
        Doctor::create([
            'nombres' => 'Doctor2',
            'apellidos' => 'Barrientos',
            'telefono' => '747774648',
            'licencia_medica' => '1597453',
            'especialidad' => 'CARDIOLOGIA',
            'user_id' => '4'
        ]);

        User::create([
            'name' => 'Doctor3',
            'email' => 'doctor3@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('doctor');
        Doctor::create([
            'nombres' => 'Doctor3',
            'apellidos' => 'Valdez',
            'telefono' => '747778631',
            'licencia_medica' => '8846734',
            'especialidad' => 'NEUROLOGIA',
            'user_id' => '5'
        ]);

        //consultorio
        Consultorio::create([
            'nombre' => 'Chimaltenango',
            'ubicacion' => '1 1A',
            'capacidad' => '10',
            'telefono' => '',
            'especialidad' => 'PEDIATRIA',
            'estado' => 'ACTIVO'
        ]);
        Consultorio::create([
            'nombre' => 'Guatemala Z10',
            'ubicacion' => '2 1A',
            'capacidad' => '15',
            'telefono' => '78965421',
            'especialidad' => 'CARDIOLOGIA',
            'estado' => 'ACTIVO'
        ]);
        Consultorio::create([
            'nombre' => 'Quetzaltenango',
            'ubicacion' => '3 1A',
            'capacidad' => '11',
            'telefono' => '15975364',
            'especialidad' => 'NEUROLOGIA',
            'estado' => 'ACTIVO'
        ]);


        //paciente
        User::create([
            'name' => 'Paciente1',
            'email' => 'paciente1@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('paciente');

        //usuario random
        User::create([
            'name' => 'Usuario1',
            'email' => 'usuario1@admin.com',
            'password' => Hash::make(value: '12345678')
        ])->assignRole('usuario');

    
        
        $this->call([PacienteSeeder::class,]);


        //crecion de horarios
        Horario::create([

            'dia' =>'LUNES',
            'hora_inicio' =>'08:00:00',
            'hora_fin' => '14:00:00',
            'doctor_id' => '1',
            'consultorio_id' =>'1',
        ]);

    }
}
