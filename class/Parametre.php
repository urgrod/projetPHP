<?php
/**
* Classe comprenant seulement les getters, les setters ainsi qu'une methode d'hydratation
* Chaque attribut correspond a un champ dans la table "parametre" dans la base de donnees
*/

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
  private $_fic_csv;

  public function __construct(array $data){
    $this->hydrate($data);
  }


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
    return $this->_tmax_pourcent;
  }

  public function tmax_mm(){
    return $this->_tmax_mm;
  }

  public function fmax_pourcent(){
    return $this->_fmax_pourcent;
  }

  public function fmax_mm(){
    return $this->_fmax_mm;
  }

  public function nb_points(){
    return $this->_nb_points;
  }

  public function date_creation(){
    return $this->_date_creation;
  }

  public function fic_img(){
    return $this->_fic_img;
  }

  public function fic_csv(){
    return $this->_fic_csv;
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

  public function setTmax_pourcent($tmax_pourcent){
    $this->_tmax_pourcent = $tmax_pourcent;
  }

  public function setTmax_mm ($tmax_mm){
    $this->_tmax_mm = $tmax_mm;
  }

  public function setFmax_pourcent($fmax_pourcent){
    $this->_fmax_pourcent = $fmax_pourcent;
  }

  public function setFmax_mm($fmax_mm){
    $this->_fmax_mm = $fmax_mm;
  }

  public function setNb_points($nb_points){
    $this->_nb_points = $nb_points;
  }

  public function setDate_creation($date_creation){
    $this->_date_creation = $date_creation;
  }

  public function setFic_img($fic_img){
    $this->_fic_img = $fic_img;
  }

  public function setFic_csv($fic_csv){
    $this->_fic_csv = $fic_csv;
  }

  public function setIdParametre($id_parametre){
    $this->_id_parametre = $id_parametre;
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
