<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ajouter un profil</title>
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
				header('Location:/php/login.php?error=0');
			}
	?>

	

<div class="container mt-4" id="header">
        <div class="jumbotron">
            <h1>Ajoutez votre profil</h1>
            <p>Rentrez les parametres pour le calcul, nous nous occupons du reste.</p>
        </div>
</div>

<div class="container" id="input">
	<div class="row  justify-content-md-center">
	<div class="col-sm-6 col-sm-offset-3">
	<form action="/php/script/addprofilscript.php" method="post"><!--9 à remplacer par l'id du profil créé-->

	<?php
		$placeholders=array();
		if(isset($_GET['N'])){
			$placeholders[0]=$_GET['N'];
			$placeholders[1]=$_GET['Corde'];
			$placeholders[2]=$_GET['Tmax'];
			$placeholders[3]=$_GET['Fmax'];
		}else{
			for ($i=0; $i < 4; $i++) {
				$placeholders[$i]="";
			}
		}
	?>

	<div class="form-group">
		<label for="libelle">Libellé</label>
		<input type="text" class="form-control" id="libelle" aria-describedby="libelleHelp" name="libelle">
		<small id="libelleHelp" class="form-text text-muted">Entrez un nom pour votre profil</small>
	</div>
	<div class="form-group">
		<label for="N">N:</label>
		<?php
			echo '<input type="text" class="form-control" id="N" value="'.$placeholders[0].'"aria-describedby="libelleHelp" name="N">'
		?>
		<small id="NHelp" class="form-text text-muted">Entrez le nombre de points à calculer</small>
	</div>
	<div class="form-group">
		<label for="Corde">Corde:</label>
		<?php
			echo '<input type="text" class="form-control" id="corde" value="'.$placeholders[1].'"aria-describedby="libelleHelp" name="corde">'
		?>
		<small id="CordeHelp" class="form-text text-muted">Entrez la corde</small>
	</div>
	<div class="form-group">
		<label for="Tmax">Tmax(%):</label>
		<?php
			echo '<input type="text" class="form-control" id="Tmax" value="'.$placeholders[2].'"aria-describedby="libelleHelp" name="Tmax">'
		?>
		<small id="TmaxHelp" class="form-text text-muted">Entrez Tmax (en pourcentage)</small>
	</div>
	<div class="form-group">
		<label for="Fmax">Fmax(%):</label>
		<?php
			echo '<input type="text" class="form-control" id="Fmax" value="'.$placeholders[3].'"aria-describedby="libelleHelp" name="Fmax">'
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
