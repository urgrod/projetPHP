<?php

/**
*
*/

include 'Cambrure.php';

class CambrureManager
{

  function __construct($db)
  {
    $this->setDb($db);
  }

  public function setDb($db){
    $this->_db = $db;
  }
  public function add($dx, $t, $f, $intra, $extra, $igx, $id, $nb_pts){

    $x=0;
    for ($i=0; $i < $nb_pts; $i++) {


      $sql = "INSERT INTO cambrure (id, x, t, f, yintra, yextra, lgx, id_parametre) VALUES (NULL, $x, $t[$i], $f[$i], $intra[$i], $extra[$i], $igx[$i], $id)";
      $query = $this->_db->prepare($sql);
      $query->execute();

      $x = $x + $dx;
    }

  }

  public function delete($idparam){

    $this->_db->exec("DELETE FROM cambrure WHERE id_parametre =".$idparam);

  }

  public function get($id){

    $query = $this->_db->query("SELECT * FROM parametre WHERE id=".$id);
    $data = $query->fetch(PDO::FETCH_ASSOC);

    return new Cambrure($data);
  }

  public function getList(){

    $cambrures = [];

    $query = $this->_db->query("SELECT * FROM cambrure;");

    While($data = $query->fetch(PDO::FETCH_ASSOC)){
      $cambrures[] = new Cambrure($data);
    }

    return $cambures;
  }

  public function update(Cambrure $cambrure){

    $query = $this->_db->prepare("UPDATE cambrure SET x=:x, t=:t, f=:f, yintra=:yintra, yextra=:yextra, lgx=:lgx, WHERE id=:id");

    $query->bindValue(":x", $cambrure->x());
    $query->bindValue(":t", $cambrure->t());
    $query->bindValue(":f", $cambrure->f());
    $query->bindValue(":yintra", $cambrure->yintra());
    $query->bindValue(":yextra", $cambrure->yextra());
    $query->bindValue(":lgx", $cambrure->igx());
    $query->bindValue(":id", $cambrure->id());

    $query->execute();

  }

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

  public function deleteParam($id){

    $this->_db->exec("DELETE FROM cambrure WHERE id_parametre =".$id);

  }

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
