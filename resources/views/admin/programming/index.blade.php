@extends('adminlte::page')

@section('title', 'Programación')


@section('content')
    <div class="p-2"></div>
    <div class="card">
        <div class="card-header">
            <h4>Programaciones</h4>
        </div>
        <div class="card-body">
            <div class="row text-center">
                <div class="col">Vehículo</div>
                <div class="col">Ruta</div>
                <div class="col">Fecha de inicio</div>
                <div class="col">Fecha final</div>
                <div class="col">Hora</div>
                <div class="col">Opciones</div>
            </div>
            <form action="{{ route('admin.programming.store') }}" method="POST" class="frmprogramming">
                <div class="row text-center">

                    <div class="col">
                        {!! Form::select('vehicle_id', $vehicles, null, ['id' => 'vehicle_id', 'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col">
                        {!! Form::select('route_id', $routes, null, ['id' => 'route_id', 'class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col">
                        <input type="date" name="startdate" value="<?php ?>" id="startdate"
                            class="form-control" required>
                    </div>
                    <div class="col">
                        <input type="date" name="lastdate" id="lastdate" class="form-control"
                            value="<?php ?>" required>
                    </div>
                    <div class="col">
                        <input type="time" name="starttime" id="starttime" value="<?php echo date('H:i'); ?>"
                            class="form-control" required>
                    </div>
                    <div class="col">
                        @csrf
                        <button type="button" class="btn btn-success" onclick="buscar()"><i
                                class="fas fa-search"></i></button>
                        <button class="btn btn-success " id="btnNuevo">Programar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="listado"></div>
        </div>
    </div>

    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Formulario de programacion</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>      

        $(".frmprogramming").submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: "¿Estás seguro de programar la ruta?",
                text: "Esta accion es irreversible!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, registrar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    // Swal.fire({
                    //     title: "Ruta Programada",
                    //     text: "Proceso exitoso.",
                    //     icon: "Satisfactorio"
                    // });
                }
            });
        })

        function buscar() {
            // var d = new FormData();
            // d.append('vehicle_id', $("#vehicle_id").val());

            axios.get('/searchprogramming', {
                    "params": {
                        "vehicle_id": $("#vehicle_id").val(),
                        "route_id": $("#route_id").val(),
                        "startdate": $("#startdate").val(),
                        "lastdate": $("#lastdate").val()
                    }
                }).then(function(respuesta) {

                    const contenido_tabla = respuesta.data;
                    $("#listado").html(contenido_tabla);
                })
                .catch(function(error) {
                    // 400, 500
                    toastr.error('Error al cargar el listado')
                });
        }
       

        // $(".fmrEliminar").submit(function(e) {
        //     e.preventDefault();
        //     Swal.fire({
        //         title: "¿Seguro de eliminar?",
        //         text: "Esta accion es irreversible!",
        //         icon: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#3085d6",
        //         cancelButtonColor: "#d33",
        //         confirmButtonText: "Si, eliminar!"
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             this.submit();
        //             /*Swal.fire({
        //             title: "Marca eliminada!",
        //             text: "Porceso exitoso.",
        //             icon: "Satisfactorio"
        //             });*/
        //         }
        //     });
        // });
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
