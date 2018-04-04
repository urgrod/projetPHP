<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ajouter un profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
    
</head>
<body>
<div class="container" id="input">
        <form action="php/graph.php" method="POST">
        <div class="form-group">
                <label for="libelle">Libellé</label>
                <input type="text" class="form-control" id="libelle" aria-describedby="libelleHelp">
                <small id="libelleHelp" class="form-text text-muted">Entrez un nom pour votre profil</small>
        </div>
        <div class="form-group">
                <label for="N">N:</label>
                <input type="number" class="form-control" id="N"  min="100" max="1000" aria-describedby="NHelp">
                <small id="NHelp" class="form-text text-muted">Entrez le nombre de points à calculer</small>
        </div>
        <div class="form-group">
                <label for="Corde">Corde:</label>
                <input type="number" class="form-control" id="Corde"  min="10" max="100" aria-describedby="CordeHelp">
                <small id="CordeHelp" class="form-text text-muted">Entrez la corde</small>
        </div>
        <div class="form-group">
                <label for="Tmax">Tmax(%):</label>
                <input type="number" class="form-control" id="Tmax"  min="1" max="20" aria-describedby="TmaxHelp">
                <small id="TmaxHelp" class="form-text text-muted">Entrez Tmax (en pourcentage)</small>
        </div>
        <div class="form-group">
                <label for="Fmax">Fmax(%):</label>
                <input type="number" class="form-control" id="Fmax"  min="1" max="20" aria-describedby="FmaxHelp">
                <small id="FmaxHelp" class="form-text text-muted">Entrez Fmax (en pourcentage)</small>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>            
    </form>
    </div>
</body>
</html>