<?php
include("./config/db.php");

$count_infected_query = "SELECT count(*) as number_infected FROM infected";

$result = mysqli_query($db, $count_infected_query);
//execute SQL statement 
$number_infected = 0;

$row = mysqli_num_rows($result);
// get number of rows returned 

if ($row) {

  $number_infected = $row['number_infected'];
}

?>
<?php include("./template/header.php"); ?>

<?php include("./template/top-head.php"); ?>

<?php include("./template/sidebar.php"); ?>
<!-- content goes here -->
<div class="content-body">
  <!-- Basic Tables start -->
</div>
<div id="map"></div>
<script>
  var map;

  function initMap() {
    map = new google.maps.Map(
      document.getElementById('map'), {
        center: new google.maps.LatLng(36.8448969, 10.1613254),
        zoom: 10
      });

    var iconBase =
      'https://developers.google.com/maps/documentation/javascript/examples/full/images/';

    var icons = {
      parking: {
        icon: iconBase + 'parking_lot_maps.png'
      },
      library: {
        icon: iconBase + 'library_maps.png'
      },
      info: {
        icon: iconBase + 'info-i_maps.png'
      }
    };

    var features = [{
      position: new google.maps.LatLng(36.8448969, 10.1613254),
      type: 'info'
    }, {
      position: new google.maps.LatLng(36.8509273, 10.1482363),
      type: 'info'
    }, {
      position: new google.maps.LatLng(36.8526384, 10.1621544),
      type: 'info'
    }];

    var infowindow = new google.maps.InfoWindow({
      content: "<div><b>Ahmed ben Ahmed</b></div><div><br /><a class='btn btn-primary btn-min-width mr-1 mb-1' href='profile.php?cin=<?php echo '1234567'; ?>'>Profile infecté</a></div>"
    });

    // Create markers.
    for (var i = 0; i < features.length; i++) {
      var marker = new google.maps.Marker({
        position: features[i].position,
        map: map
      });
      marker.addListener('click', function() {
        infowindow.open(map, marker);
      })
    };
  }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAykba50Lfg3s47EfHHmdcaIeGeMsoTyIY&callback=initMap" async defer></script>

<?php include("./template/footer.php"); ?>