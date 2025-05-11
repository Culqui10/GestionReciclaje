@extends('adminlte::page')

@section('title', 'Vehiculos')


@section('content')
    <div class="p-2">

        <?php if ($errors->any()) : ?>
        <?php foreach ($errors->all() as $e) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endforeach;
    endif;
    ?>
    </div>
    <div class="card">
        <div class="card-header">
            <!--<a href="{{ route('admin.vehicles.create') }}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i> Registrar</a>-->
            <button class="btn btn-success float-right" id="btnNuevo"><i class="fas fa-plus-circle"></i> Registrar</button>
            <h4>Listado de vehículos</h4>
        </div>
        <div class="card-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>IMÁGEN</th>
                        <th>NOMBRE</th>
                        <th>MARCA</th>
                        <th>MODELO</th>
                        <th>TIPO</th>
                        <th>PLACA</th>
                        <th width=20></th>
                        <th width=20></th>
                        <th width=20></th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->id }}</td>

                            <td><img src="<?php echo $vehicle->image == '' ? 'https://e7.pngegg.com/pngimages/529/46/png-clipart-car-door-silhouette-front-compact-car-white-thumbnail.png' : $vehicle->image; ?>" width="50">
                            </td>
                            <td>{{ $vehicle->vname }}</td>
                            <td>{{ $vehicle->bname }}</td>
                            <td>{{ $vehicle->bmname }}</td>
                            <td>{{ $vehicle->vtname }}</td>
                            <td>{{ $vehicle->plate }}</td>
                            <td>
                                <a href="{{ route('admin.vehicles.show', $vehicle->id) }}"
                                    class="btn btn-secondary btn-sm"><i class="fas fa-user-plus"></i></a>
                            </td>

                            <td><!--<a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>-->
                                <button class="btnEditar btn btn-primary btn-sm" id={{ $vehicle->id }}><i
                                        class="fa fa-edit"></i></button>
                            </td>
                            <td>
                                <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST"
                                    class="fmrEliminar">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </form>
                            </td>


                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer">

        </div>
    </div>


    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de vehículo</h5>
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
    @livewireStyles
@stop

@section('js')
    @livewireScripts
    @vite(['resources/js/app.js'])
    <script>
        $('#datatable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            }
        });

        $('#btnNuevo').click(function() {
            $.ajax({
                url: "{{ route('admin.vehicles.create') }}",
                type: "GET",
                success: function(response) {
                    $('#formModal .modal-body').html(response);
                    $('#formModal').modal('show');
                }
            })

        })
        $(".btnEditar").click(function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('admin.vehicles.edit', '_id') }}".replace('_id', id),
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
                confirmButtonText: "Si, eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    /*Swal.fire({
                    title: "Marca eliminada!",
                    text: "Porceso exitoso.",
                    icon: "Satisfactorio"
                    });*/
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

@stop
