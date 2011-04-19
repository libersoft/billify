<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CashFlowCriteria
 *
 * @author cirpo
 */
class CashFlowCriteria extends TurnoverCriteria
{
  
  public function __construct($dbName = null) 
  {
    parent::__construct($dbName);
    $this->addAscendingOrderByColumn(FatturaPeer::DATA_SCADENZA);
  }
  
  public function addDateRangeForCashFlow($document_date = null)
  {
    if (!is_null($document_date) && $document_date['from']['day'] && $document_date['from']['month'] && $document_date['from']['year'])
    {
      $from = implode('/', array_reverse($document_date['from']));
      $to = implode('/', array_reverse($document_date['to']));
      $this->add(FatturaPeer::DATA_SCADENZA, $from, Criteria::GREATER_EQUAL);
      $this->addAnd(FatturaPeer::DATA_SCADENZA, $to, Criteria::LESS_EQUAL);
    }
  }

  public function addDateTimeRange(DateTime $from, DateTime $to)
  {
    $this->add(FatturaPeer::DATA_SCADENZA, $from->format('Y-m-d'), Criteria::GREATER_EQUAL);
    $this->addAnd(FatturaPeer::DATA_SCADENZA, $to->format('Y-m-d'), Criteria::LESS_EQUAL);
  }
}
