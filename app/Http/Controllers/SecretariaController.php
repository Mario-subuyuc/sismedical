<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Secretaria;
use App\Models\User;

class SecretariaController extends Controller
{

    public function index()
    {
        $secretarias = Secretaria::with('user')->get();
        return view('admin.secretarias.index', compact('secretarias'));
    }


    public function create()
    {
        return view('admin.secretarias.create');
    }


    public function store(Request $request)
    {
        //usado para pruebas en formato json y ver datos de nuevo ingreso de registros
        //$datos = $request->all();
        //return response()->json($datos);
        $request->validate([
            'nombres'=>'required',
            'apellidos'=>'required',
            'dpi'=>'required|unique:secretarias',
            'celular'=>'required',
            'fecha_nacimiento'=>'required',
            'direccion'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();
        
        $secretaria = new Secretaria();
        $secretaria->user_id = $usuario->id;
        $secretaria->nombres = $request->nombres;  
        $secretaria->apellidos = $request->apellidos;
        $secretaria->dpi  = $request->dpi ;
        $secretaria->celular = $request->celular;
        $secretaria->fecha_nacimiento = $request->fecha_nacimiento;
        $secretaria->direccion = $request->direccion;
        $secretaria->save();

        $usuario->assignRole('secretaria');

        return redirect()->route('admin.secretarias.index')
        ->with('mensaje', 'Se registró al usuario correctamente')
        ->with('icono', 'success');
    
    }

    public function show($id)
    {
        $secretaria=Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.show', compact('secretaria'));
    }

    public function edit($id)
    {
        $secretaria=Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.edit', compact('secretaria'));
    }

    public function update(Request $request, $id)
    {
        // Encuentra la secretaria por su ID
        $secretaria = Secretaria::find($id);
        // Encuentra el usuario relacionado con la secretaria
        $usuario = User::find($secretaria->user_id);

        // Valida los datos
        $request->validate([
            'nombres'=>'required',
            'apellidos'=>'required',
            'dpi'=>'required|unique:secretarias,dpi,' . $secretaria->id, // Asegura que el DPI sea único excepto para la secretaria actual
            'celular'=>'required',
            'fecha_nacimiento'=>'required',
            'direccion'=>'required',
            'email'=>'required|unique:users,email,' . $usuario->id, // Asegura que el email sea único excepto para el usuario actual
            'password'=>'nullable|confirmed', // La contraseña es opcional en este caso, se valida solo si está presente
        ]);

        // Actualiza los datos de la secretaria
        $secretaria->nombres = $request->nombres;  
        $secretaria->apellidos = $request->apellidos;
        $secretaria->dpi  = $request->dpi;
        $secretaria->celular = $request->celular;
        $secretaria->fecha_nacimiento = $request->fecha_nacimiento;
        $secretaria->direccion = $request->direccion;
        $secretaria->save();

        // Actualiza los datos del usuario
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;

        // Solo actualiza la contraseña si está presente
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        // Redirige con mensaje de éxito
        return redirect()->route('admin.secretarias.index')
            ->with('mensaje', 'Se actualizó al usuario correctamente')
            ->with('icono', 'success');
    }

    public function confirmDelete ($id){ 
        $secretaria=Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.delete', compact('secretaria')); 
    }

    public function destroy($id)
{
    // Buscar la secretaria por ID
    $secretaria = Secretaria::find($id);
    
    // Verificar si se encuentra la secretaria
    if ($secretaria) {
        // Obtener el usuario relacionado con la secretaria
        $user = $secretaria->user;
        // Eliminar el usuario si existe
        if ($user) {
            $user->delete();
        }
        // Eliminar la secretaria
        $secretaria->delete();
        
        // Redirigir con mensaje de éxito
        return redirect()->route('admin.secretarias.index')
            ->with('mensaje', 'Se eliminó al usuario correctamente')
            ->with('icono', 'success');
    }
    // Si no se encuentra la secretaria, redirigir con mensaje de error
    return redirect()->route('admin.secretarias.index')
        ->with('mensaje', 'No se encontró la secretaria')
        ->with('icono', 'error');
    }

}
