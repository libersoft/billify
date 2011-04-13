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
  
  
  public function addDateRange($year = null, $month = null)
  {
    if ($year)
    {
      $days_in_month = 31;
      if ($month)
      {
        $days_in_month = date('t', strtotime($month.'/1/'.$year));
      }
      $cr1 = $this->getNewCriterion(FatturaPeer::DATA, date('Y-m-d', mktime(0, 0, 0,(!is_null($month) ? $month : 1), 1, $year)), Criteria::GREATER_EQUAL);
      $cr2 = $this->getNewCriterion(FatturaPeer::DATA, date('Y-m-d', mktime(0, 0, 0,(!is_null($month) ? $month : 12), $days_in_month, $year)), Criteria::LESS_EQUAL );
      $cr1->addAnd($cr2);
      $this->add($cr1);
    }
  }
  
}
