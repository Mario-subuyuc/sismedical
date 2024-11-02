@extends('layouts.admin')
@section ('content')
<div class="row">
<h1>Bienvenido {{ Auth::user()->email }}     /Rol: {{ Auth::user()->roles->pluck('name')->first() }}</h1>

</div>
<hr>
<div class="row">
    @can('admin.usuarios.index')
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{$total_usuarios}}</h3>
                <p>Usuarios</p>
            </div>
            <div class="icon">
                <i class="ion fas bi bi-people-fill"></i>
            </div>
            <a href="{{url('admin/usuarios')}}" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endcan

    @can('admin.secretarias.index')
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{$total_secretarias}}</h3>
                <p>secretarias</p>
            </div>
            <div class="icon">
                <i class="ion fas bi bi-pc-display"></i>
            </div>
            <a href="{{url('admin/secretarias')}}" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endcan

    @can('admin.pacientes.index')
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$total_pacientes}}</h3>
                <p>Pacientes</p>
            </div>
            <div class="icon">
                <i class="ion fas bi bi-clipboard2-pulse"></i>
            </div>
            <a href="{{url('admin/pacientes')}}" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endcan

    @can('admin.consultorios.index')
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$total_consultorios}}</h3>
                <p>Consultorio</p>
            </div>
            <div class="icon">
                <i class="ion fas bi bi-hospital"></i>
            </div>
            <a href="{{url('admin/consultorios')}}" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endcan

    @can('admin.doctores.index')
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$total_doctores}}</h3>
                <p>Doctores</p>
            </div>
            <div class="icon">
                <i class="ion fas bi bi-heart-pulse-fill"></i>
            </div>
            <a href="{{url('admin/doctores')}}" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endcan

    @can('admin.horarios.index')
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{$total_horarios}}</h3>
                <p>Horarios</p>
            </div>
            <div class="icon">
                <i class="ion fas bi bi-calendar3 "></i>
            </div>
            <a href="{{url('admin/horarios')}}" class="small-box-footer">Más Información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    @endcan
</div>

