<?php

Class FatturaFactoryForm{

  public function __construct() {
    
  }

  public function build($class_key, $model = null) {
    if($class_key == FatturaPeer::CLASSKEY_VENDITA) {
      return new VenditaForm($model);
    }

    return new AcquistoForm($model);
  }
}

?>
