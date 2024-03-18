<?php
require_once("assets/header.php");
require_once("./Mod/options.php");

?>
    <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
        <div>
        <h2>Fixation des Frais fixés par Promotion & Option</h2>
           <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal1">
        Fixer un frais
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
            <form action="./Mod/ajouterFixationFrais.php" method="POST">
            <div class="form-group">
                <label for="idOpt">Option :</label>
                <select name="idOpt" class="form-control" required>
                    <?php
                    // Inclure le fichier de configuration
                    require_once 'Config.php';

                    // Requête SQL pour sélectionner toutes les options
                    $sql_options = "SELECT id, desoption FROM options";
                    $result_options = $conn->query($sql_options);

                    // Vérifier s'il y a des données pour les options
                    if ($result_options->num_rows > 0) {
                        // Afficher chaque option dans le menu déroulant
                        while($row = $result_options->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['desoption'] . "</option>";
                        }
                    } else {
                        echo "<option disabled>Aucune option trouvée</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="idProm">Promotion :</label>
                <select name="idProm" class="form-control" required>
                    <?php
                    // Requête SQL pour sélectionner toutes les promotions
                    $sql_promotions = "SELECT id, despromotion FROM promotion";
                    $result_promotions = $conn->query($sql_promotions);

                    // Vérifier s'il y a des données pour les promotions
                    if ($result_promotions->num_rows > 0) {
                        // Afficher chaque promotion dans le menu déroulant
                        while($row = $result_promotions->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['despromotion'] . "</option>";
                        }
                    } else {
                        echo "<option disabled>Aucune promotion trouvée</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="montant">Montant :</label>
                <input type="text" name="montant" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="annee">Année :</label>
                <input type="text" name="annee" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>

            </div>
            </div>
        </div>
        </div> 
        <br>
        <div class="container">
        <h2>Liste des frais fixés</h2>

        <!-- Tableau des frais fixés -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Option</th>
                    <th>Promotion</th>
                    <th>Montant</th>
                    <th>Année</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inclure le fichier de configuration
                require_once 'Config.php';

                // Requête SQL pour récupérer toutes les fixations de frais
                $sql = "SELECT fixation_frais.id, options.desoption, promotion.despromotion, fixation_frais.montant, fixation_frais.annee 
                        FROM fixation_frais 
                        INNER JOIN options ON fixation_frais.idOpt = options.id 
                        INNER JOIN promotion ON fixation_frais.idProm = promotion.id";

                $result = $conn->query($sql);

                // Vérifier s'il y a des données
                if ($result->num_rows > 0) {
                    // Afficher chaque fixation de frais dans le tableau
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['desoption'] . "</td>";
                        echo "<td>" . $row['despromotion'] . "</td>";
                        echo "<td>" . $row['montant'] . "</td>";
                        echo "<td>" . $row['annee'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Aucune fixation de frais trouvée</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
        </div>
   </main>

    <?php
require_once("assets/footer.php");
