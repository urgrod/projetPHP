<?php

include '../../class/ParametreManager.php';
include '../../class/CambrureManager.php';
include_once($_SERVER["DOCUMENT_ROOT"]."/php/constants.php");

$db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $parametreManager = new ParametreManager($db);
  $cambrureManager = new CambrureManager($db);


  $cambrureManager->delete($id);
  $parametreManager->delete($id);
  $fic_img = $parametreManager->getDbImg($id);
  $fic_csv = $parametreManager->getDbCsv($id);

  // unlink("../../csv/".$fic_csv);
  // unlink("../../img/".$fic_img);


  header('Location: ../../index.php');
}
else {
  // header('Location: ../../index.php');
}


?>
