<?php

include '../class/ParametreManager.php';
$db = new PDO('mysql:host=localhost;dbname=projet_php', 'root', '');

if (isset($_POST['libelle']) && isset($_POST['N']) && isset($_POST['corde']) && isset($_POST['Tmax']) && isset($_POST['Fmax'])&& isset($_POST['id'])) {
  $libelle = $_POST['libelle'];
  $nb_points = $_POST['N'];
  $corde = $_POST['corde'];
  $tmax = $_POST['Tmax'];
  $idparam = $_POST['id'];
  $fmax = $_POST['Fmax'];

  $tmax_mm = $parametreManager->calculTmaxmm($parametre);
  $fmax_mm = $parametreManager->calculFmaxmm($parametre);
  $dateCreation = date('Y-m-d');
  $csv = $parametreManager->generateCsv($parametre);
  $img = $parametreManager->generateImg($parametre);

  $x = $corde/$nb_points;
  $t = $cambrureManager->calculT($nb_points);
  $f = $cambrureManager->calculF($fmax_mm, $nb_points);
  $intra = $cambrureManager->calculYintra($f, $t, $nb_points);
  $extra = $cambrureManager->calculYextra($f, $t, $nb_points);

$parametreManager = new ParametreManager($db);
$cambrureManager = new CambrureManager($db);

$parametre = new Parametre(['id' => $id, 'libelle' => $libelle, 'corde' => $corde, 'tmax_pourcent' => $Tmax, 'fmax_pourcent' => $Fmax, 'nb_points' => $nb_points, 'tmax_mm' =>$tmax_mm, 'fmax_mm' => $fmax_mm, 'date_creation' => $dateCreation,
 'fic_img' => $img, 'fic_csv' => $csv]);
 $cambrure = new Cambrure(['x' => $x, 't' => $t, 'f' => $f, 'yintra' => $intra, 'yextra' => $extra, 'igx' => $igx, 'id_parametre' => $idparam])

$parametreManager->update($parametre);
$cambrureManager->update($cambrure);

header('')
}
?>
