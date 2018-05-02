<?php
$EnteredUsername ='';
$EnteredPassword = '';

/*
Verification si les champs ne sont pas vides, si les mots de passes sont identiques puis si le username existe bien en base

Recuperation du username et mot de passe en POST
verification de la validite des champs obtenus
comparaison avec la base de donnes du username et du password
redirection soit vers la page d'authentification soit vers la gallerie photo
*/

//Verification que les champs ne sont pas vides
if(isset($_POST["username"]) && isset($_POST["password"])){
    include_once($_SERVER["DOCUMENT_ROOT"]."/php/constants.php");

  $EnteredUsername = $_POST["username"];
  $EnteredPassword = $_POST["password"];

//creation de la connexion a la base de donnees
    $db=new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

//requete permettant de recuperer le username et le mot de passe dont le username correspond a celui saisi par l'utilisateur
  $request = "SELECT username,password FROM users WHERE username = :EnteredUsername";
  $statement = $db->prepare($request);
  $statement->bindParam(":EnteredUsername", $EnteredUsername, PDO::PARAM_INT);

  $statement->execute();

  $result = $statement->fetch(PDO::FETCH_ASSOC);
 
  if($EnteredUsername == $result['username']){
    
    if($EnteredPassword == $result["password"]){
      session_start();
      $_SESSION['username'] = $EnteredUsername;
      header('Location:/php/addprofil.php');
      exit();
    }
    else{
      //redirection vers la page d'authentification avec comme code d'erreur 3 qui correspond a un mauvais mot de passe
      header('Location:/php/login.php?error=3');
    }//else mdp
  }
  else{
    //redirection vers la page d'authentification avec comme code d'erreur 2 qui correspond a un mauvais username
    header('Location:/php/login.php?error=2');
  }//fin else username saisi
}
else{
  //redirection vers la page d'authentification avec comme code d'erreur 1 qui correspond a des champs vides
  header('Location:/php/login.php?error=1');
}//fin else verif post


?>
