<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cambrure d'un profil Naca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        include_once($_SERVER["DOCUMENT_ROOT"]."/include/includes.php");
    ?>
</head>
<body class="bg-light mb-5">
    <?php
        include_once($_SERVER["DOCUMENT_ROOT"]."/include/header.php");

        if(isset($_GET['error'])){
          echo '<div id="errors" class="container mt-3"><div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>';
          switch($_GET['error']){
            case 1:
              echo "Erreur:</strong> Un des champs était vide";
            break;
            case 2:
              echo "Erreur:</strong> Mot de passe trop court (minimum 3 caractères)";
            break;
            case 3:
             echo "Erreur:</strong> Nom d'utilisateur déjà prit";
            break;
          }
          echo "</div></div>";
        }
	?>
<div class="container">

<form class="form-signin w-25 mx-auto mt-5 text-center" data-toggle="validator" action="/php/createuser.php" method="post"><!-- A voir comment on gère la redirection-->
  <h2 class="form-signin-heading">Inscription</h2>
  <label for="inputName" class="sr-only">Nom d'utilisateur</label>
  <input type="text" id="inputName" name="username" class="form-control" placeholder="Nom d'utilisateur" required autofocus="" required>

  <label for="inputPassword" class="sr-only">Mot de passe</label>
  <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="">
  <small id="passwordHelpBlock" class="form-text text-muted">Longueur minimale: 3 caractères</small>
  <div class="checkbox">
    <label>
      <input type="checkbox" value="remember-me"> Se souvenir de moi
    </label>
  </div>

  <div class="text-center">
    <button class="btn btn-lg btn-primary btn-block w-50" type="submit">S'inscrire</button>
  </div>
  <div class="login-help">
		<a href="login.php">Se connecter avec un compte existant</a>
	</div>
</form>

</div>
  

</body>
</html>