@can('cargar_datos_consultorios')
<!-- horarios consultorios -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header row ">
                <div class="col-md-8">
                    <h3 class="card-title">Calendario de atención de doctores</h3>
                </div>
                <div class="col-md-4"><label>Consultorio</label>
                    <select name="consultorio_id" id="consultorio_select" class="form-control">
                        <option value="" disabled selected>Seleccionar Consultorio</option>
                        @foreach($consultorios as $consultorio)
                        <option value="{{ $consultorio->id }}">{{ $consultorio->nombre . " - " . $consultorio->ubicacion }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body">
                <script>
                    $('#consultorio_select').on('change', function() {
                        var consultorio_id = $('#consultorio_select').val();
                        //alert(consultorio_id);

                        var url = "{{ route('cargar_datos_consultorios', ':id') }}";
                        url = url.replace(':id', consultorio_id);

                        if (consultorio_id) {
                            $.ajax({
                                url: url,
                                type: 'GET',
                                success: function(data) {
                                    $('#consultorio_info').html(data);
                                },
                                error: function() {
                                    alert('Error al obtener los datos del consultorio');
                                }
                            });
                        } else {
                            $('#consultorio_info').html('');
                        }
                    });
                </script>
                <div id="consultorio_info">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- calendario doctor -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-warning">
            <div class="card-header row ">
                <div class="col-md-8">
                    <h3 class="card-title">Calendario de reservar cita</h3>
                </div>
                <div class="col-md-4"><label>Doctores</label>
                    <select name="doctor_id" id="doctor_select" class="form-control">
                        <option value="" disabled selected>Selecciona tu doctor</option>
                        @foreach($doctores as $doctore)
                        <option value="{{ $doctore->id }}">{{ $doctore->nombres. " - " . $doctore->apellidos . " - " . $doctore->especialidad }}</option>
                        @endforeach
                    </select>
                    <script>
                        $('#doctor_select').on('change', function() {
                            var doctor_id = $('#doctor_select').val();
                            //alert(doctor_id);

                            var url = "{{ route('cargar_reserva_doctores', ':id') }}";
                            url = url.replace(':id', doctor_id);

                            // calendario con doctores

                            var calendarEl = document.getElementById('calendar');
                            var eventos = [];
                            var calendar = new FullCalendar.Calendar(calendarEl, {
                                initialView: 'dayGridMonth',
                                locale: 'es',
                                events: [

                                ]
                            });
                            if (doctor_id) {
                                $.ajax({
                                    url: url,
                                    type: 'GET',
                                    dataType: 'json',
                                    success: function(data) {
                                        //$('#consultorio_info').html(data);
                                        calendar.addEventSource(data);
                                    },
                                    error: function() {
                                        alert('Error al obtener los datos del consultorio');
                                    }
                                });
                            } else {
                                $('#doctor_info').html('');
                            }
                            calendar.render();
                        });
                    </script>
                </div>
            </div>


            <div class="card-body">
                <div class="row">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Registar cita medica
                    </button>

                    <a href="{{url('/admin/ver_reservas',Auth::user()->id)}}" class="btn btn-success"><i class="bi bi-calendar-check"></i> ver tus reservas</a>

                    <!-- Modal -->
                    <form action="{{url('/admin/eventos/create')}}" method="post">
                        @csrf
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reserva de cita medica</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Doctor</label>
                                                    <select name="doctor_id" id="" class="form-control" required>
                                                        <option value="" disabled selected>Seleccione un doctor</option>
                                                        @foreach($doctores as $doctore)
                                                        <option value="{{$doctore->id}}">
                                                            {{$doctore->nombres." ". $doctore->apellidos." ". $doctore->especialidad}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Fecha de reserva</label>
                                                    <input type="date" name="fecha_reserva" value="<?php echo date('Y-m-d') ?>" id="fecha_reserva" class="form-control">
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            const fechaReservaInput = document.getElementById('fecha_reserva');

                                                            // Escuchar el evento de cambio en el campo de fecha de reserva
                                                            fechaReservaInput.addEventListener('change', function() {
                                                                let selectedDate = this.value; // Obtener la fecha seleccionada

                                                                // Obtener la fecha actual en formato ISO (yyyy-mm-dd)
                                                                let today = new Date().toISOString().slice(0, 10);

                                                                // Verificar si la fecha seleccionada es anterior a la fecha actual
                                                                if (selectedDate < today) {
                                                                    // Si es así, establecer la fecha seleccionada en null
                                                                    this.value = null;
                                                                    alert('No puede seleccionar una fecha pasada.');
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Hora de reserva</label>
                                                    <input type="time" name="hora_reserva" id="hora_reserva" class="form-control" min="08:00" max="19:00">
                                                    @error('hora_reserva')
                                                    <small style="color:red">{{$message}}</small>
                                                    @enderror
                                                    @if( (($message = Session::get('mensaje') )) )
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            $('#exampleModal').modal('show');
                                                        });
                                                    </script>
                                                    <small style="color:red">{{$message}}</small>
                                                    @endif
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            const horaReservaInput = document.getElementById('hora_reserva');

                                                            horaReservaInput.addEventListener('change', function() {
                                                                let selectedTime = this.value; // Obtener el valor de la hora seleccionada

                                                                // Asegurar que solo se capture la parte de la hora
                                                                if (selectedTime) {
                                                                    selectedTime = selectedTime.split(':'); // Dividir la cadena en horas y minutos
                                                                    selectedTime = selectedTime[0] + ':00'; // Conservar solo la hora, ignorar los minutos
                                                                    this.value = selectedTime; // Establecer la hora modificada en el campo de entrada
                                                                }

                                                                // Verificar si la hora seleccionada está fuera del rango permitido
                                                                if (selectedTime < '08:00' || selectedTime > '19:00') {
                                                                    // Si es así, establecer la hora seleccionada en null
                                                                    this.value = null;
                                                                    alert('Por favor, seleccione una hora entre las 08:00 y las 19:00.');
                                                                }
                                                            });
                                                        });
                                                    </script>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Registar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>
@endcan



@if(Auth::check() && Auth::user()->doctor)
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header row ">
                <div class="col-md-8">
                    <h3 class="card-title">Calendario de reservas</h3>
                </div>                
            </div>
            <div class="card-body">
                
            <table id="example1" class="table table-striped table-bordered table-hover  table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="text-align: center">Nro</th>
                            <th scope="col" style="text-align: center">Usuario</th>
                            <th scope="col" style="text-align: center">Fecha de reserva</th>
                            <th scope="col" style="text-align: center">Hora de reserva</th>
                            
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach($eventos as $evento)
                        @if(Auth::user()->doctor->id== $evento->doctor_id)
                        <tr> 
                                <td style="text-align: center">{{$loop->iteration}}</td>      
                                <td style="text-align: center">{{$evento->user->name}}</td>
                                <td style="text-align: center">{{\Carbon\Carbon::parse($evento->start)->format('Y-m-d')}}</td>
                                <td style="text-align: center">{{\Carbon\Carbon::parse($evento->start)->format('H:i')}}</td>               
                        </tr>
                        @endif                
                            
                        @endforeach
                    </tbody>
                </table>               
                <script>
                    $(function () {
                            $("#example1").DataTable({
                                "pageLength": 5,
                                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Todos"]], // Configura las opciones de filas por página
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Reservas",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Reservas",
                                    "infoFiltered": "(Filtrado de _MAX_ total de Reservas)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Reservas  ",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "responsive": true, "lengthChange": true, "autoWidth": false,
                                buttons: [{
                                    extend: 'collection',
                                    text: 'Reportes',
                                    orientation: 'landscape',
                                    buttons: [{
                                        text: 'Copiar',
                                        extend: 'copy',
                                    }, {
                                        extend: 'pdf'
                                    },{
                                        extend: 'csv'
                                    },{
                                        extend: 'excel'
                                    },{
                                        text: 'Imprimir',
                                        extend: 'print'
                                    }
                                    ]
                                },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        collectionLayout: 'fixed three-column'
                                    }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                </script>                
            </div>
        </div>
    </div>
</div>
@endif



@endsection