<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TurnoverCriteria
 *
 * @author cirpo
 */
class TurnoverCriteria extends Criteria
{

  public function __construct($dbName = null)
  {
    parent::__construct($dbName); 
    
    $this->add(FatturaPeer::NUM_FATTURA, '0', Criteria::NOT_EQUAL);
    $this->addOr(FatturaPeer::NUM_FATTURA, null, Criteria::ISNULL);
  }
  
  
}
