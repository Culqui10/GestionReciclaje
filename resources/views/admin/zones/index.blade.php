@extends('adminlte::page')

@section('title', 'Zonas')


@section('content')
    <div class="p-2"></div>
    <div class="card">
        <div class="card-header">
            <!--<a href="{{ route('admin.zones.create') }}" class="btn btn-success float-right"><i class="fas fa-plus-circle"></i> Registrar</a>-->
            <button class="btn btn-success float-right" id="btnNuevo"><i class="fas fa-plus-circle"></i> Registrar</button>
            <h4>Listado de zonas</h4>
        </div>
        <div class="card-body">
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>ZONA</th>
                        <th>AREA</th>
                        <th>DESCRIPCIÓN</th>
                        <th width=20></th>
                        <th width=20></th>
                        <th width=20></th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($zones as $zone)
                        <tr>
                            <td>{{ $zone->id }}</td>
                            <td>{{ $zone->name }}</td>
                            <td>{{ $zone->area }}</td>
                            <td>{{ $zone->description }}</td>
                            <td>

                                <a href="{{ route('admin.zones.show', $zone->id) }}" class="btn btn-secondary btn-sm"><i
                                        class="fas fa-map"></i></a>
                            </td>


                            <td><!--<a href="{{ route('admin.zones.edit', $zone->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>-->
                                <button class="btnEditar btn btn-primary btn-sm" id={{ $zone->id }}><i
                                        class="fa fa-edit"></i></button>
                            </td>
                            <td>
                                <form action="{{ route('admin.zones.destroy', $zone->id) }}" method="POST"
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

    <div class="card">
        <div class="card-header">

            Todas las zonas
        </div>
        <div class="card-body">

            <div id="map" style="height:400px">
            </div>
        </div>

        <div class="footer">

        </div>
    </div>

    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Zonas</h5>
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

@section('js')
    <script>
        $('#datatable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            }
        });

        $('#btnNuevo').click(function() {
            $.ajax({
                url: "{{ route('admin.zones.create') }}",
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
                url: "{{ route('admin.zones.edit', '_id') }}".replace('_id', id),
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

        var perimeters = @json($perimeter);
        console.log(perimeters)

        function initMap() {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;

                var mapOptions = {
                    center: {
                        lat: lat,
                        lng: lng
                    },
                    zoom: 15
                };

                var map = new google.maps.Map(document.getElementById('map'), mapOptions);
                var colors = ['#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF'];

                perimeters.forEach(function(perimeter, index) {
                    var perimeterCoords = perimeter.coords;
                    var color = colors[index % colors.length]; // Obtiene un color de la matriz de colores

                    // Crea un objeto de polígono con los puntos del perímetro
                    var perimeterPolygon = new google.maps.Polygon({
                        paths: perimeterCoords,
                        strokeColor: color,
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: color,
                        fillOpacity: 0.35,
                        map: map // Asigna el mapa al polígono para mostrarlo
                    });
                });
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async
        defer></script>


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
