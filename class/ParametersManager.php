<?php

/**
 *
 */
class ParametersManager{

  private $_db;

  function __construct(argument)
  {
    $this->setDb($db);
  }

  public function add(Cambrure $cambrure){

    $query = $this->_db->prepare('INSERT INTO parametre (id, x, t, f, y_intra, y_extra, lgx, id_parametre) VALUES (NULL, :x, :t, :f, :y_intra, :y_extra, :lgx, :id_parametre)')


    $query->bindValue(':x', $cambrure->x());
    $query->bindValue(':t',$cambrure->t());
    $query->bindValue(':f',$cambrure->f());
    $query->bindValue(':y_intra',$cambrure->y_intra());
    $query->bindValue(':y_extra',$cambrure->y_extra());
    $query->bindValue(':lgx',$cambrure->lgx());
    $query->bindValue(':id_parametre',$cambrure->id_parametre());

    $query->execute();

  }

  public function delete(Cambrure $cambrure){

    $this->_db->exec("DELETE FROM cambrure WHERE id =".$cambrure->id());
  }

  public function get($id){
    $id = (int) $id;

    $query = $this->_db->query("SELECT * FROM cambrure WHERE id =".$id);
    $data = $query->fetch(PDO::FETCH_ASSOC);

    return new Cambrure($data);
  }

  public function getList(){
    $cambrures = [];

    $query = $this->_db->query("SELECT * FROM cambrure");

    While($data = $query->fetch(PDO::FETCH_ASSOC)){

      $cambrures[] = new Cambrure($data);
    }

    return $cambrures;

  }

  public function update(Cambrure $cambrure){

    $query = $this->_db->prepare("UPDATE cambrure SET x=:x, t=:t, f=:f, y_intra=:y_intra, y_extra=:y_extra, lgx=:lgx WHERE id=:id");

    $query->bindValue(":x", $cambrure->, PDO::PARAM_INT);
    $query->bindValue(":t", $cambrure->, PDO::PARAM_INT);
    $query->bindValue(":f", $cambrure->, PDO::PARAM_INT);
    $query->bindValue(":y_intra", $cambrure->, PDO::PARAM_INT);
    $query->bindValue(":y_extra", $cambrure->, PDO::PARAM_INT);
    $query->bindValue(":lgx", $cambrure->, PDO::PARAM_INT);
    $query->bindValue(":id", $cambrure->, PDO::PARAM_INT);

  }

  public function setDb($db){
    $this->_db = $db;
  }
}


 ?>
