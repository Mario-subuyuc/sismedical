@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Listado de doctores</h1>
</div>

<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">   
                <h3 class="card-title">Doctores Registradas</h3>
                <div class="card-tools">
                    <a href="{{url('admin/doctores/create')}}" class="btn btn-primary">
                        Registrar nuevo
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-striped table-bordered table-hover  table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="text-align: center">Nro</th>
                            <th scope="col" style="text-align: center">Nombres y apellidos</th>
                            <th scope="col" style="text-align: center">Telefono</th>
                            <th scope="col" style="text-align: center">licencia medica</th>
                            <th scope="col" style="text-align: center">Especialidad</th>
                            <th scope="col" style="text-align: center">Correo</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach($doctores as $doctore)                       
                            <tr> 
                                <td style="text-align: center">{{$loop->iteration}}</td>      
                                <td style="text-align: center">{{$doctore->nombres}} {{$doctore->apellidos}}</td>
                                <td style="text-align: center">{{$doctore->telefono }}</td>
                                <td style="text-align: center">{{$doctore->licencia_medica}}</td>
                                <td style="text-align: center">{{$doctore->especialidad}}</td>
                                <td style="text-align: center">{{$doctore->user->email}}</td>
                                <td style="text-align: center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{url('admin/doctores/'.$doctore->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye">Ver</i></a>
                                    <a href="{{url('admin/doctores/'.$doctore->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i>Editar</a>
                                    <a href="{{url('admin/doctores/'.$doctore->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i>Borrar</a>
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
                                "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "Todos"]], // Configura las opciones de filas por página
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Doctores",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Consultorios",
                                    "infoFiltered": "(Filtrado de _MAX_ total de Doctores)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Doctores  ",
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
@endsection
