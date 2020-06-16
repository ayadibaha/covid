<?php
include("./config/db.php");
$query = "SELECT *, e.id as id_emplacement from emplacement e, infected i, zone z where e.infected_cin = i.CIN and i.zone_id = z.id";
$result = mysqli_query($db, $query);


$geoData = [];
$currentPosition = null;
foreach ($result as $emplacement) {
    $coords = $emplacement['latlng'];
    $coords = explode(" ", $coords);
    foreach ($coords as $c) {
        if (explode(",", $c)[0] && explode(",", $c)[1]) {
            array_push($geoData, [
                explode(",", $c)[0],
                explode(",", $c)[1]
            ]);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <div style="height: 770px;" id="map"></div>
    </div>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: new google.maps.LatLng(36.860117, 10.193371),
                zoom: 10
            });
            google.maps.event.addListenerOnce(map, 'idle', function(evt) {
                var triangleCoords = [];
                <?php
                foreach ($geoData as $zone) {
                ?>
                    triangleCoords.push({
                        "lat": <?php echo $zone[1]; ?>,
                        "lng": <?php echo $zone[0]; ?>
                    });
                <?php
                }
                foreach ($result as $emplacement) {
                ?>
                    var currentPosition = new google.maps.LatLng(
                        <?php echo $emplacement['latitude']; ?>, <?php echo $emplacement['longitude']; ?>
                    );

                    var flightPath = new google.maps.Polygon({
                        paths: triangleCoords,
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: '#FF0000',
                        fillOpacity: 0.35

                    });
                    flightPath.setMap(map);
                    new google.maps.Marker({
                        position: currentPosition,
                        map: map,
                    });

                    var result_test = google.maps.geometry.poly.containsLocation(currentPosition, flightPath);
                    console.log(isLatLngInZone(triangleCoords, currentPosition.lat(), currentPosition.lng()));
                    if (isLatLngInZone(triangleCoords, currentPosition.lat(), currentPosition.lng()) !== true) {
                        send_post_request(<?php echo $emplacement['CIN']; ?>, <?php echo $emplacement['id_emplacement']; ?>);
                    }
                <?php } ?>
            });
        }

        function send_post_request(cin, id) {
            var http = new XMLHttpRequest();
            var url = 'notification.php';
            var params = 'cin=' + cin + '&emplacement_id=' + id;
            http.open('POST', url, true);

            //Send the proper header information along with the request
            http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            http.onreadystatechange = function() { //Call a function when the state changes.
                if (http.readyState == 4 && http.status == 200) {
                    // alert(http.responseText);
                }
            }
            http.send(params);
        }

        function isLatLngInZone(latLngs, lat, lng) {
            // latlngs = [{"lat":22.281610498720003,"lng":70.77577162868579},{"lat":22.28065743343672,"lng":70.77624369747241},{"lat":22.280860953131217,"lng":70.77672113067706},{"lat":22.281863655593973,"lng":70.7762061465462}];
            vertices_y = new Array();
            vertices_x = new Array();
            longitude_x = lng;
            latitude_y = lat;
            // latLngs = JSON.parse(latLngs);
            var r = 0;
            var i = 0;
            var j = 0;
            var c = false;
            var point = 0;

            for (r = 0; r < latLngs.length; r++) {
                vertices_y.push(latLngs[r].lat);
                vertices_x.push(latLngs[r].lng);
            }
            points_polygon = vertices_x.length;
            for (i = 0, j = points_polygon; i < points_polygon; j = i++) {
                point = i;
                if (point == points_polygon)
                    point = 0;
                if (((vertices_y[point] > latitude_y != (vertices_y[j] > latitude_y)) && (longitude_x < (vertices_x[j] - vertices_x[point]) * (latitude_y - vertices_y[point]) / (vertices_y[j] - vertices_y[point]) + vertices_x[point])))
                    c = !c;
            }
            return c;
        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAykba50Lfg3s47EfHHmdcaIeGeMsoTyIY&callback=initMap&libraries=geometry" async defer></script>
</body>

</html>