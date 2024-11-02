@extends('layouts.admin')
@section ('content')
<div class="row">
    <h1>Eliminar doctor: {{$doctores->nombres}} {{$doctores->apellidos}}</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">¿Desea eliminar este registro?</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/admin/doctores',$doctores->id)}}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este doctor?');">
                    @csrf
                    @method ('DELETE')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Nombres</label>
                                <p>{{$doctores->nombres}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Apelllidos</label>
                                <p>{{$doctores->apellidos}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Telefono</label>
                                <p>{{$doctores->telefono}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Licencia medica</label>
                                <p>{{$doctores->licencia_medica}}</p>                                
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Especialidad</label>
                                <p>{{$doctores->especialidad}}</p>                                
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Email </label>
                                <p>{{$doctores->user->email}}</p>
                            </div>
                        </div> 
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('admin/doctores')}}" class= "btn btn-secondary">Cancelar</a>
                                <button type="submmit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                    </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection