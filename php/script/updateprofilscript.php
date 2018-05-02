<?php

include '../../class/ParametreManager.php';
include '../../class/CambrureManager.php';
include_once($_SERVER["DOCUMENT_ROOT"]."/php/constants.php");

$db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);

// if (isset($_POST['libelle']) || isset($_POST['N']) || isset($_POST['corde']) || isset($_POST['Tmax']) || isset($_POST['Fmax']) || isset($_POST['id'])) {
  $libelle = $_GET['libelle'];
  $nb_points = $_GET['N'];
  $corde = $_GET['corde'];
  $tmax = $_GET['Tmax'];
  $idparam = $_GET['id'];
  $fmax = $_GET['Fmax'];


  $parametreManager = new ParametreManager($db);
  $cambrureManager = new CambrureManager($db);

  $tmax_mm = $parametreManager->calculTmaxmm($tmax, $corde);
  $fmax_mm = $parametreManager->calculFmaxmm($fmax, $corde);
  $dateCreation = date('Y-m-d');

  $dx = $corde/$nb_points;
  $t = $cambrureManager->calculT($dx, $nb_points, $tmax, $corde);
  $f = $cambrureManager->calculF($dx, $fmax_mm, $nb_points, $corde);
  $intra = $cambrureManager->calculYintra($f, $t, $nb_points);
  $extra = $cambrureManager->calculYextra($f, $t, $nb_points);

  $csv = $parametreManager->generateCsv($libelle, $intra, $extra);
  $img = $parametreManager->generateImg($libelle, $intra, $extra);

  $igx=0;

$parametre = new Parametre(['id' => $idparam, 'libelle' => $libelle, 'corde' => $corde, 'tmax_pourcent' => $tmax, 'fmax_pourcent' => $fmax, 'nb_points' => $nb_points, 'tmax_mm' =>$tmax_mm, 'fmax_mm' => $fmax_mm, 'date_creation' => $dateCreation,
 'fic_img' => $img, 'fic_csv' => $csv]);
 $cambrure = new Cambrure(['x' => $x, 't' => $t, 'f' => $f, 'yintra' => $intra, 'yextra' => $extra, 'igx' => $igx, 'id_parametre' => $idparam]);

$parametreManager->update($parametre);
$cambrureManager->update($cambrure);


header('Location: ../profil.php?id='.$idparam);
// }
// else {
  // echo "if non passe";
// }
?>
