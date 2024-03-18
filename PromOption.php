<?php
require_once("assets/header.php");
require_once("./Mod/options.php");

?>
    <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
        <div class="container">
        <div class="row">
            <div class="col">
            <h2>Liste des options</h2>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ajouter Option
        </button> <br>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulaire d'ajout Options</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="./Mod/options.php" method="POST">
                <div class="form-group">
                    <label for="desoption">Nom de l'option :</label>
                    <input type="text" name="desoption" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            </div>
            </div>
        </div>
        </div>
       
        <?php
        // Inclure le fichier de configuration
        require_once 'Config.php';

        // Requête SQL pour sélectionner toutes les options
        $sql_options = "SELECT * FROM options";
        $result_options = $conn->query($sql_options);

        // Vérifier s'il y a des données pour les options
        if ($result_options->num_rows > 0) {
            // Afficher le tableau HTML avec les options
            echo "  <br><div class='table-responsive'>
            <table class='table table-striped'>
            <thead>
            <tr>
            <th>ID</th>
            <th>Nom de l'option</th>
            </tr>
            </thead>
            <tbody>";

            // Parcourir chaque ligne de résultat des options
            while($row = $result_options->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['desoption'] . "</td>";
                echo "</tr>";
            }

            echo "</tbody></table></div>";
        } else {
            echo "Aucune option trouvée.";
        }
        ?>

            </div>
        <div class="col">
        <h2>Liste des promotions</h2> 
           <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#exampleModal1">
        Ajouter Promotion
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
            <form action="./Mod/promotion.php" method="POST">
                    <div class="form-group">
                        <label for="idEt">Étudiant :</label>
                        <select name="idEt" class="form-control" required>
                            <?php
                            // Inclure le fichier de configuration
                            require_once 'Config.php';

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
                        <label for="despromotion">Description de la promotion :</label>
                        <input type="text" name="despromotion" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
            </div>
        </div>
        </div> 
        <br>
        <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Étudiant</th>
                    <th>Description de la promotion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Inclure le fichier de configuration
                require_once 'Config.php';

                // Requête SQL pour récupérer les promotions avec les noms des étudiants associés
                $sql = "SELECT promotion.id, etudiant.noms AS nom_etudiant, promotion.despromotion 
                        FROM promotion 
                        INNER JOIN etudiant ON promotion.idEt = etudiant.id";
                $result = $conn->query($sql);

                // Vérifier s'il y a des données
                if ($result->num_rows > 0) {
                    // Afficher chaque promotion dans le tableau
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nom_etudiant'] . "</td>";
                        echo "<td>" . $row['despromotion'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Aucune promotion trouvée</td></tr>";
                }
                ?>
            </tbody>
        </table>
        </div>
        </div>
        </div>
   </main>
    <?php
require_once("assets/footer.php");
