<?php

/**
* Classe permettant de manipuler les donnees de la classe "cambrure"
*/

include 'Cambrure.php';

class CambrureManager
{

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
  initialise la conection a la base de donnees
  entree: requete PDO
  sortie: ---
  */
  public function setDb($db){
    $this->_db = $db;
  }


  /*
  methode pour enrengistrer en base les valeurs des cambrures
  entree: - la valeur de dx
  - les valeurs de l'epaisseur pour chaque valeur de x
  - les valeurs de la cambrure pour chaque valeur de x
  - les valeurs de l'intrados pour chaque valeur de x
  - les valeurs de l'extrados pour chaque valeur de x
  - les valeurs de l'igx pour chaque valeur de x
  - la valeur de l'id des parametres permettant d'obtenir ces valeurs
  - le nombre de points sur cette cambrure
  sortie: ---
  */
  public function add($dx, $t, $f, $intra, $extra, $igx, $id, $nb_pts){

    $x=0;
    for ($i=0; $i < $nb_pts; $i++) {


      $sql = "INSERT INTO cambrure (id, x, t, f, yintra, yextra, lgx, id_parametre) VALUES (NULL, $x, $t[$i], $f[$i], $intra[$i], $extra[$i], $igx[$i], $id)";
      $query = $this->_db->prepare($sql);
      $query->execute();

      $x = $x + $dx;
    }

  }

  /*
  methode pour supprimer les valeurs d'une cambrure
  entree: - id de la cambrure a supprimer
  sortie: ---
  */
  public function delete($id){

    $this->_db->exec("DELETE FROM cambrure WHERE id =".$id);

  }

  /*
  methode permettant d'obtenir les valeurs correspondant a 1 cambrure
  entree: - valeurs de l'id de la cambrure que l'on cherche
  sortie: - Cambrure contenant toutes les infos de la cambrure voulue
  */
  public function get($id){

    $query = $this->_db->query("SELECT * FROM cambrure WHERE id=".$id);
    $data = $query->fetch(PDO::FETCH_ASSOC);

    return new Cambrure($data);
  }

  /*
  methode permettant d'obtenir toutes les cambrures de la table
  entree: ---
  sortie: tableau de Cambrures contenant toutes les infos de chaque cambrure
  */
  public function getList(){

    $cambrures = [];

    $query = $this->_db->query("SELECT * FROM cambrure;");

    While($data = $query->fetch(PDO::FETCH_ASSOC)){
      $cambrures[] = new Cambrure($data);
    }

    return $cambures;
  }

  /*
  methode permettant de mettre a jour toutes les cambrures voulues
  entree: Cambrure contenant toutes les infos
  sortie: ---
  */
  public function update($cambrure){

    for ($i=0; $i < count($cambrure) ; $i++) {

      $query = $this->_db->prepare("UPDATE cambrure SET x=:x, t=:t, f=:f, yintra=:yintra, yextra=:yextra, lgx=:lgx, WHERE id=:id");

      $query->bindValue(":x", $cambrure[$i]->x());
      $query->bindValue(":t", $cambrure[$i]->t());
      $query->bindValue(":f", $cambrure[$i]->f());
      $query->bindValue(":yintra", $cambrure[$i]->yintra());
      $query->bindValue(":yextra", $cambrure[$i]->yextra());
      $query->bindValue(":lgx", $cambrure[$i]->igx());
      $query->bindValue(":id", $cambrure[$i]->id());

      $query->execute();
    }

  }

  /*
  methode permettant de calcul les valeurs de l'intrados
  entree: - les valeurs de la cambrures
  - les valeurs de l'epaisseur
  - le nombre de points
  sortie: - tableau d'intrados
  */
  public function calculYintra( $f,  $t,  $nb_pts){

    $array = array();

    for ($x=0; $x <$nb_pts ; $x++) {
      $valF = $f[$x];
      $valT = $t[$x];
      $calcul = ($f[$x] - ($t[$x]/2));
      $array[] = $calcul;
    }
    return $array;
  }

  /*
  methode permettant de calculer les valeurs de l'extrados
  entree: - les valeurs de la cambrures
  - les valeurs de l'epaisseur
  - le nombre de points
  sortie: - tableau d'extrados
  */

  public function calculYextra( $f,  $t,  $nb_pts){

    $array = array();

    for ($x=0; $x <$nb_pts ; $x++) {
      $valF = $f[$x];
      $valT = $t[$x];
      $calcul = ($f[$x] + ($t[$x]/2));
      $array[] = $calcul;
    }
    return $array;
  }

  /*
  methode permettant de calculer chaque valeur de l'epaisseur selon x
  entree: - la valeur de dx
  - le nombre de points
  - l'epaisseur max en mm
  - la valeur de la corde en mm
  sortie: - tableau d'epaisseur pour chaque x
  */
  public function calculT($dx, $nb_pts, $tmax, $corde){

    $x=0;
    $array = array();

    for ($i=0; $i <$nb_pts  ; $i++) {
      $div = $x/$corde;
      $epaisseur = -1*(1.015*pow($div, 4) -2.843*pow($div, 3) +3.516*pow($div, 2) +1.26*($div) - 2.969*pow($div, 0.5))*$tmax;
      $array[] = $epaisseur;

      $x = $x + $dx;
    }

    return $array;
  }

  /*
  methode permettant de calculer chaque valeur de la cambrure selon x
  entree: - la valeur de dx
  - le nombre de points
  - l'epaisseur max en mm
  - la valeur de la corde en mm
  sortie: - tableau de cambrure pour chaque x
  */
  public function calculF($dx, $nb_pts, $fmax, $corde){

    $x=0;
    $array = array();

    for ($i=0; $i < $nb_pts; $i++) {
      $div = $x /$corde;
      $f = -4*(pow($div, 2) - $div)*$fmax;
      $array[] = $f;

      $x = $x + $dx;
    }

    return $array;
  }

  /*
  methode permettant de supprimer les valeurs d'une cambrure correspondant a 1 parametre
  entree: - valeur de l'id du parametre qui gere les cambrures a supprimer
  sortie: ---
  */
  public function deleteParam($id){

    $this->_db->exec("DELETE FROM cambrure WHERE id_parametre =".$id);
  }

  /*
  methode permettant de calculer chaque valeur de igx selon x
  entree: - valeur de dx
  - tableau de toutes les valeurs de l'intrados
  - tableau de toutes les valeurs de l'extrados
  - nombre de points
  sortie: tableau contenant toutes les valeurs de igx selon x
  */
  public function calculIgx($dx, $intra, $extra, $nb_pts){

    $x =0;

    for ($i=0; $i <$nb_pts ; $i++) {
      $e = ($intra[$i] + $extra[$i])/2;
      $igz = ($x*pow($e, 3))/12;

      $array[] = $igz;

      $x = $x + $dx;
    }

    return $array;
  }
}


?>
