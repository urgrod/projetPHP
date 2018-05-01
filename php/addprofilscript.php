<?php

include '../class/ParametreManager.php';
$db = new PDO('mysql:host=localhost;dbname=projet_php', 'root', '');

if (isset($_POST['libelle']) && isset($_POST['N']) && isset($_POST['corde']) && isset($_POST['Tmax']) && isset($_POST['Fmax'])) {
  $libelle = $_POST['libelle'];
  $nb_points = $_POST['N'];
  $corde = $_POST['corde'];
  $tmax = $_POST['Tmax'];
  $fmax = $_POST['Fmax'];

  $tmax_mm = $parametreManager->calculTmaxmm($tmax, $corde);
  $fmax_mm = $parametreManager->calculFmaxmm($fmax, $corde);
  $dateCreation = date('Y-m-d');
  $idparam = $parametreManager->getDbId()+1;

  $x = $corde/$nb_points;
  $t = $cambrureManager->calculT($nb_points);
  $f = $cambrureManager->calculF($fmax_mm, $nb_points);
  $intra = $cambrureManager->calculYintra($f, $t, $nb_points);
  $extra = $cambrureManager->calculYextra($f, $t, $nb_points);

  $csv = $parametreManager->generateCsv($libelle, $intra, $extra);
  $img = $parametreManager->generateImg($libelle, $intra, $extra);

  $parametreManager = new ParametreManager($db);
  $cambrureManager = new CambrureManager($db);

$parametre = new Parametre(['libelle' => $libelle, 'corde' => $corde, 'tmax_pourcent' => $Tmax, 'fmax_pourcent' => $Fmax, 'nb_points' => $nb_points, 'tmax_mm' =>$tmax_mm, 'fmax_mm' => $fmax_mm, 'date_creation' => $dateCreation,
 'fic_img' => $img, 'fic_csv' => $csv]);
 $cambrure = new Cambrure(['x' => $x, 't' => $t, 'f' => $f, 'yintra' => $intra, 'yextra' => $extra, 'igx' => $igx, 'id_parametre' => $idparam])

$parametreManager->add($parametre);
$cambrureManager->add($cambrure);

header('')
}
?>
