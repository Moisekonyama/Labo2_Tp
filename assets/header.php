<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tableau de bord de l'étudiant</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<script>
function deconnexion() {
  // Suppression du cookie nommé "session"
  document.cookie = "session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  // Effacer les données stockées localement (si nécessaire)
  localStorage.removeItem("sessionData");
  
  // Fermer la fenêtre actuelle
  window.close();
  // Rediriger vers la page d'accueil
  window.location.href = "index.php";
}
</script>
</head>
<body>

<div class="container-fluid">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Mon Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#" onclick="deconnexion()">Déconnexion</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <br>

        <ul class="list-group">
        <li class="list-group-item active" aria-current="true"><a href="DashBoard.php" style="text-decoration:none; color:#fff">Mon Dashboard</a></li>
        <li class="list-group-item"><a href="PromOption.php" style="text-decoration:none; color:#000">Nos Options</a></li>
        <li class="list-group-item"><a href="Inscription.php" style="text-decoration:none; color:#000">Inscription</a></li>
        <li class="list-group-item"><a href="fixationFrais.php" style="text-decoration:none; color:#000">Fixation Frais</a></li>
        <li class="list-group-item"><a href="Frais.php" style="text-decoration:none; color:#000">Frais</a></li>
      </ul>
      </div>
    </nav>