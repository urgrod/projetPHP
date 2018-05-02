<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Profil Naca</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
  include_once($_SERVER["DOCUMENT_ROOT"]."/include/includes.php");
  ?>
</head>
<body class="bg-light mb-5">
  <?php
  include_once($_SERVER["DOCUMENT_ROOT"]."/include/header.php");
  ?>
  <div class="container mt-4" id="header">
    <div class="jumbotron">
      <?php

      include '../class/ParametreManager.php';
      include_once($_SERVER["DOCUMENT_ROOT"]."/php/constants.php");

      $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

      $dataManager = new ParametreManager($db);

      $data = $dataManager->get($_GET['id']);

      echo "<h1>Profil ".$data->libelle()."</h1>";

      ?>
      <p>Fiche de suppresion du profil</p>
    </div>
  </div>
  <div class="container">
    <div class="my-4 p-4 bg-white rounded box-shadow">
      <div class="row">

        <?php
        echo '<img src="../img/'.$data->fic_img().'" class="rounded mx-auto d-block" alt="profil naca">';

         ?>
      </div>
      <table>
        <tr>
          <p>Voulez-vous supprimer ce profil?</P>
        </tr>
        <tr>
          <td>
            <form action="script/deleteprofilscript.php" method="get" id="deleteProfil">
              <?php
                echo '<input id="idProfil" name="id" type="hidden" value="'.$_GET['id'].'">';
              ?>
              <button type="submit" class="btn btn-danger">Oui</button>
            </form>
          </td>

          <td>
            <a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
          </td>


          <td>
            <form action="profil.php" method="get" id="deleteProfil">
              <?php
                echo '<input id="idProfil" name="id" type="hidden" value="'.$_GET['id'].'">';
              ?>
              <button type="submit" class="btn btn-success">Non</button>
            </form>
          </td>

        </tr>
      </table>
    </div>

  </div>

</body>
</html>
