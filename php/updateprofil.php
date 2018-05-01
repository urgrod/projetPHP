<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Modifiez un profil</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
        include_once($_SERVER["DOCUMENT_ROOT"]."/include/includes.php");
	?>

</head>
<body class="bg-light mb-5">
    <?php
        include_once($_SERVER["DOCUMENT_ROOT"]."/include/header.php");

        include '../class/ParametreManager.php';
        $db = new PDO('mysql:host=localhost;dbname=projet_php', 'root', '');

          $dataManager = new ParametreManager($db);

          $data = $dataManager->get($_GET['id']);
	?>

<div class="container mt-4" id="header">
        <div class="jumbotron">
            <h1>Modifiez votre profil</h1>
            <p>Rentrez les parametres pour le calcul, nous nous occupons du reste.</p>
        </div>
</div>

<div class="container" id="input">
	<div class="row  justify-content-md-center">
	<div class="col-sm-6 col-sm-offset-3">
	<form action="/php/script/updateprofilscript.php" method="get"><!--9 à remplacer par l'id du profil créé-->

	<?php
    echo '<input type="hidden"id="id" value="'.$data->id().'" name="id">'

	?>

	<div class="form-group">
		<label for="libelle">Libellé</label>
    <?php
		echo '<input type="text" class="form-control" id="libelle" value="'.$data->libelle().'" aria-describedby="libelleHelp" name="libelle">';
    ?>
		<small id="libelleHelp" class="form-text text-muted">Entrez un nom pour votre profil</small>
	</div>
	<div class="form-group">
		<label for="N">N:</label>
		<?php
			echo '<input type="text" class="form-control" id="N" value="'.$data->nb_points().'"aria-describedby="libelleHelp" name="N">'
		?>
		<small id="NHelp" class="form-text text-muted">Entrez le nombre de points à calculer</small>
	</div>
	<div class="form-group">
		<label for="Corde">Corde:</label>
		<?php
			echo '<input type="text" class="form-control" id="corde" value="'.$data->corde().'"aria-describedby="libelleHelp" name="corde">'
		?>
		<small id="CordeHelp" class="form-text text-muted">Entrez la corde</small>
	</div>
	<div class="form-group">
		<label for="Tmax">Tmax(%):</label>
		<?php
			echo '<input type="text" class="form-control" id="Tmax" value="'.$data->tmax_pourcent().'"aria-describedby="libelleHelp" name="Tmax">'
		?>
		<small id="TmaxHelp" class="form-text text-muted">Entrez Tmax (en pourcentage)</small>
	</div>
	<div class="form-group">
		<label for="Fmax">Fmax(%):</label>
		<?php
			echo '<input type="text" class="form-control" id="Fmax" value="'.$data->fmax_pourcent().'"aria-describedby="libelleHelp" name="Fmax">'
		?>
		<small id="FmaxHelp" class="form-text text-muted">Entrez Fmax (en pourcentage)</small>
	</div>
	<button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
	</div>
	</div>
    </div>
</body>
</html>
