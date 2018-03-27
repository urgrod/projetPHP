<?php

class Cambrure{

  private $_id;
  private $_libelle;
  private $_corde;
  private $_tmax_pourcent;
  private $_tmax_mm;
  private $_fmax_pourcent;
  private $_fmax_mm;
  private $_nb_pts;
  private $_date_creation;
  private $_fic_img;
  private $_fig_csv;

  public function id(){
    return $this->_id;
  }

  public function libelle(){
    return $this->_libelle;
  }

  public function corde(){
    return $this->_corde;
  }

  public function tmax_pourcent(){
    return $this->$_tmax_pourcent;
  }

  public function tmax_mm(){
    return $this->$_tmax_mm;
  }

  public function fmax_pourcent(){
    return $this->$_fmax_pourcent;
  }

  public function fmax_mm(){
    return $this->$_fmax_mm;
  }

  public function nb_pts(){
    return $this->$_nb_pts;
  }

  public function date_creation(){
    return $this->$_date_creation;
  }

  public function fic_img(){
    return $this->$_fic_img;
  }

  public function fic_csv(){
    return $this->$_fic_csv;
  }



  public function setId($id){
    $this->_id = (int) $id;
  }

  public function setLibelle(){
    $this->_libelle = $libelle;
  }

  public function setCorde(){
    $this->_corde = $corde;
  }

  public function setTmaxPourcent(){
    $this->$_tmax_pourcent = $tmax_pourcent;
  }

  public function setTmaxMm (){
    $this->$_tmax_mm = $tmax_mm;
  }

  public function setFmaxPourcent(){
    $this->$_fmax_pourcent = $fmax_pourcent;
  }

  public function setFmaxMm(){
    $this->$_fmax_mm = $fmax_mm;
  }

  public function setNbPoints(){
    $this->$_nb_pts = $nb_pts;
  }

  public function setDateCreation(){
    $this->$_date_creation = $date_creation;
  }

  public function setFicImg(){
    $this->$_fic_img = $fic_img;
  }

  public function setFicCsv(){
    $this->$_fic_csv = $fic_csv;
  }

}
 ?>
