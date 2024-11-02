@extends('layouts.admin')
@section ('content')
<div class="row">
    <h1>Registro de paciente: {{$paciente->nombres}} {{$paciente->apellidos}}</h1>
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
                                <p>{{$paciente->nombres}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Apellidos</label>
                                <p>{{$paciente->apellidos}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Dpi</label>
                                <p>{{$paciente->dpi}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Número de Seguro</label>
                                <p>{{$paciente->numero_seguro}}</p>
                            </div>
                        </div>                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Fecha nacimiento</label>
                                <p><p>{{$paciente->fecha_nacimiento}}</p></p>                             
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Género</label>
                                <p>
                                    @if ($paciente->genero=='M') MASCULINO @else FEMENINO @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Celular</label>
                                <p>{{$paciente->celular}}</p>                             
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Correo electronico</label>
                                <p>{{$paciente->correo}}</p>                              
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for = " ">Direccion</label>
                                <p>{{$paciente->direccion}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Grupo sangineo</label>
                                <p>{{$paciente->grupo_sanguineo}}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Alergias</label>
                                <p>
                                @if(empty($paciente->alergias)) Ninguna @else {{$paciente->alergias}}  @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for = " ">Contacto de energencia</label>
                                <p>{{$paciente->contacto_emergencia}}</p>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for = " ">Observaciones</label>
                                <p>
                                @if(empty($paciente->observaciones)) Ninguna @else {{$paciente->observaciones}}  @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('admin/pacientes')}}" class= "btn btn-secondary">Volver</a>
                                
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
</div>

@endsection