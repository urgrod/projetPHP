<?php

include '../class/ParametreManager.php';
$db = new PDO('mysql:host=localhost;dbname=projet_php', 'root', '');

if (isset($_POST['libelle']) && isset($_POST['N']) && isset($_POST['corde']) && isset($_POST['Tmax']) && isset($_POST['Fmax'])) {
  $libelle = $_POST['libelle'];
  $nb_points = $_POST['N'];
  $corde = $_POST['corde'];
  $tmax = $_POST['Tmax'];
  $fmax = $_POST['Fmax'];
  $tmax_mm = $dataManager->calculTmaxmm($data);
  $fmax_mm = $dataManager->calculFmaxmm($data);
  $dateCreation = date('Y-m-d');
  $csv = $dataManager->generateCsv($data);
  $img = $dataManager->generateImg($data);

$dataManager = new ParametreManager($db);
$data = new Parametre(['libelle' => $libelle, 'corde' => $corde, 'tmax_pourcent' => $Tmax, 'fmax_pourcent' => $Fmax, 'nb_points' => $nb_points, 'tmax_mm' =>$tmax_mm, 'fmax_mm' => $fmax_mm, 'date_creation' => $dateCreation,
 'fic_img' => $img, 'fic_csv' => $csv]);

$dataManager->add($data);
}
?>
