<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
 
    public function index()
    {
        $pacientes = Paciente::all();
        return view('admin.pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('admin.pacientes.create');
    }

    
    public function store(Request $request)
    {
        //usado para pruebas en formato json y ver datos de nuevo ingreso de registros  
        // $datos = $request->all();    
        // return response()->json($datos);

        $request->validate([
            'nombres'=>'required|max:100',
            'apellidos'=>'required|max:100',
            'dpi'=>'required|max:20|unique:pacientes,dpi',
            'numero_seguro'=>'required|max:10|unique:pacientes,numero_seguro',
            'fecha_nacimiento'=>'required|max:100',
            'genero'=>'required|max:20',
            'celular'=>'required|max:20',
            'correo'=>'required|max:100|unique:pacientes,correo',
            'direccion'=>'required|max:100',
            'grupo_sanguineo'=>'required|max:10',            
            'contacto_emergencia'=>'required|max:100',            

        ]);

        $paciente = new Paciente();
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->dpi = $request->dpi;
        $paciente->numero_seguro = $request->numero_seguro;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero = $request->genero;
        $paciente->celular = $request->celular;
        $paciente->correo = $request->correo;
        $paciente->direccion = $request->direccion;
        $paciente->grupo_sanguineo = $request->grupo_sanguineo;
        $paciente->alergias = $request->alergias;
        $paciente->contacto_emergencia = $request->contacto_emergencia;
        $paciente->observaciones =  $request->observaciones;
        $paciente->save();

        //$usuario->assignRole('secretaria');

        return redirect()->route(route:'admin.pacientes.index')
        ->with('mensaje','Se registro al paciente correctamente')
        ->with('icono','success');

    }

 
    public function show($id)
    {
        $paciente=Paciente::findOrFail($id);
        return view('admin.pacientes.show', compact('paciente'));
    }

    
    public function edit($id)
    {
        $paciente=Paciente::findOrFail($id);
        return view('admin.pacientes.edit', compact('paciente'));
    }

    
    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);


        $request->validate([
            'nombres' => 'required|max:100',
            'apellidos' => 'required|max:100',
            'dpi' => 'required|max:20|unique:pacientes,dpi,' . $paciente->id,
            'numero_seguro' => 'required|max:10|unique:pacientes,numero_seguro,' . $paciente->id,
            'fecha_nacimiento' => 'required|max:100',
            'genero' => 'required|max:20',
            'celular' => 'required|max:20',
            'correo' => 'required|max:100|unique:pacientes,correo,' . $paciente->id,
            'direccion' => 'required|max:100',
            'grupo_sanguineo' => 'required|max:10',
            'contacto_emergencia' => 'required|max:100',
        ]);

        // Actualiza el paciente
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->dpi = $request->dpi;
        $paciente->numero_seguro = $request->numero_seguro;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero = $request->genero;
        $paciente->celular = $request->celular;
        $paciente->correo = $request->correo;
        $paciente->direccion = $request->direccion;
        $paciente->grupo_sanguineo = $request->grupo_sanguineo;
        $paciente->alergias = $request->alergias;
        $paciente->contacto_emergencia = $request->contacto_emergencia;
        $paciente->observaciones = $request->observaciones;
        $paciente->save();
    
        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', 'Se actualizó al paciente correctamente')
            ->with('icono', 'success');
    

    }

    public function confirmDelete($id)
    {
        $paciente=Paciente::findOrFail($id);
        return view('admin.pacientes.delete', compact('paciente'));
    }


    public function destroy($id)
    {
        try {
            // Intentar eliminar el paciente
            $paciente = Paciente::findOrFail($id);
            $paciente->delete();
    
            // Redirigir al índice de pacientes con un mensaje de éxito
            return redirect()->route('admin.pacientes.index')
                ->with('mensaje', 'El paciente se eliminó correctamente')
                ->with('icono', 'success');
        } catch (\Exception $e) {
            // Si hay un error, redirigir con un mensaje de error
            return redirect()->route('admin.pacientes.index')
                ->with('mensaje', 'Hubo un error al eliminar al paciente')
                ->with('icono', 'error');
        }
    }   
}
