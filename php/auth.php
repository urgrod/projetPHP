<?php
$loginSaisi ='';
$mdpSaisi = '';

/*
Verification si les champs ne sont pas vides, si les mots de passes sont identiques puis si le login existe bien en base

Recuperation du login et mot de passe en POST
verification de la validite des champs obtenus
comparaison avec la base de donnes du login et du password
redirection soit vers la page d'authentification soit vers la gallerie photo
*/

//Verification que les champs ne sont pas vides
if(isset($_POST["login"]) || isset($_POST["password"])){
  include 'database.php';

  $loginSaisi = $_POST["login"];
  $mdpSaisi = $_POST["password"];

//creation de la connexion a la base de donnees
  $db = dbConnect();

//requete permettant de recuperer le login et le mot de passe dont le login correspond a celui saisi par l'utilisateur
  $request = "SELECT login,password FROM users WHERE login = :loginSaisi";
  $statement = $db->prepare($request);
  $statement->bindParam(":loginSaisi", $loginSaisi, PDO::PARAM_INT);

  $statement->execute();



  $result = $statement->fetch(PDO::FETCH_ASSOC);

  if($loginSaisi == $result['login']){

    $mdpSaisiChiffre = sha1($mdpSaisi);

    if($mdpSaisiChiffre == $result["password"]){
      //redirection vers la page contenant les images si l'authentification est correcte + ajout du login de l'utilisateur dans l'url
      header('Location:/index.php');
      exit();


    }
    else{
      //redirection vers la page d'authentification avec comme code d'erreur 3 qui correspond a un mauvais mot de passe
      header('Location:/php/login.php?error=3');


    }//else mdp
  }
  else{
    //redirection vers la page d'authentification avec comme code d'erreur 2 qui correspond a un mauvais login
    header('Location:/php/login.php?error=2');


  }//fin else login saisi
}
else{
  //redirection vers la page d'authentification avec comme code d'erreur 1 qui correspond a des champs vides
  header('Location:/php/login.php?error=1');

}//fin else verif post


?>
