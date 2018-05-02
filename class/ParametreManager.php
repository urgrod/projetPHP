<?php

/**
* Classe permettant de manipuler les donnees de la classe "Parametre"
*/

include 'Parametre.php';

class ParametreManager{

  private $_db;

  /*
  Constrcuteur de la classe
  entree: requete PDO
  sortie: ---
  */

  function __construct($db)
  {
    $this->setDb($db);
  }

  /*
  methode pour enrengistrer en base les valeurs des parametres
  entree: Parametre contenant toutes les infos des parametres
  sortie: ---
  */
  public function add(Parametre $parametre){

    $query = $this->_db->prepare('INSERT INTO parametre (id, libelle, corde, tmax_mm, tmax_pourcent, fmax_mm, fmax_pourcent, nb_points, date_creation, fic_img, fic_csv) VALUES (NULL, :libelle, :corde, :tmax_mm, :tmax_pourcent, :fmax_mm, :fmax_pourcent, :nb_points, :date_creation, :fic_img, :fic_csv);');

    $query->bindValue(":libelle", $parametre->libelle());
    $query->bindValue(":corde", $parametre->corde());
    $query->bindValue(":tmax_mm", $parametre->tmax_mm());
    $query->bindValue(":tmax_pourcent", $parametre->tmax_pourcent());
    $query->bindValue(":fmax_mm", $parametre->fmax_mm());
    $query->bindValue(":fmax_pourcent", $parametre->fmax_pourcent());
    $query->bindValue(":nb_points", $parametre->nb_points());
    $query->bindValue(":date_creation", $parametre->date_creation());
    $query->bindValue(":fic_img", $parametre->fic_img());
    $query->bindValue(":fic_csv", $parametre->fic_csv());


    $query->execute();
  }

  /*
  methode pour supprimer les valeurs des parametres
  entree: - id des parametres a supprimer
  sortie: ---
  */
  public function delete($id){

    $this->_db->exec("DELETE FROM parametre WHERE id =".$id);
  }

  /*
  methode permettant d'obtenir les valeurs correspondant a 1 jeu de parametre
  entree: - valeur de l'id des parametres que l'on cherche
  sortie: - Parametre contentant toutes les infos des parametres voulues
  */
  public function get($id){
    $id = (int) $id;

    $query = $this->_db->query("SELECT * FROM parametre WHERE id =".$id);
    $data = $query->fetch(PDO::FETCH_ASSOC);

    return new Parametre($data);
  }

  /*
  methode permettant d'obtenir tout les parametres de la table
  entree: ---
  sortie: tableau de Parametres contenant toutes les infos de chaque parametre
  */
  public function getList(){
    $parametres = [];

    $query = $this->_db->query("SELECT * FROM parametre");

    While($data = $query->fetch(PDO::FETCH_ASSOC)){

      $parametres[] = new Parametre($data);
    }

    return $parametres;
  }

  /*
  methode permettant de mettre a jour les parametres voulues
  entree: Parametre contenant toutes les infos du parametre
  sortie: ---
  */
  public function update(Parametre $parametre){

    $query = $this->_db->prepare("UPDATE parametre SET libelle=:libelle, corde =:corde, tmax_mm =:tmax_mm, tmax_pourcent =:tmax_pourcent, fmax_mm =:fmax_mm, fmax_pourcent =:fmax_pourcent, nb_points=:nb_points, date_creation=:date_creation WHERE id=:id");

    $query->bindValue(":libelle", $parametre->libelle(), PDO::PARAM_INT);
    $query->bindValue(":corde", $parametre->corde(), PDO::PARAM_INT);
    $query->bindValue(":tmax_mm", $parametre->tmax_mm(), PDO::PARAM_INT);
    $query->bindValue(":tmax_pourcent", $parametre->tmax_pourcent(), PDO::PARAM_INT);
    $query->bindValue(":fmax_mm", $parametre->fmax_mm(), PDO::PARAM_INT);
    $query->bindValue(":fmax_pourcent", $parametre->fmax_pourcent(), PDO::PARAM_INT);
    $query->bindValue(":nb_points", $parametre->nb_points(), PDO::PARAM_INT);
    $query->bindValue(":date_creation", $parametre->date_creation(), PDO::PARAM_INT);
    $query->bindValue(":id", $parametre->id(), PDO::PARAM_INT);

    $query->execute();
  }

