<?php

/**
*
*/


class CambrureManager
{

  function __construct($db)
  {
    $this->setDb($db);
  }

  public function setDb($db){
    $this->_db = $db;
  }
  public function add(Cambrure $cambrure){

    $query = $this->_db->prepare('INSERT INTO cambrure (id, x, t, yintra, yextra, lgx, id_parametre) VALUES (NULL, :x, :t, :f, :yintra, :yextra, :lgx, :id_parametre)');

    $query->bindValue(":x", $cambrure->x());
    $query->bindValue(":t", $cambrure->t());
    $query->bindValue(":f", $cambrure->f());
    $query->bindValue(":yintra", $cambrure->yintra());
    $query->bindValue(":yextra", $cambrure->yextra());
    $query->bindValue(":lgx", $cambrure->lgx());
    $query->bindValue(":id_parametre", $cambrure->id_parametre());

    $query->execute();
  }

  public function delete(Cambrure $cambrure){

    $this->_db->exec("DELETE FROM cambrure WHERE id =".$cambrure->id());

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
    $query->bindValue(":lgx", $cambrure->lgx());
    $query->bindValue(":id", $cambrure->id());

    $query->execute();

  }

  public function calculYintra( $f,  $t,  $nb_pts){

    for ($x=0; $x <$nb_pts ; $x++) {
      $valF = $f[$x];
      $valT = $t[$x];
      // $calcul = ($valT + $valF);
      $calcul=0;
      $array[] = array($calcul);
    }
    return $array;

  }

  public function calculYextra( $f,  $t,  $nb_pts){

    for ($x=0; $x <$nb_pts ; $x++) {
      $valF = $f[$x];
      $valT = $t[$x];
      // $calcul = ($valT - $valF);
      $calcul =0;
      $array[] = array($calcul);
    }
    return $array;

  }

  public function calculT( $nb_pts, $tmax, $corde){

    for ($x=0; $x <$nb_pts  ; $x++) {
      $epaisseur  = -(1.015*$x/$corde)^4 -2.843*($x/$corde)^3 + 3.516*($x/$corde)^2 +1.26*($x/$corde) - 2.969*($x/$corde)^(0.5)*$tmax;
      $array[] = array($epaisseur);
    }

    return $array;

  }

  public function calculF( $fmax,  $nb_pts, $corde){

    // var_dump($fmax);
    for ($x=0; $x < $nb_pts; $x++) {
      $f = -4*(($x/$corde)^2 - ($x/$corde)).$fmax;
      $array[] = (int)$f;
    }
    // var_dump($array);

    return $array;
  }
}


?>
