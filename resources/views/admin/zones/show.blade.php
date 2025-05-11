@extends('adminlte::page')

@section('title', 'Perímetro de zona')

@section('content')
    <div class="p-3"></div>
    <div class="card">
        <div class="card-header">
            <button class="btnNuevo btn-success float-right" id={{ $zone->id }}><i class="fas fa-plus-circle"></i>
                Agregar coordenada</button>

            Perimetro de la zona: {{ $zone->name }} <br>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4 card" style="min-height: 50px">
                    <div class="card-body">
                        <label for="">Zona:</label>
                        {{ $zone->name }} <br>
                        <label for="">Area:</label>
                        {{ $zone->area }} <br>
                        <label for="">Descripcion:</label>
                        {{ $zone->description }} <br>
                    </div>
                </div>
                <div class="col-8 card" style="min-height: 50px">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Latitud</th>
                                    <th>Longitud</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coords as $coord)
                                    <tr>
                                        <td>{{ $coord->id }}</td>
                                        <td>{{ $coord->latitude }}</td>
                                        <td>{{ $coord->longitude }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($coords->isNotEmpty())
                        <div class="card-footer">
                            <form id="deleteCoordsForm" action="{{ route('admin.zonecoords.destroy', $zone->id) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button id="deleteCoordsButton" class="btn btn-danger">Eliminar Coordenadas</button>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="card" style="min-height: 50px"></div>
                </div>

            </div>
        </div>


    </div>

    <div class="card">
        <div class="card-header">
            Perímetro
            {{-- @if ($coords->isNotEmpty())
                <button class="btnEditar btn-primary float-right">
                    <i class="fas fa-edit"></i> Editar coordenadas
                </button>
            @endif --}}
        </div>
        <div class="card-body">
            <div id="map" style="height:400px"></div>
        </div>
        <div class="footer"></div>
    </div>

    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Formulario de Zonas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer"></div>
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

        $(".btnNuevo").click(function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('admin.zonecoords.show', '_id') }}".replace('_id', id),
                type: "GET",
                success: function(response) {
                    $('#formModal .modal-body').html(response);
                    $('#formModal').modal('show');
                }
            });
        });

        $(".btnEditar").click(function() {
            var id = $(this).attr('id');
            $.ajax({
                url: "{{ route('admin.zonecoords.edit', '_id') }}".replace('_id', id),
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
                }
            });
        });

        $('#deleteCoordsButton').click(function() {
            Swal.fire({
                title: "Seguro de eliminar?",
                text: "Esta acción eliminará todas las coordenadas de esta zona. ¿Desea continuar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteCoordsForm').submit();
                }
            });
        });

        var perimeter = @json($perimeter);
        console.log(perimeter);

        function initMapss() {
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

                // Definir el color del perímetro
                var color = '#FF0000';

                // Crear un objeto de polígono con los puntos del perímetro
                var perimeterPolygon = new google.maps.Polygon({
                    paths: perimeter,
                    strokeColor: color,
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: color,
                    fillOpacity: 0.35,
                    map: map 
                });

                var bounds = new google.maps.LatLngBounds();
                perimeter.forEach(function(point) {
                    bounds.extend(new google.maps.LatLng(point.lat, point.lng));
                });
                map.fitBounds(bounds);
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMapss" async
        defer></script>
@stop
