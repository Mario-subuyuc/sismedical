<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{

    public function index()
    {
        $consultorios = Consultorio::all();
        return view('admin.consultorios.index', compact('consultorios'));
    }


    public function create()
    {
        return view('admin.consultorios.create');
    }


    public function store(Request $request)
    {
        //     $datos = request()->all();
        //     return response()->json($datos);
        $request->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'capacidad' => 'required',

            'especialidad' => 'required',
            'estado' => 'required',
        ]);

        //usando el protected de modelo consolutorio
        Consultorio::create($request->all());

        return redirect()->route('admin.consultorios.index')
            ->with('mensaje', 'Se registró al consultorio correctamente')
            ->with('icono', 'success');
    }


    public function show($id)
    {
        $consultorio = Consultorio::findOrfail($id);
        return view('admin.Consultorios.show', compact('consultorio'));
    }


    public function edit($id)
    {
        $consultorio = Consultorio::findOrfail($id);
        return view('admin.Consultorios.edit', compact('consultorio'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'capacidad' => 'required',

            'especialidad' => 'required',
            'estado' => 'required',
        ]);
        $consultorio = Consultorio::findOrfail($id);
        $consultorio->update($request->all());

        return redirect()->route('admin.consultorios.index')
            ->with('mensaje', 'Se actualizo al consultorio correctamente')
            ->with('icono', 'success');
    }


    public function confirmDelete($id)
    {
        $consultorio = Consultorio::findOrfail($id);
        return view('admin.Consultorios.delete', compact('consultorio'));
    }

    public function destroy($id)
    {
        // Encuentra el consultorio por su ID o falla si no existe
        $consultorio = Consultorio::findOrFail($id);

        // Elimina el consultorio usando el método delete()
        $consultorio->delete();

        // Redirige con un mensaje de éxito
        return redirect()->route('admin.consultorios.index')
            ->with('mensaje', 'Se eliminó correctamente')
            ->with('icono', 'success');
    }
}
