<?php
// Inclure le fichier de configuration
require_once 'Config.php';
// Vérifier si le formulaire d'ajout a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $desoption = $_POST['desoption'];

    // Requête SQL pour insérer une nouvelle option
    $sql = "INSERT INTO options (desoption) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $desoption);
    
    // Exécuter la requête
    if ($stmt->execute()) {
        // Redirection vers la page OptionProm.php après l'ajout
        header("Location: ../PromOption.php");
        exit();
    } else {
        echo "Une erreur s'est produite lors de l'ajout de l'option.";
    }
}
?>
