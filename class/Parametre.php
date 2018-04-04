<?php

class Parametre{

  private $_id;
  private $_libelle;
  private $_corde;
  private $_tmax_pourcent;
  private $_tmax_mm;
  private $_fmax_pourcent;
  private $_fmax_mm;
  private $_nb_points;
  private $_date_creation;
  private $_fic_img;
  private $_fig_csv;
  private $_id_parametre;

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

  public function nb_points(){
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

  public function setLibelle($libelle){
    $this->_libelle = $libelle;
  }

  public function setCorde($corde){
    $this->_corde = $corde;
  }

  public function setTmaxPourcent($tmax_pourcent){
    $this->$_tmax_pourcent = $tmax_pourcent;
  }

  public function setTmaxMm ($tmax_mm){
    $this->$_tmax_mm = $tmax_mm;
  }

  public function setFmaxPourcent($fmax_pourcent){
    $this->$_fmax_pourcent = $fmax_pourcent;
  }

  public function setFmaxMm($fmax_mm){
    $this->$_fmax_mm = $fmax_mm;
  }

  public function setNbPoints($nb_pts){
    $this->$_nb_pts = $nb_pts;
  }

  public function setDateCreation($date_creation){
    $this->$_date_creation = $date_creation;
  }

  public function setFicImg($fic_img){
    $this->$_fic_img = $fic_img;
  }

  public function setFicCsv($fic_csv){
    $this->$_fic_csv = $fic_csv;
  }

  public function setIdParametre($id_parametre){
    $this->$_id_parametre = $id_parametre
  }


  public function hydrate(array $data){
    foreach($data as $key => $value){
      $method ='set'.ucfirst($key);

      if(method_exist($this, $method)){
        $this->$method($value);
        )
      }
    }
  }
}
?>
