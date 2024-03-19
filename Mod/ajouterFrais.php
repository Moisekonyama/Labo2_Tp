<?php
// Inclure le fichier de configuration
require_once 'Config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $designation = $_POST['designation'];
    $idFix = $_POST['idFix'];

    // Requête SQL pour insérer les frais dans la base de données
    $sql = "INSERT INTO frais (designation, idFix) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $designation, $idFix);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger vers la page de liste des frais après l'ajout
        header("Location: ../Frais.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout des frais : " . $conn->error;
    }

    // Fermer la requête et la connexion
    $stmt->close();
    $conn->close();
}
?>
