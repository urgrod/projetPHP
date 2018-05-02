<?php

include '../../class/ParametreManager.php';
include '../../class/CambrureManager.php';

$db = new PDO('mysql:host=localhost;dbname=projet_php', 'root', '');

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $parametreManager = new ParametreManager($db);


  $parametreManager->delete($id);

  header('Location: ../../index.php');
}
else {
  header('Location: ../../index.php');
}


?>
