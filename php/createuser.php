<?php

$EnteredUsername = $_POST["username"];
$EnteredPassword = $_POST["password"];

if(!(isset($_POST["username"]) || isset($_POST["password"]))){
  //redirection vers la page d'authentification avec comme code d'erreur 1 qui correspond a des champs vides
  header('Location:/php/signup.php?error=1');
}

if(strlen($EnteredPassword)<3){
  //redirection vers la page d'authentification avec comme code d'erreur 2 qui correspond a un mot de passe trop court
  header('Location:/php/signup.php?error=2');
}

include_once($_SERVER["DOCUMENT_ROOT"]."/php/constants.php");

//creation de la connexion a la base de donnees
  $db=new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

//requete permettant de recuperer le username et le mot de passe dont le username correspond a celui saisi par l'utilisateur
$request = "SELECT username FROM users WHERE username = :EnteredUsername";
$statement = $db->prepare($request);
$statement->bindParam(":EnteredUsername", $EnteredUsername, PDO::PARAM_INT);

$statement->execute();

$result = $statement->fetch(PDO::FETCH_ASSOC);

if($EnteredUsername == $result['username']){
  //redirection vers la page d'authentification avec comme code d'erreur 3 qui correspond a un mauvais mot de passe
  header('Location:/php/signup.php?error=3');
}

$request = 'INSERT INTO `users` (`id_user`, `username`, `password`) VALUES (NULL,:EnteredUsername , :EnteredPassword);'
$statement = $db->prepare($request);

$statement->bindParam(":EnteredUsername", $EnteredUsername);
$statement->bindParam(":EnteredPassword", $EnteredPassword);

$statement->execute();

header('Location:/php/login.php?success=1');

?>
