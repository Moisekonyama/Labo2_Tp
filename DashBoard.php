<?php
require_once("assets/header.php");
require_once("./Mod/etudiant.php");

?>
    <main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
      <!-- Contenu du tableau de bord -->
      <h2 class="mt-3">Tableau de bord de Gestion Des Etudiants</h2>
      <!-- Ajoutez ici le contenu de votre tableau de bord -->
      <div class="row">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Formulaire d'ajout Etudiant</h5>
              <form action="./Mod/etudiant.php" method="POST">
              <div class="form-group">
                <label for="matricule">Matricule :</label>
                <input type="text" class="form-control" name="matricule" required>
              </div>
              
              <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" name="noms" required>
              </div>
              
              <div class="form-group">
                <label for="genre">Genre :</label>
                <select class="form-control" name="genre">
                  <option value="M">Masculin</option>
                  <option value="F">Féminin</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="lieu">Lieu :</label>
                <input type="text" class="form-control" name="lieu" required>
              </div>
              
              <div class="form-group">
                <label for="datenaissance">Date de naissance :</label>
                <input type="date" class="form-control" name="datenaissance" required>
              </div>
              
              <div class="form-group">
                <label for="adresse">Adresse :</label>
                <input type="text" class="form-control" name="adresse" required>
              </div>
              
              <button type="submit" class="btn btn-primary btn-block">Enregistrer</button>
            </form>

            </div>
          </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Tableau d'Etudiant</h5>
                <?php
        // Inclure le fichier de configuration
        require_once 'Config.php';

        // Requête SQL pour sélectionner tous les étudiants
        $sql = "SELECT * FROM etudiant ORDER BY id DESC";
        $result = $conn->query($sql);

        // Vérifier s'il y a des données
        if ($result->num_rows > 0) {
            // Afficher le tableau HTML avec Bootstrap
            echo "<div class='container table-responsive'>
            <h2>Liste des étudiants</h2>
            <table class='table table-striped'>
            <thead>
            <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Genre</th>
            <th>Lieu</th>
            <th>Date de Naissance</th>
            <th>Adresse</th>
            <th>Action</th>
            </tr>
            </thead>
            <tbody>";

    // Parcourir chaque ligne de résultat
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['matricule'] . "</td>";
        echo "<td>" . $row['noms'] . "</td>";
        echo "<td>" . $row['genre'] . "</td>";
        echo "<td>" . $row['lieu'] . "</td>";
        echo "<td>" . $row['datenaissance'] . "</td>";
        echo "<td>" . $row['adresse'] . "</td>";
        echo "<td>
        <div class='text-center d-flex gap-5'>
        <a href='Mod/modifierEtudiant.php?id=" . $row['id'] . "' class='btn btn-primary'><i class='bx bx-edit-alt' ></i></a>
        <a href='Mod/deleteEtudiant.php?id=" . $row['id'] . "' class='btn btn-danger'><i class='bx bxs-trash'></i></a>
        </div>
        </td>";
        echo "</tr>";
    }

    echo "</tbody></table></div>";
} else {
    echo "Aucun étudiant trouvé.";
}
?>
      </div>
    </div>
    <div class="container">
        <?php
        // Inclure le fichier de configuration
        require_once 'Config.php';

        // Requête SQL pour sélectionner le nombre d'étudiants par genre
        $sql = "SELECT genre, COUNT(*) as count FROM etudiant GROUP BY genre";
        $result = $conn->query($sql);

        // Récupérer les données du résultat
        $data = array();
        while($row = $result->fetch_assoc()) {
            $data[$row['genre']] = $row['count'];
        }

        // Créer un tableau pour le graphique
        $labels = json_encode(array_keys($data));
        $values = json_encode(array_values($data));
        ?>
        <canvas id="myChart"></canvas>
    </div>
  </div>
</div>

    </main>
    <?php
require_once("assets/footer.php");
?>