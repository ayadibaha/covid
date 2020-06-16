<?php
include("./config/db.php");

$infected_query = "SELECT * FROM infected";

$result = mysqli_query($db, $infected_query);

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
                <a href="add_infected.php" style="float:right" type="button" class="btn btn-info btn-sm mr-1">
                    <div style="display:flex;align-items:center;">
                        <i class="la la-plus"></i>
                        <div>Ajouter infecté</div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Liste des infectés</h4>
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
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>CIN</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Cas importé</th>
                                            <th>Importé de</th>
                                            <th>Zone</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($result as $infected) {  ?>
                                            <tr>
                                                <th scope="row"><?php echo $infected['CIN']; ?></th>
                                                <td><?php echo $infected['firstname']; ?></td>
                                                <td><?php echo $infected['lastname']; ?></td>
                                                <td><?php echo ($infected['isImported'] == 0 ? "Non" : "Oui"); ?></td>
                                                <td><?php echo ($infected['isImported'] == 0 ? "-" : $infected['imported_from']); ?></td>
                                                <td><?php echo $infected['zone_id']; ?></td>
                                                <td>
                                                    <a href="profile.php?cin=<?php echo $infected['CIN']; ?>"><button type="button" class="btn btn-icon btn-sm mr-1"><i class="la la-user"></i> Profile</button></a>
                                                    <button onclick="confirmDelete(`<?php echo $infected['firstname']; ?>`, `<?php echo $infected['CIN']; ?>`);" type="button" class="btn btn-icon btn-sm mr-1"><i class="la la-trash"></i> Supprimer</button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("./template/footer.php"); ?>