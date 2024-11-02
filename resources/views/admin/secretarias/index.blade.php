@extends('layouts.admin')
@section('content')
<div class="row">
    <h1>Listado de Secretarias</h1>
</div>

<hr>

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary">
            <div class="card-header">   
                <h3 class="card-title">Secretarias Registradas</h3>
                <div class="card-tools">
                    <a href="{{url('admin/secretarias/create')}}" class="btn btn-primary">
                        Registrar nuevo
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-striped table-bordered table-hover  table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="text-align: center">Nro</th>
                            <th scope="col" style="text-align: center">Nombres</th>
                            <th scope="col" style="text-align: center">Apellidos</th>
                            <th scope="col" style="text-align: center">DPI</th>
                            <th scope="col" style="text-align: center">Celular</th>
                            <th scope="col" style="text-align: center">Fecha NAC</th>
                            <th scope="col" style="text-align: center">Direccion</th>
                            <th scope="col" style="text-align: center">Email</th>
                            <th scope="col" style="text-align: center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach($secretarias as $secretaria)                       
                            <tr> 
                                <td style="text-align: center">{{$loop->iteration}}</td>      
                                <td style="text-align: center">{{ $secretaria->nombres }}</td>
                                <td style="text-align: center">{{ $secretaria->apellidos}}</td>
                                <td style="text-align: center">{{ $secretaria->dpi}}</td>
                                <td style="text-align: center">{{ $secretaria->celular}}</td>
                                <td style="text-align: center">{{ $secretaria->fecha_nacimiento}}</td>
                                <td style="text-align: center">{{ $secretaria->direccion}}</td>
                                <td style="text-align: center">{{ $secretaria->user->email }}</td>
                                <td style="text-align: center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{url('admin/secretarias/'.$secretaria->id)}}" type="button" class="btn btn-info btn-sm"><i class="bi bi-eye">Ver</i></a>
                                    <a href="{{url('admin/secretarias/'.$secretaria->id.'/edit')}}" type="button" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i>Editar</a>
                                    <a href="{{url('admin/secretarias/'.$secretaria->id.'/confirm-delete')}}" type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i>Borrar</a>
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
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Secretarias",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Secretarias",
                                    "infoFiltered": "(Filtrado de _MAX_ total de Secretarias)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Secretarias  ",
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
