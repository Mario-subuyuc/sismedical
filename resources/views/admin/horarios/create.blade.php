@extends('layouts.admin')
@section ('content')
<div class="row">
    <h1>Registro de un nuevo horario</h1>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">LLene los datos</h3>
            </div>
            <div class="card-body row">
                <div class="col-md-3">
                <form action= "{{url('/admin/horarios/create')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for = " ">Consultorio</label><b>*</b>
                                <select name="consultorio_id" id="consultorio_select" class="form-control">
                                    <option value="" disabled selected>Seleccionar Consultorio</option>
                                    @foreach($consultorios as $consultorio)
                                    <option value="{{$consultorio->id}}">{{$consultorio->nombre." - ".$consultorio->ubicacion}}</option>                                    
                                    @endforeach                                    
                                </select>                                
                                <script>
                                    $('#consultorio_select').on('change', function () {
                                        var consultorio_id = $('#consultorio_select').val();
                                        //alert(consultorio_id);

                                        var url = "{{ route('admin.horarios.cargar_datos_consultorios', ':id') }}";
                                        url = url.replace(':id', consultorio_id);

                                        if (consultorio_id) {
                                            $.ajax({
                                                url: url,
                                                type: 'GET',
                                                success: function (data) {
                                                    $('#consultorio_info').html(data);
                                                },
                                                error: function () {
                                                    alert('Error al obtener los datos del consultorio');
                                                }
                                            });
                                        } else {
                                            $('#consultorio_info').html('');
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">    
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for = " ">Doctor</label><b>*</b>
                                <select name="doctor_id" id="doctor" class="form-control">
                                    <option value="" disabled selected>Seleccionar Doctor</option>
                                    @foreach($doctores as $doctore)
                                    <option value="{{$doctore->id}}">{{$doctore->nombres." ".$doctore->apellidos}} - {{$doctore->especialidad}}</option>                                    
                                    @endforeach                                    
                                </select>
                            </div>
                        </div>
                    </div>
                                        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="dia">Día</label><b>*</b>
                                <select name="dia" id="dia" class="form-control">
                                    <option value="" disabled selected>Seleccionar Dia</option>
                                    <option value="LUNES">LUNES</option>
                                    <option value="MARTES">MARTES</option>
                                    <option value="MIERCOLES">MIÉRCOLES</option>
                                    <option value="JUEVES">JUEVES</option>
                                    <option value="VIERNES">VIERNES</option>
                                    <option value="SABADO">SÁBADO</option>
                                    <option value="DOMINGO">DOMINGO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">                       
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for = " ">Hora inicio</label><b>*</b>
                                <input type ="time" value= "{{old('hora_inicio')}}" name= "hora_inicio" class="form-control" required min="08:00" max="19:00">
                                @error('hora_inicio')
                                <small style = "color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>                        
                    </div>
                    
                    <div class="row">                       
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for = " ">Hora final</label><b>*</b>
                                <input type ="time" value= "{{old('hora_fin')}}" name= "hora_fin" class="form-control" required min="09:00" max="20:00">
                                @error('hora_fin')
                                <small style = "color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>                        
                    </div>
                    <hr>                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{url('admin/horarios')}}" class= "btn btn-secondary">Cancelar</a>
                                <button type ="submit" class= "btn btn-primary" >Registar nuevo</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
                </div>
                <div class="col-md-9">
                    <hr>
                    <div id="consultorio_info">
                    </div>    
                </div>                
            </div>            
        </div>        
    </div>    
</div>
@endsection