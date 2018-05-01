<?php

include '../class/ParametreManager.php';
include '../class/CambrureManager.php';

$db = new PDO('mysql:host=localhost;dbname=projet_php', 'root', '');

// if (isset($_GET['libelle']) && isset($_GET['N']) && isset($_GET['corde']) && isset($_GET['Tmax']) && isset($_GET['Fmax'])) {
  $libelle = $_GET['libelle'];
  $nb_points = $_GET['N'];
  $corde = $_GET['corde'];
  $tmax = $_GET['Tmax'];
  $fmax = $_GET['Fmax'];

  $parametreManager = new ParametreManager($db);
  $cambrureManager = new CambrureManager($db);

  $tmax_mm = $parametreManager->calculTmaxmm($tmax, $corde);
  $fmax_mm = $parametreManager->calculFmaxmm($fmax, $corde);
  $dateCreation = date('Y-m-d');
  $returnId = $parametreManager->getDbId();
  $idparam = $returnId['id'];

  $x = $corde/$nb_points;
  $t = $cambrureManager->calculT($nb_points, $tmax_mm, $corde);
  $f = $cambrureManager->calculF($fmax_mm, $nb_points, $corde);
  $intra = $cambrureManager->calculYintra($f, $t, $nb_points);
  $extra = $cambrureManager->calculYextra($f, $t, $nb_points);

  $csv = $parametreManager->generateCsv($libelle, $intra, $extra);
  $img = $parametreManager->generateImg($libelle, $intra, $extra);


$parametre = new Parametre(['libelle' => $libelle, 'corde' => $corde, 'tmax_pourcent' => $Tmax, 'fmax_pourcent' => $Fmax, 'nb_points' => $nb_points, 'tmax_mm' =>$tmax_mm, 'fmax_mm' => $fmax_mm, 'date_creation' => $dateCreation,
 'fic_img' => $img, 'fic_csv' => $csv]);
 $cambrure = new Cambrure(['x' => $x, 't' => $t, 'f' => $f, 'yintra' => $intra, 'yextra' => $extra, 'igx' => $igx, 'id_parametre' => $idparam]);

 var_dump($parametre);

$parametreManager->add($parametre);
$cambrureManager->add($cambrure);

// header('');
// }
// else {
//   echo "if non valide";
// }
?>
