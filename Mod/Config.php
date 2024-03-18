<?php
// Informations de connexion à la base de données
$servername = "localhost";
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$dbname = "gestionpayement"; // Nom de la base de données

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
// if ($conn->connect_error) {
//     die("La connexion à la base de données a échoué : " . $conn->connect_error);
// } else {
//     echo "Connexion réussie à la base de données.";
// }
?>