<?php

/**
 *
 */
class CambrureManager{

  private $_db;

  function __construct(argument)
  {
    $this->setDb($db);
  }

  public function add(Cambrure $cambrure){

    $query = $this->_db->prepare('INSERT INTO cambrure (id, x, t, f, y_intra, y_extra, lgx, id_parametre) VALUES (NULL, :x, :t, :f, :y_intra, :y_extra, :lgx, :id_parametre)')


    $query->bindValue(':x', $cambrure->x());
    $query->bindValue(':t',$cambrure->t());
    $query->bindValue(':f',$cambrure->f());
    $query->bindValue(':y_intra',$cambrure->y_intra());
    $query->bindValue(':y_extra',$cambrure->y_extra());
    $query->bindValue(':lgx',$cambrure->lgx());
    $query->bindValue(':id_parametre',$cambrure->id_parametre());

    $query->execute();

  }

  public function delete(Cambrure){

  }

  public function get($id){

  }

  public function getList(){

  }

  public function update(Cambrure $cambrure){

  }

  public function setDb($db){
    $this->_db = $db;
  }
}


 ?>
