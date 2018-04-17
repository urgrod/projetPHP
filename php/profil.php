<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profil Naca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        include_once($_SERVER["DOCUMENT_ROOT"]."/include/includes.php");
	?>
</head>
<body>
    <?php
        include_once($_SERVER["DOCUMENT_ROOT"]."/include/header.php");
    ?>
<div class="container" id="header"> 
        <div class="jumbotron">
            <h1>Profil 'libellé'</h1>
            <p>Description complete du profil</p>
        </div>
</div>
<div class="container">
	<div class="row border border-light">
        <div class="col-sm-6 col-sm-offset-3">
            <img src="http://via.placeholder.com/600x400" alt="profil naca">
            <p>test</p>
        </div>
        
    </div>
    <div class="row">
        <h2>Paramêtres:</h2>
        <button type="button" class="btn btn-primary">Export CSV</button>
    </div>
</div>
    
</body>
</html>