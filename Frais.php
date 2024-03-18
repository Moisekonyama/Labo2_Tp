<?php
require_once("assets/header.php");
require_once("./Mod/options.php");

?>
    <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
        <div>
        <h2>Frais à payer par Promotion & Option</h2>
           <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal1">
        Frais
        </button> <br>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Formulaire d'ajout Fixation Frais</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="./Mod/ajouterFrais.php" method="POST">
            <div class="form-group">
                <label for="designation">Designation :</label>
                <input type="text" name="designation" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="idFix">Promotion et Option :</label>
                <select name="idFix" class="form-control" required>
                    <?php
                    // Inclure le fichier de configuration
                    require_once 'Config.php';

                    // Requête SQL pour sélectionner les options et promotions avec leurs noms
                    $sql = "SELECT fixation_frais.id, CONCAT(promotion.despromotion, ' - ', options.desoption) AS nom_fixation
                            FROM fixation_frais
                            INNER JOIN promotion ON fixation_frais.idProm = promotion.id
                            INNER JOIN options ON fixation_frais.idOpt = options.id";

                    $result = $conn->query($sql);

                    // Vérifier s'il y a des données
                    if ($result->num_rows > 0) {
                        // Afficher chaque option et promotion dans le menu déroulant
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nom_fixation'] . "</option>";
                        }
                    } else {
                        echo "<option disabled>Aucune promotion et option trouvée</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>

            </div>
            </div>
        </div>
        </div> 
        <br>
        <div class="container">
        <h2>Liste des frais</h2>

        <!-- Tableau des frais -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Designation</th>
                    <th>Promotion</th>
                    <th>Option</th>
                    <th>Montant</th>
                    <th>Année</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inclure le fichier de configuration
                require_once 'Config.php';

                // Requête SQL pour sélectionner tous les frais avec leurs détails de promotion et d'option
                $sql = "SELECT frais.designation, promotion.despromotion, options.desoption, fixation_frais.montant, fixation_frais.annee
                        FROM frais
                        INNER JOIN fixation_frais ON frais.idFix = fixation_frais.id
                        INNER JOIN promotion ON fixation_frais.idProm = promotion.id
                        INNER JOIN options ON fixation_frais.idOpt = options.id";

                $result = $conn->query($sql);

                // Vérifier s'il y a des données
                if ($result->num_rows > 0) {
                    // Afficher chaque frais avec ses détails dans le tableau
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['designation'] . "</td>";
                        echo "<td>" . $row['despromotion'] . "</td>";
                        echo "<td>" . $row['desoption'] . "</td>";
                        echo "<td>" . $row['montant'] . "</td>";
                        echo "<td>" . $row['annee'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucun frais trouvé</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
   </main>

    <?php
require_once("assets/footer.php");
