<?php

/**
 *
 */
class Parameters
{


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
