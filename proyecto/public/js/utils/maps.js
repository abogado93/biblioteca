var map;
var markers = [];
var circle = null;

function initialize(_lat, _lon, marker, _zoom, _aux)//aux=1 (si con un click se deben eliminar los marcadores), aux=0 caso contrario)
{
    var loc = new google.maps.LatLng(_lat, _lon);

    var mapOptions = {
        zoom: _zoom,
        center:loc,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);


    if(marker) {
        addMarker(loc);
    }

    google.maps.event.addListener(map, 'click', function(event) {
        if (_aux){
            addMarker(event.latLng);
        }

        $("#radio").focus();
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
                zoom: 10
            };

            map.setCenter(pos);
        }, function() {
            console.log("Ocurrió un error al intentar obtener la posición del usuario.")
        });
    } else {
        console.log("El browser no tiene soporte para geolocalización")
    }
}

function addMarker(location) {
    deleteMarkers();
    if(circle) removeCircle();

    var marker = new google.maps.Marker({
        position: location,
        map: map,
        title: "titulo",
        animation: google.maps.Animation.DROP
    });

    markers.push(marker);

    map.setCenter(marker.getPosition());

    if(circle) {
        setMarkerToCircle(marker);
    }

    $("#ubicacion-lat").val(location.lat());
    $("#ubicacion-lon").val(location.lng());
}

function setMarkerRadio(radio){
    radio = parseInt(radio);

    if(radio > 0) {
        if(circle != null){
            removeCircle();
        }
        circle = new google.maps.Circle({
            map: map,
            strokeColor: '#999999',
            strokeOpacity: 1.0,
            strokeWeight: 1,
            radius: radio,
            fillColor: '#AA0000'
        });

        setMarkerToCircle(markers[0]);
    }
}

function setMarkerToCircle(marker) {
    circle.bindTo('center', marker, 'position');
}

function removeCircle() {
    circle.setMap(null);
}

function setAllMap(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

function clearMarkers() {
    setAllMap(null);
}

function deleteMarkers() {
    clearMarkers();
    markers = [];
}


function addMarkerInfo(_lat, _lon,__nombre, __dir,__telefono,__icono,__inicio,__fin) {
    var loc = new google.maps.LatLng(_lat, _lon);

    if(circle) removeCircle();
    nombre=__nombre.bold();
    salto= "<br><br>";

    var contentString= __nombre.bold().concat(salto,__dir);

    if (__telefono.length !== 0){
        contentString += salto + __telefono;
    }

    if (__inicio.length !== 0){
        contentString += salto + __inicio + " hasta " + __fin;
    }

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });


    if(__icono){

        console.log(ROOT_FOLDER + "public/" + __icono);

        var icono = {
            url: ROOT_FOLDER + __icono, // url
            scaledSize: new google.maps.Size(40, 40), // scaled size
            origin: new google.maps.Point(0,0), // origin
            anchor: new google.maps.Point(0, 0) // anchor
        };
    }else
    {
        var icono = null;
    }


    var marker = new google.maps.Marker({
        icon: icono,
        position: loc,
        map: map,
        title: __nombre,
        animation: google.maps.Animation.DROP
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    markers.push(marker);

    map.setCenter(marker.getPosition());

    if(circle) {
        setMarkerToCircle(marker);
    }

    $("#ubicacion-lat").val(loc.lat());
    $("#ubicacion-lon").val(loc.lng());
}

