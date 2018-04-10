<?php

/**
 *
 */
class ParametreManager{

  private $_db;

  function __construct()
  {
    $this->setDb($db);
  }

  public function add(Parametre $parametre){

    $query = $this->_db->prepare('INSERT INTO parametre (id, libelle, corde, tmax_mm, tmax_pourcent, fmax_mm, fmax_pourcent, nb_points, date_creation, fic_img, fic_csv) VALUES (NULL, :libelle, :corde, :tmax_mm, :tmax_pourcent, :fmax_mm, :fmax_pourcent, :nb_points, :date_creation, :fic_img, :fic_csv);');

    $query->bindValue(":libelle", $parametre->libelle());
    $query->bindValue(":corde", $parametre->corde());
    $query->bindValue(":tmax_mm", $parametre->tmax_mm());
    $query->bindValue(":tmax_pourcent", $parametre->tmax_pourcent());
    $query->bindValue(":fmax_mm", $parametre->fmax_mm());
    $query->bindValue(":fmax_pourcent", $parametre->fmax_pourcent());
    $query->bindValue(":nb_points", $parametre->nb_points());
    $query->bindValue(":date_creation", $parametre->date_creation());
    $query->bindValue(":fic_img", $parametre->fic_img());
    $query->bindValue(":fic_csv", $parametre->fic_csv());


    $query->execute();

  }

  public function delete(Parametre $parametre){

    $this->_db->exec("DELETE FROM parametre WHERE id =".$parametre->id());
  }

  public function get($id){
    $id = (int) $id;

    $query = $this->_db->query("SELECT * FROM parametre WHERE id =".$id);
    $data = $query->fetch(PDO::FETCH_ASSOC);

    return new Parametre($data);
  }

  public function getList(){
    $parametres = [];

    $query = $this->_db->query("SELECT * FROM parametre");

    While($data = $query->fetch(PDO::FETCH_ASSOC)){

      $parametres[] = new Parametre($data);
    }

    return $parametres;

  }

  public function update(Parametre $parametre){

    $query = $this->_db->prepare("UPDATE parametre SET libelle=:libelle, corde =:corde, tmax_mm =:tmax_mm, tmax_pourcent =:tmax_pourcent, fmax_mm =:fmax_mm, fmax_pourcent =:fmax_pourcent, nb_points=:nb_points, date_creation=:date_creation WHERE id=:id");

    $query->bindValue(":libelle", $parametre->libelle()), PDO::PARAM_INT);
    $query->bindValue(":corde", $parametre->corde(), PDO::PARAM_INT);
    $query->bindValue(":tmax_mm", $parametre->tmax_mm(), PDO::PARAM_INT);
    $query->bindValue(":tmax_pourcent", $parametre->tmax_pourcent(), PDO::PARAM_INT);
    $query->bindValue(":fmax_mm", $parametre->fmax_mm(), PDO::PARAM_INT);
    $query->bindValue(":fmax_pourcent", $parametre->fmax_pourcent(), PDO::PARAM_INT);
    $query->bindValue(":nb_points", $parametre->nb_points(), PDO::PARAM_INT);
    $query->bindValue(":date_creation", $parametre->date_creation(), PDO::PARAM_INT);
    $query->bindValue(":id", $parametre->id(), PDO::PARAM_INT);

    $query->execute();



  }

  public function setDb($db){
    $this->_db = $db;
  }
}


 ?>
