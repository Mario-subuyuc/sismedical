<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{

    public function index()
    {
        $doctores = Doctor::with('user')->get();
        return view('admin.doctores.index', compact('doctores'));
    }


    public function create()
    {
        return view('admin.doctores.create');
    }


    public function store(Request $request)
    {
        //$datos=request()->all();
        //return response()->json($datos);

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'licencia_medica' => 'required',
            'especialidad' => 'required',
            'email' => 'required|max:250|unique:users',
            'password' => 'required|max:250|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();
        //manera clasica
        // $doctor = new Doctor();
        // $doctor->user_id = $usuario->id; // Asigna el user_id del usuario creado
        // $doctor->nombres = $request->nombres;
        // $doctor->apellidos = $request->apellidos;
        // $doctor->telefono = $request->telefono;
        // $doctor->licencia_medica = $request->licencia_medica;
        // $doctor->especialidad = $request->especialidad;

        // // Guardar el doctor en la base de datos
        // $doctor->save();

        // return redirect()->route('admin.doctores.index')
        // ->with('mensaje', 'Se registró al usuario correctamente')
        // ->with('icono', 'success'); 


        if ($usuario->id) {
            // Crear el doctor y asignar el user_id del usuario recién creado
            Doctor::create([
                'user_id' => $usuario->id, // Aquí se asigna el user_id correctamente
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,
                'telefono' => $request->telefono,
                'licencia_medica' => $request->licencia_medica,
                'especialidad' => $request->especialidad,
            ]);

            $usuario->assignRole('doctor');

            // Redirección con mensaje de éxito
            return redirect()->route('admin.doctores.index')
                ->with('mensaje', 'Se registró al doctor correctamente')
                ->with('icono', 'success');
        } else {
            // Manejar el caso si el usuario no fue creado correctamente
            return back()->with('error', 'Hubo un problema al crear el usuario.');
        }
    }


    public function show($id)
    {
        $doctores = Doctor::findOrFail($id);
        return view('admin.doctores.show', compact('doctores'));
    }


    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctores.edit', compact('doctor'));
    }


    public function update(Request $request, $id)
    {
        // Encuentra el doctor por su ID
        $doctor = Doctor::find($id);
        // Encuentra el usuario relacionado con el doctor
        $usuario = User::find($doctor->user_id);

        // Valida los datos
        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'licencia_medica' => 'required',
            'especialidad' => 'required',
            'email' => 'required|unique:users,email,' . $usuario->id, // Asegura que el email sea único excepto para el usuario actual
            'password' => 'nullable|confirmed', // La contraseña es opcional
        ]);

        // Actualiza los datos del doctor
        $doctor->nombres = $request->nombres;
        $doctor->apellidos = $request->apellidos;
        $doctor->telefono = $request->telefono;
        $doctor->licencia_medica = $request->licencia_medica;
        $doctor->especialidad = $request->especialidad;
        $doctor->save();

        // Actualiza los datos del usuario
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;

        // Solo actualiza la contraseña si está presente
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        // Redirige con mensaje de éxito
        return redirect()->route('admin.doctores.index')
            ->with('mensaje', 'Se actualizó al doctor correctamente')
            ->with('icono', 'success');
    }


    public function confirmDelete($id)
    {
        $doctores = Doctor::findOrFail($id);
        return view('admin.doctores.delete', compact('doctores'));
    }


    public function destroy($id)
    {
        // Encuentra el doctor por su ID
        $doctor = Doctor::find($id);

        if ($doctor) {
            // Encuentra el usuario relacionado con el doctor
            $user = $doctor->user;

            if ($user) {
                // Elimina el usuario y luego el doctor
                $user->delete();
            }

            // Elimina el doctor
            $doctor->delete();

            return redirect()->route('admin.doctores.index')
                ->with('mensaje', 'Se eliminó al doctor correctamente')
                ->with('icono', 'success');
        } else {
            return redirect()->route('admin.doctores.index')
                ->with('error', 'Doctor no encontrado');
        }
    }
}
