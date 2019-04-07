<?php
/**
 * Created by PhpStorm.
 * User: BNF Conti
 * Date: 16/01/18
 * Time: 07:56
 */
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        #map-canvas {
            height: 300px;
            width: 300px;
        }
    </style>
</head>
<body>
<h3>Google Maps</h3>
<div id="map-canvas"></div>
<!--<script>
    function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
</script>-->
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2TQdhIjRlDMNyssJH3sLDdumHE81SGUg">
</script>
<script src="<?php echo URL?>js/maps.js"></script>
<script>
    $(function() {
        initialize('-25.296854389343867', '-57.52887725830078', null, 12);
    });
</script>
</body>
</html>
