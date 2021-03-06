<?php

Class ContactFactoryForm{

  public function __construct() {
    
  }

  public function build($class_key, $model = null) {

    if($class_key == ContattoPeer::CLASSKEY_CLIENTE || $model instanceof Cliente) {
      return new ClienteForm($model);
    }

    return new FornitoreForm($model);
  }
}

?>
