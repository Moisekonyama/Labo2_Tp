<?php
// Inclure le fichier de configuration
require_once 'Config.php';

// Vérifier si le formulaire d'ajout a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $idEtudiant = $_POST['idEt'];
        $despromotion = $_POST['despromotion'];
    
        // Requête SQL pour insérer une nouvelle promotion
        $sql = "INSERT INTO promotion (idEt, despromotion) VALUES (?, ?) ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        // Lier les paramètres avec leurs types
        $stmt->bind_param("ss", $idEtudiant, $despromotion);
        
        // Exécuter la requête
        if ($stmt->execute()) {
            // Redirection vers la page OptionProm.php après l'ajout
            header("Location: ../PromOption.php");
            exit();
        } else {
            echo "Une erreur s'est produite lors de l'ajout de la promotion.";
        }
}
?>
