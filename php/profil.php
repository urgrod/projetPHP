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
<body class="bg-light mb-5">
    <?php
        include_once($_SERVER["DOCUMENT_ROOT"]."/include/header.php");
    ?>
<div class="container mt-4" id="header"> 
        <div class="jumbotron">
        <?php
            echo "<h1>Profil ".$_GET['id']."</h1>";//Il faudra afficher le libellé après
        ?>
        <p>Fiche descriptive du profil</p>         
        </div>
</div>
<div class="container">
	<div class="my-4 p-4 bg-white rounded box-shadow">
        <div class="row">
            <img src="http://via.placeholder.com/600x400" class="rounded mx-auto d-block" alt="profil naca">
        </div>
        <div class="row">
            <button type="button" class="btn btn-primary">Exporter en CSV</button>
        </div>
        
    </div>
    <div class="my-4 p-4 bg-white rounded box-shadow">
        <div class="col-sm-6 col-sm-offset-3">
            <p>Parametres</p>
            <table class="table table-sm table-bordered">
               <tbody>
                    <tr>
                        <td class="table-light">N:</td>
                        <?php
                            $N=200;
                            echo '<td class="table-default">'.$N.'</td>';
                        ?>
                        
                    </tr>
                    <tr>
                        <td class="table-light">Corde:</td>
                        <?php
                            $Corde=10;
                            echo '<td class="table-default">'.$Corde.'</td>';
                        ?>
                    </tr>
                    <tr>
                        <td class="table-light">Tmax(%):</td>
                        <?php
                            $Tmax=15;
                            echo '<td class="table-default">'.$Tmax.'</td>';
                        ?>   
                    </tr>
                    <tr>
                        <td class="table-light">Fmax(%):</td>
                        <?php
                            $Fmax=10;
                            echo '<td class="table-default">'.$Fmax.'</td>';
                        ?>   
                    </tr>
               </tbody>
            </table>
            <?php
                $get_request='N='.$N.'&Corde='.$Corde.'&Tmax='.$Tmax.'&Fmax='.$Fmax;
                echo '<button type="button" onclick="location.href=\'/php/addprofil.php?'.$get_request.'\';" class="btn btn-success">Edit</button>'
            ?>
            
        </div>
        
    </div>
    
</div>
    
</body>
</html>