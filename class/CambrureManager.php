<?php

/**
*
*/

include 'ParametreManager.php';
include 'Parametre.php';

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
      $cambrures[] = new Parametre($data);
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

  public function calculYintra(Cambrure $cambrure){

      return ($cambrure->f() + $cambrure->t()/2);

  }

  public function calculYextra(Cambrure $cambrure){

    return ($cambrure->f() - $cambrure->t()/2);

  }

  public function calculT(Cambrure $cambrure, Parametre $parametre){

    $x = 0;
    for ($x=0; $x <$cambrure->nb_points()  ; $x++) {
      $epaisseur  = -(1.015*(x/corde)^4 -2.843*(x/corde)^3 + 3.516*(x/corde)^2 +1.26*(x/corde) - 2.969*(x/corde)^(0.5))*($parametre->tmax_mm());

    }

  }

  public function calculF(){

    // $f = -4((x/C)^2 - (x/C)).$parametre->calculFmaxmm();
  }
}


?>