  /*
  initialise la conection a la base de donnees
  entree: requete PDO
  sortie: ---
  */
  public function setDb($db){
    $this->_db = $db;
  }

  /*
  methode pour calculer l'epaisseru en mm
  entree: - epaisseur max en %
  - corde en mm
  sortie: - valeur de l'epaisseur en mm
  */
  public function calculTmaxmm($tmax_pourcent, $corde){

    return ($tmax_pourcent*$corde)/100;
  }

  /*
  methode pour calculer la cambrure en mm
  entree: - cambrure max en %
  - corde en mm
  sortie: - valeur de la cambrure en mm
  */
  public function calculFmaxmm($fmax_pourcent, $corde){

    return ($fmax_pourcent*$corde)/100;
  }

  /*
  methode permettant de generer le fichier csv
  entree: - nom du jeu de parametres
  - tableau des intrados
  - tableau des Extrados
  - valeur de l'id du jeu de parametres
  sortie: - nom du fichier genere
  */
  public function generateCsv($nom, $intraArray, $extraArray, $id){

    for ($i=0; $i<sizeof($intraArray); $i++) {
      $lignes[] = array($i, $intraArray[$i], $extraArray[$i], );
    }

    $path = '../../csv/'.$nom.'-'.$id.'.csv';
    $separateur = ',';
    $file = fopen($path, 'w+');

    foreach ($lignes as $ligne) {
      fputcsv($file, $ligne, $separateur);
    }

    fclose($file);

    return $nom.'-'.$id.'.csv';
  }

  /*
  methode permettant de generer le graphique
  entree: - nom du jeu de parametres
  - tableau des intrados
  - tableau des Extrados
  - valeur de l'id du jeu de parametres
  sortie: - nom du graphique genere
  */
  public function generateImg($nom, $intraArray, $extraArray, $id){

    require_once ($_SERVER["DOCUMENT_ROOT"]."/jpgraph-4.2.0/src/jpgraph.php");
    require_once ($_SERVER["DOCUMENT_ROOT"]."/jpgraph-4.2.0/src/jpgraph_line.php");

    $graph = new Graph(500, 500);

    $theme_class = new UniversalTheme;
    $graph->SetScale("intlin");
    $graph->SetTheme($theme_class);
    $graph->img->SetAntiAliasing(false);
    $graph->title->Set($nom.'-'.$id);
    $graph->SetBox(false);

    $graph->img->SetAntiAliasing();

    $graph->yaxis->HideZeroLabel();
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false,false);

    $graph->xgrid->Show();
    $graph->xgrid->SetLineStyle("solid");
    $graph->xgrid->SetColor('#E3E3E3');

    $intra = new LinePlot($intraArray);
    $graph->Add($intra);
    $intra->SetColor("#FF0000");
    $intra->SetLegend('Intrados');

    $extra = new LinePlot($extraArray);
    $graph->Add($extra);
    $extra->SetColor("#6495ED");
    $extra->SetLegend('Extrados');

    $graph->legend->SetFrameWeight(1);
    // $graph->Stroke();
    $graph->Stroke('../../img/'.$nom.'-'.$id.'.png');

    return $nom.'-'.$id.'.png';
  }


  /*
  methode permettant d'obtenir la derniere valeure de l'id en base
  entree: ---
  sortie: valeur de l'id
  */
  public function getDbId(){
    $query = $this->_db->query("SELECT id FROM parametre ORDER BY id DESC");
    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  /*
  methode retournant le nom de l'image recherche
  entree: - valeur de l'id de l'image cherchee
  sortie: - nom de l'image cherche
  */
  public function getDbImg($id){
    $query = $this->_db->query("SELECT fic_img FROM parametre ORDER BY id DESC");
    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  /*
  methode retournant le nom du csv recherche
  entree: - valeur de l'id du csv cherchee
  sortie: - nom du csv cherche
  */
  public function getDbCsv($id){
    $query = $this->_db->query("SELECT fic_csv FROM parametre ORDER BY id DESC");
    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;

  }

}


?>
