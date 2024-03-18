<?php
// Inclure le fichier de configuration
require_once 'Config.php';

// Vérifier si un ID d'étudiant est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer l'étudiant de la base de données
    $sql = "DELETE FROM etudiant WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Rediriger vers la page Dashboard.php après suppression
    header("Location: ../Dashboard.php");
    exit();
} else {
    echo "ID d'étudiant non spécifié.";
}
?>
