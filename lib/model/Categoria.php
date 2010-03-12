<?php

require 'lib/model/om/BaseCategoria.php';


/**
 * Skeleton subclass for representing a row from the 'categoria' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Categoria extends BaseCategoria
{
  public function __toString()
  {
    return $this->getNome();
  }
  
} // Categoria
