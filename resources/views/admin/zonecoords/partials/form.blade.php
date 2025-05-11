<div class="form-row">
    {!! Form::hidden('zone_id', $zone->id, ['class' => 'form-control']) !!}
    {!! Form::hidden('coordinate_count', 0, ['id' => 'coordinate_count']) !!}
</div>
    
<div>
    <button type="button" id="add-point" class="btn btn-primary">Agregar punto</button>
    <button type="button" id="remove-point" class="btn btn-danger">Quitar punto</button>
</div>
<br>
<div id="mapas" style="height: 400px; width:100%; border: 1px solid black;">

</div>
<br>

<script>
    var map, perimeterPolygon;
    var markers = [];
    var points = [];

    function initMapas() {
        var initialLat = 0;
        var initialLng = 0;

        navigator.geolocation.getCurrentPosition(function(position) {
            initialLat = position.coords.latitude;
            initialLng = position.coords.longitude;

            var mapOptions = {
                center: {
                    lat: initialLat,
                    lng: initialLng
                },
                zoom: 18
            };

            map = new google.maps.Map(document.getElementById('mapas'), mapOptions);

            perimeterPolygon = new google.maps.Polygon({
                paths: points,
                strokeColor: '#FF0000',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#FF0000',
                fillOpacity: 0.35
            });

            perimeterPolygon.setMap(map);

            map.addListener('click', function(event) {
                addPoint(event.latLng);
            });

            document.getElementById('add-point').addEventListener('click', function() {
                addPoint(map.getCenter());
            });

            document.getElementById('remove-point').addEventListener('click', function() {
                removeLastPoint();
            });
        });
    }

    function addPoint(location) {
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            draggable: true
        });

        marker.addListener('dragend', function() {
            updatePolygon();
            updateFormInputs();
        });

        markers.push(marker);
        points.push(location);

        updatePolygon();
        updateFormInputs();
    }

    function removeLastPoint() {
        if (markers.length > 0) {
            var marker = markers.pop();
            marker.setMap(null);
            points.pop();

            updatePolygon();
            updateFormInputs();
        }
    }

    function updatePolygon() {
        var path = markers.map(function(marker) {
            return marker.getPosition();
        });

        perimeterPolygon.setPath(path);
    }

    function updateFormInputs() {
        var form = document.querySelector('.form-row');
        form.innerHTML = '';

        markers.forEach(function(marker, index) {
            var position = marker.getPosition();
            var latInput = document.createElement('input');
            latInput.type = 'hidden';
            latInput.name = 'latitude' + (index + 1);
            latInput.value = position.lat();
            form.appendChild(latInput);

            var lngInput = document.createElement('input');
            lngInput.type = 'hidden';
            lngInput.name = 'longitude' + (index + 1);
            lngInput.value = position.lng();
            form.appendChild(lngInput);
        });

        var zoneIdInput = document.createElement('input');
        zoneIdInput.type = 'hidden';
        zoneIdInput.name = 'zone_id';
        zoneIdInput.value = {{ $zone->id }};
        form.appendChild(zoneIdInput);

        var coordinateCountInput = document.createElement('input');
        coordinateCountInput.type = 'hidden';
        coordinateCountInput.name = 'coordinate_count';
        coordinateCountInput.id = 'coordinate_count';
        coordinateCountInput.value = markers.length;
        form.appendChild(coordinateCountInput);
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMapas" async defer>
</script>
