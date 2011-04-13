<?php

Class FatturaFactoryForm{

  public function __construct() {
    
  }

  public function build($class_key, $model = null) {
    if(!is_null($model)) {
      $class_name = get_class($model).'Form';
      return   new $class_name($model);
    }
    
    switch ($class_key)
    {
      case FatturaPeer::CLASSKEY_VENDITA;
        return new VenditaForm($model);
      case FatturaPeer::CLASSKEY_ENTRATA:
        return new EntrataForm($model);
      case FatturaPeer::CLASSKEY_USCITA:
        return new UscitaForm($model);
      case FatturaPeer::CLASSKEY_ACQUISTO:
        return new AcquistoForm($model);
      default:
        throw new Exception('$class_key not valid');
    }
  }
}

?>
