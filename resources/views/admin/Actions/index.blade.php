@extends('adminlte::page')

@section('title', 'Horario')

@section('content')
    <div class="p-3"></div>
    <div class="card">
        <div class="card-header">
            <button class="btn btn-success float-right" id="btnNuevo"><i class="fas fa-plus-circle"></i> Agregar actividad</button>

            <div>
                <strong>Dia del horario:</strong> {{ $hor->day }} 
            </div>
            {{-- <div>
                <strong>Fecha de mantenimiento:</strong> Inicio: {{ $act->startdate }} | Fin: {{ $act->lastdate }} 
            </div> --}}

        </div>
        <div class="card-body">
            <div>
                <h4>Listado de actividades</h4>
            </div>
            <div class="row">

            </div>
            <div class="col-12 card" style="min-height: 50px">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>FECHA</th>
                                <th>DESCRIPCION</th>
                                <th width=20></th>
                                <th width=20></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($actions as $acti)
                                <tr>
                                    <td>{{ $acti->id }}</td>
                                    <td>{{ $acti->date }}</td>
                                    <td>{{ $acti->description }}</td>
                                    <td>
                                        <button class="btnEditar btn btn-primary" id="{{ $acti->id }}">
                                            <i class="fa fa-edit"></i></button>
                                    </td>
                                    <td>
                                        <form action="{{route('admin.actions.destroy', $acti->id)}}" method="POST" class="fmrEliminar">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="card" style="min-height: 50px">
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer"></div>
    </div>

    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro de actividad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        $('#datatable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            }
        });

        $('#btnNuevo').click(function() {
        $.ajax({
            url: "{{ route('admin.actions.create') }}",
            type: "GET",
            success: function(response) {
                $('#formModal .modal-body').html(response);
                $('#formModal').modal('show');
            }
        })
    });

        $(".btnEditar").click(function() {
            var id = $(this).attr('id');
            $.ajax({

                url: "{{ route('admin.actions.edit', '_id') }}".replace('_id', id),
                type: "GET",
                success: function(response) {
                    $('#formModal .modal-body').html(response);
                    $('#formModal').modal('show');
                }
            });

        });

        $(".fmrEliminar").submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: "Seguro de eliminar?",
                text: "Esta accion es irreversible!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>

    @if (session('success') !== null)
        <script>
            Swal.fire({
                title: "Proceso Exitoso",
                text: "{{ session('success') }}",
                icon: "success"
            });
        </script>
    @endif

    @if (session('error') !== null)
        <script>
            Swal.fire({
                title: "Error de proceso",
                text: "{{ session('error') }}",
                icon: "error"
            });
        </script>
    @endif


@stop
