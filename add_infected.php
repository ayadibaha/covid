<?php
$cin = null;
$nom = null;
$prenom = null;
$importedFrom = null;
$zone = null;
if (sizeof($_POST) > 0) {
    $cin = $_POST["cin"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $importedFrom = $_POST["imported_from"];
    $zone = $_POST["zone"];
}
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

// Ajout d'un infecté
if (sizeof($_POST) > 0) {
    $isImported = 0;
    if ($importedFrom != null) {
        $isImported = 1;
    }
    $add_infected_query = "INSERT INTO infected(CIN, firstname, lastname, isImported, imported_from, zone_id) VALUES('" . $cin . "','" . $nom . "','" . $prenom . "','" . $isImported . "','" . $importedFrom . "','" . $zone . "')";

    if ($db->query($add_infected_query) === TRUE) {
        header('Location: infected.php');
    }
}
?>
<?php include("./template/header.php"); ?>

<?php include("./template/top-head.php"); ?>

<?php include("./template/sidebar.php"); ?>
<!-- content goes here -->
<div class="app-content content" style="padding:15px">
    <div class="content-body">
        <!-- Basic Tables start -->
        <div class="row" style="margin-bottom:10px">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ajouter un infecté</h4>
                    </div>
                    <div class="card-block">
                        <div class="card-body">
                            <form action="add_infected.php" method="post">
                                <fieldset class="form-group">
                                    <input type="text" minlength="8" maxlength="8" class="form-control" id="cin" name="cin" placeholder="CIN" required />
                                </fieldset>
                                <fieldset class="form-group">
                                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required />
                                </fieldset>
                                <fieldset class="form-group">
                                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" required />
                                </fieldset>
                                <fieldset class="form-group">
                                    <input type="text" class="form-control" id="imported_from" name="imported_from" placeholder="Pays d'origine">
                                </fieldset>
                                <fieldset class="form-group">
                                    <select class="form-control" id="zone" name="zone">
                                        <option value="">Select Zone</option>
                                        <?php
                                        $zone_query = "SELECT * FROM zone ORDER BY nom ASC";
                                        $zone_result = mysqli_query($db, $zone_query);
                                        foreach ($zone_result as $zone_fetched) {
                                            echo "<option value='" . $zone_fetched['id'] . "'>" . $zone_fetched['nom'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </fieldset>
                                <fieldset>
                                    <button type="submit" class="btn btn-dark btn-min-width mr-1 mb-1">Envoyer</button>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("./template/footer.php"); ?>