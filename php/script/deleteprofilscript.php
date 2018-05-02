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


  $old = umask(0);
  chmod($_SERVER["DOCUMENT_ROOT"]."/csv/", '0777');
  unlink(getcwd().$_SERVER["DOCUMENT_ROOT"]."/csv/".$fic_csv['fic_csv']);
  umask($old);

  $old = umask(0);
  chmod($_SERVER["DOCUMENT_ROOT"]."/img/", '0777');
  unlink(getcwd().$_SERVER["DOCUMENT_ROOT"]."/img/".$fic_img['fic_img']);
  umask($old);

  header('Location: ../../index.php');
}
else {
  header('Location: ../../index.php');
}


?>
