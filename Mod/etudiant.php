<?php
// Inclure le fichier de configuration
require_once "Config.php";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $matricule = $_POST['matricule'];
    $noms = $_POST['noms'];
    $genre = $_POST['genre'];
    $lieu = $_POST['lieu'];
    $datenaissance = $_POST['datenaissance'];
    $adresse = $_POST['adresse'];
    
    // Préparer la requête d'insertion
    $sql = "INSERT INTO etudiant (matricule, noms, genre, lieu, datenaissance, adresse) VALUES (?, ?, ?, ?, ?, ?)";
    
    // Préparer et exécuter la requête
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $matricule, $noms, $genre, $lieu, $datenaissance, $adresse);
    $stmt->execute();
    
    // Rediriger vers une page de confirmation ou faire d'autres actions
    header("Location: ../Dashboard.php");
    exit();
}
?>
