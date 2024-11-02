@extends('layouts.admin')
@section ('content')
<div class="row">
    <h1>Registro doctor: {{$doctores->nombres}} {{$doctores->apellidos}}</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos registrados</h3>
            </div>
            <div class="card-body">
                
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

                            </div>
                        </div>
                    </div>
                    </div>
                    <br>
                
            </div>
        </div>
    </div>
</div>

@endsection