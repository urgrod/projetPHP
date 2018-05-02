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

  session_start();
            if(!isset($_SESSION["username"])){
				header('Location:/login.php?error=0');
      }
      
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
      <p>Fiche descriptive du profil</p>
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
          <td>
              <?php
                echo '<a href="../csv/'.$data->fic_csv().'">Exporter en CSV</a>';
              ?>

          </td>

          <td>
            <a>&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</a>
          </td>

          <td>
              <?php
                echo '<a href="../img/'.$data->fic_img().'">Exporter l&#145image</a>';
              ?>

          </td>

          <td>
            <a>&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp</a>
          </td>

          <td>
            <form action="deleteprofil.php" method="get" id="deleteProfil">
              <?php
                echo '<input id="idProfil" name="id" type="hidden" value="'.$_GET['id'].'">';
              ?>
              <button type="submit" class="btn btn-danger">Supprimer le profil</button>
            </form>
          </td>
        </tr>
      </table>
    </div>
    <div class="my-4 p-4 bg-white rounded box-shadow">
      <div class="col-sm-6 col-sm-offset-3">
        <p>Parametres</p>
        <table class="table table-sm table-bordered">
          <tbody>
            <tr>
              <td class="table-light">N:</td>
              <?php
              $N=200;
              echo '<td class="table-default">'.$data->nb_points().'</td>';
              ?>

            </tr>
            <tr>
              <td class="table-light">Corde:</td>
              <?php
              $Corde=10;
              echo '<td class="table-default">'.$data->corde().'</td>';
              ?>
            </tr>
            <tr>
              <td class="table-light">Tmax(%):</td>
              <?php
              $Tmax=15;
              echo '<td class="table-default">'.$data->tmax_pourcent().'</td>';
              ?>
            </tr>
            <tr>
              <td class="table-light">Fmax(%):</td>
              <?php
              $Fmax=10;
              echo '<td class="table-default">'.$data->fmax_pourcent().'</td>';
              ?>
            </tr>
          </tbody>
        </table>
        <?php
        $get_request='id='.$_GET['id'].'&N='.$data->nb_points().'&Corde='.$data->corde().'&Tmax='.$data->tmax_pourcent().'&Fmax='.$data->fmax_pourcent();
        echo '<button type="button" onclick="location.href=\'/php/updateprofil.php?'.$get_request.'\';" class="btn btn-success">Edit</button>'
        ?>

      </div>

    </div>

  </div>

</body>
</html>
