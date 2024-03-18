<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulaire d'authentification</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  // Fonction pour pré-remplir les champs de formulaire avec des valeurs par défaut
  function fillDefaultValues() {
    document.getElementById("email") = "tplabo@gmail.com";
    document.getElementById("password") = "ISC2024";
  }

  // Fonction pour réinitialiser les champs du formulaire
  function resetForm() {
    document.getElementById("email").value = "";
    document.getElementById("password").value = "";
  }

  // Fonction pour valider le formulaire
  function validateForm(event) {
    event.preventDefault(); // Empêcher l'envoi du formulaire par défaut

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    // Votre code de validation ici...
    console.log("Validation du formulaire...");

    // Vérifier si le formulaire est valide
    if (email === "tplabo@gmail.com" && password === "ISC2024") {
      // Redirection vers la page etudiant.html
      console.log("Redirection vers etudiant.html...");
      window.location.href = "DashBoard.php";
    } else {
      // Afficher un message d'erreur si les informations ne sont pas valides
      console.log("Informations d'identification incorrectes.");
      // Réinitialiser les champs du formulaire pour permettre à l'utilisateur de retenter
      resetForm();
    }
  }
</script>
</head>
<body onload="fillDefaultValues()">

  <div class="container">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Formulaire d'authentification</h2>
            <form onsubmit="validateForm(event)">
              <div class="form-group">
                <label for="email">Adresse e-mail:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Veuillez saisir ton adresse mail" required>
              </div>
              <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  

</body>
</html>
