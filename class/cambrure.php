<?php

/**
* Classe comprenant seulement les getters, les setters ainsi qu'une methode d'hydratation
* Chaque attribut correspond a un champ dans la table "cambrure" dans la base de donnees 
*/
class Cambrure
{

  private $_id;
  private $_x;
  private $_t;
  private $_f;
  private $_yintra;
  private $_yextra;
  private $_igx;
  private $_id_parametre;

  public function __construct(array $data){
    $this->hydrate($data);
  }

  public function id(){
    return $this->_id;
  }

  public function x(){
    return $this->_x;
  }

  public function t(){
    return $this->_t;
  }

  public function f(){
    return $this->_f;
  }

  public function yintra(){
    return $this->_yintra;
  }

  public function yextra(){
    return $this->_yextra;
  }

  public function igx(){
    return $this->_igx;
  }

  public function id_parametre(){
    return $this->_id_parametre;
  }


  public function setId($id){
    $this->_id = (int) $id;
  }

  public function setX($x){
    $this->_x = (int) $x;
  }

  public function setT($t){
    $this->_t = (int) $t;
  }

  public function setF($f){
    $this->_f = (int) $f;
  }

  public function setYintra($yintra){
    $this->_yintra = (int) $yintra;
  }

  public function setYextra($yextra){
    $this->_yextra = (int) $yextra;
  }

  public function setIgx($igx){
    $this->_igx = (int) $igx;
  }

  public function setId_parametre($id_parametre){
    $this->_id_parametre = (int) $id_parametre;
  }


  public function hydrate(array $donnees){

    foreach ($donnees as $key => $value){

      $method = 'set'.ucfirst($key);
      if (method_exists($this, $method)){

        $this->$method($value);
      }
    }
  }





}



?>
