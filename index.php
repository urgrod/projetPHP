<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cambrure d'un profil Naca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        include_once($_SERVER["DOCUMENT_ROOT"]."/include/includes.php");
    ?>
    <script src="main.js"></script>
</head>
<body class="bg-light">
    <?php
        include_once($_SERVER["DOCUMENT_ROOT"]."/include/header.php");
	?>

    <div class="container" id="header"> 
        <div class="jumbotron">
            <h1>Cambrure d'un profil Naca</h1>
            <p>Bienvenue sur notre site</p>
            <p>Il a été réalisé dans le cadre d'un projet dont le but était de representer un profil Naca</p>
        </div>
    </div>
   
    <div class="container">
        <div class="col-sm-12" id="gallery">        
            <div class="row">
                <?php
                //Faire des requetes bdd pour remplacer les valeurs brutes
                    $nbr=6;
                    $ids=array(1,2,3,4,5,6);
                    $imgurl=array("empty",
                    "http://via.placeholder.com/150x150",
                    "http://via.placeholder.com/150x150",
                    "http://via.placeholder.com/150x150",
                    "http://via.placeholder.com/150x150",
                    "http://via.placeholder.com/150x150",
                    "http://via.placeholder.com/150x150");

                    for ($i=0; $i < $nbr; $i++) { 
                        echo'<div class="col-md-3">';
                        echo'<div class="item">';
                        echo'<img class="preview" src='.$imgurl[$ids[$i]].' onclick="location.href=\'php/profil.php?profil='.$ids[$i].'\';" alt="click to zoom">';
                        echo'<h3>Libelle</h3>';
                        echo'</div></div>';

                    }
                ?>
                <div class="col-md-3">
                    <div class="item">
                    <a href="php/addprofil.php">
                        <img class="preview" src="/img/plus.png" alt="click to zoom">
                    </a>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        
</body>
</html>