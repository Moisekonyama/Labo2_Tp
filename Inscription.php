<?php
require_once("assets/header.php");
require_once("./Mod/options.php");

?>
    <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
        <div>
        <h2>Liste des Inscrits par Promotion et Option</h2>
           <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal1">
        inscription
        </button> <br>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Formulaire d'ajout Promotion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="./Mod/inscription.php" method="POST">
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
                <label for="idEt">Étudiant :</label>
                <select name="idEt" class="form-control" required>
                    <?php
                    // Requête SQL pour sélectionner tous les étudiants
                    $sql_etudiants = "SELECT id, noms FROM etudiant";
                    $result_etudiants = $conn->query($sql_etudiants);

                    // Vérifier s'il y a des données pour les étudiants
                    if ($result_etudiants->num_rows > 0) {
                        // Afficher chaque étudiant dans le menu déroulant
                        while($row = $result_etudiants->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['noms'] . "</option>";
                        }
                    } else {
                        echo "<option disabled>Aucun étudiant trouvé</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="annee">Année :</label>
                <input type="text" name="annee" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>

            </div>
            </div>
        </div>
        </div> 
        <br>
        <div class="container">
        <!-- Formulaire de recherche -->
        <form action="" method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Rechercher...">
            </div>
        </form>

        <!-- Tableau des inscriptions -->
        <table id="./Mod/inscription.php" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Option</th>
                    <th>Promotion</th>
                    <th>Étudiant</th>
                    <th>Année</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inclure le fichier de configuration
                require_once 'Config.php';

                // Requête SQL pour récupérer toutes les inscriptions
                $sql = "SELECT inscription.id, options.desoption AS option_nom, promotion.despromotion AS promotion_nom, etudiant.noms AS etudiant_nom, inscription.annee 
                        FROM inscription 
                        INNER JOIN options ON inscription.idOpt = options.id 
                        INNER JOIN promotion ON inscription.idProm = promotion.id 
                        INNER JOIN etudiant ON inscription.idEt = etudiant.id";

                // Si une recherche est effectuée
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $search = $_GET['search'];
                    $sql .= " WHERE options.desoption LIKE '%$search%' OR promotion.despromotion LIKE '%$search%' OR etudiant.noms LIKE '%$search%' OR inscription.annee LIKE '%$search%'";
                }
                $result = $conn->query($sql);

                // Vérifier s'il y a des données
                if ($result->num_rows > 0) {
                    // Afficher chaque inscription dans le tableau
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['option_nom'] . "</td>";
                        echo "<td>" . $row['promotion_nom'] . "</td>";
                        echo "<td>" . $row['etudiant_nom'] . "</td>";
                        echo "<td>" . $row['annee'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucune inscription trouvée</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
        </div>
   </main>
   <script>
    $(document).ready(function(){
        // Lorsque l'utilisateur tape une lettre dans le champ de recherche
        $('#search').keyup(function(){
            // Récupérer la valeur de recherche
            var searchText = $(this).val();

            // Effectuer une requête AJAX pour mettre à jour le tableau en fonction de la recherche
            $.ajax({
                url: 'inscription.php',
                type: 'GET',
                data: {search: searchText},
                success: function(response){
                    $('#inscriptionTable tbody').html(response);
                }
            });
        });
    });
    </script>
    <?php
require_once("assets/footer.php");
