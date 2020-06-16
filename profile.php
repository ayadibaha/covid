<?php
include("./config/db.php");
if (sizeof($_GET) > 0) {
    $cin = $_GET['cin'];
    $infected_query = "SELECT *, DATE_ADD(date, INTERVAL 14 DAY) as endDate FROM infected WHERE CIN = " . $cin;
    $result = mysqli_query($db, $infected_query);
    foreach ($result as $infected) {
?>
        <?php include("./template/header.php"); ?>

        <?php include("./template/top-head.php"); ?>

        <?php include("./template/sidebar.php"); ?>
        <!-- content goes here -->
        <div class="app-content content" style="padding:15px">
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Infecté <?php echo $infected['CIN']; ?></h4>
                                <h6 class="card-subtitle text-muted"><?php echo $infected['firstname']; ?> <?php echo $infected['lastname']; ?> - Ariana</h6>
                            </div>
                            <!-- <img class="" src="./template/theme-assets/images/portrait/medium/avatar-m-4.png" alt="Card image cap"> -->
                            <div class="card-body">
                                <?php if ($infected['isImported'] == 0) { ?>
                                    <p style="color:red" class="card-text"><i class="la la-warning"></i> Cas local</p>
                                <?php } else { ?>
                                    <p style="color:red" class="card-text"><i class="la la-warning"></i> Importé de : <?php echo $infected['imported_from']; ?></p>
                                <?php } ?>
                            </div>
                            <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                                <span class="float-left"><?php
                                                            $endDate = new DateTime($infected["endDate"]);
                                                            $today = new DateTime();
                                                            $diff = date_diff($endDate, $today);
                                                            echo $diff->days . " jour(s) restant(s) jusqu'à la fin de son confinement!";
                                                            ?></span>
                                <span class="float-right">
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Historique des déplacements de l'infecté</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                            $query_history = "SELECT * FROM emplacement WHERE infected_cin = " . $infected['CIN'];
                            $result_history = mysqli_query($db, $query_history);
                            ?>
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Emplacement</th>
                                                    <th>Latitude</th>
                                                    <th>Longitude</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($result_history as $history) {
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $history['date']; ?></th>
                                                        <td>
                                                            <?php
                                                            $lat = $history['latitude'];
                                                            $lng = $history['longitude'];
                                                            $city = "";
                                                            $url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyAykba50Lfg3s47EfHHmdcaIeGeMsoTyIY&latlng=' . $lat . ',' . $lng . '&sensor=false';
                                                            $json = @file_get_contents($url);
                                                            $data = json_decode($json);
                                                            $status = $data->status;
                                                            if ($status == "OK") {
                                                                //Get address from json data
                                                                for ($j = 0; $j < count($data->results[0]->address_components); $j++) {
                                                                    $cn = array($data->results[0]->address_components[$j]->types[0]);
                                                                    $city = $city . " " . $data->results[0]->address_components[$j]->long_name;
                                                                }
                                                            } else {
                                                                echo 'Location introuvable';
                                                            }
                                                            //Print city 
                                                            echo $city;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $history['latitude']; ?>
                                                        </td>
                                                        <td> <?php echo $history['longitude']; ?> </td>
                                                    </tr> <?php } ?> </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <?php }
            } ?> <?php include("./template/footer.php"); ?>