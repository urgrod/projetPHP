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
	?>
<div class="container">

<form class="form-signin w-25 mx-auto mt-5">
  <h2 class="form-signin-heading">Connectez-vous</h2>
  <label for="inputEmail" class="sr-only">Adresse mail</label>
  <input type="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required="" autofocus="">
  <label for="inputPassword" class="sr-only">Password</label>
  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
  <div class="checkbox">
    <label>
      <input type="checkbox" value="remember-me"> Se souvenir de moi
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
</form>

</div>
  

</body>
</html>
