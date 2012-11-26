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

  public function getTotaleFatture($year = null)
  {
    $c = new Criteria();

    if(!is_null($year))
    {
      $c->add(FatturaPeer::DATA, date('y-m-d', mktime(0, 0, 0, 1, 1, $year)), Criteria::GREATER_EQUAL);
      $c->addAnd(FatturaPeer::DATA, date('y-m-d', mktime(0, 0, 0, 12, 31, $year)), Criteria::LESS_EQUAL);
    }

    $fatture = $this->getFatturas($c);
  
    $totale = 0;
    $tasse = TassaPeer::doSelect(new Criteria());
    
    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura();
      $totale += $fattura->getImponibile();
    }

    return $totale;
  }
} // Categoria
