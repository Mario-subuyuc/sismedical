@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Listado de Horarios</h1>
</div>

<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">   
                <h3 class="card-title">Horarios Registrados</h3>
                <div class="card-tools">
                    <a href="{{url('admin/horarios/create')}}" class="btn btn-primary">
                        Registrar nuevo
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-striped table-bordered table-hover  table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="text-align: center">Nro</th>
                            <th scope="col" style="text-align: center">Doctor</th>
                            <th scope="col" style="text-align: center">Especialidad</th>
                            <th scope="col" style="text-align: center">Consultorio</th>
                            <th scope="col" style="text-align: center">Día de atención</th>
                            <th scope="col" style="text-align: center">Hora inicio</th>
                            <th scope="col" style="text-align: center">Hora fin</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach($horarios as $horario)
                            <tr> 
                                <td style="text-align: center">{{$loop->iteration}}</td>      
                                <td style="text-align: center">{{$horario->doctor->nombres}} {{$horario->doctor->apellidos}} </td>
                                <td style="text-align: center">{{$horario->doctor->especialidad}}</td>
                                <td style="text-align: center">{{$horario->consultorio->nombre}} {{$horario->consultorio->ubicacion}}</td>
                                <td style="text-align: center">{{$horario->dia}}</td>
                                <td style="text-align: center">{{$horario->hora_inicio}}</td>
                                <td style="text-align: center">{{$horario->hora_fin}}</td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('admin/horarios/'.$horario->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye">Ver</i></a>
                                        <a href="{{url('admin/horarios/'.$horario->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i>Editar</a>
                                        <a href="{{url('admin/horarios/'.$horario->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i>Borrar</a>
                                    </div>
                                </td>       
                            </tr>
                        @endforeach
                    </tbody>
                </table>               
                <script>
                    $(function () {
                        $("#example1").DataTable({
                            "pageLength": 5,
                            "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Todos"]],
                            "language": {
                                "emptyTable": "No hay información",
                                "info": "Mostrando _START_ a _END_ de _TOTAL_ horarios",
                                "infoEmpty": "Mostrando 0 a 0 de 0 horarios",
                                "infoFiltered": "(Filtrado de _MAX_ total de horarios)",
                                "lengthMenu": "Mostrar _MENU_ horarios",
                                "loadingRecords": "Cargando...",
                                "processing": "Procesando...",
                                "search": "Buscador:",
                                "zeroRecords": "Sin resultados encontrados",
                                "paginate": {
                                    "first": "Primero",
                                    "last": "Último",
                                    "next": "Siguiente",
                                    "previous": "Anterior"
                                }
                            },
                            "responsive": true,
                            "lengthChange": true,
                            "autoWidth": false,
                            buttons: [{
                                extend: 'collection',
                                text: 'Reportes',
                                orientation: 'landscape',
                                buttons: [
                                    { text: 'Copiar', extend: 'copy' },
                                    { extend: 'pdf' },
                                    { extend: 'csv' },
                                    { extend: 'excel' },
                                    { text: 'Imprimir', extend: 'print' }
                                ]
                            },
                            {
                                extend: 'colvis',
                                text: 'Visor de columnas',
                                collectionLayout: 'fixed three-column'
                            }]
                        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    });
                </script>
            </div>
        </div>   
    </div>    
</div>

<!-- Calendario de atención de doctores -->
<div class="row">
    <div class="col-md-12"> 
        <div class="card card-outline card-primary">
            <div class="card-header row ">   
                <div class="col-md-8"><h3 class="card-title">Calendario de atención de doctores</h3> 
                </div>                  
                  <div class="col-md-4"><label >Consultorio</label>
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
                <div id="consultorio_info">
                </div>                               
            </div>
        </div>
    </div>
</div>
@endsection
