<?php

/**
 * Subclass for representing a row from the 'cash_flow_row' table.
 *
 * 
 *
 * @package lib.model
 */ 
class CashFlowRow extends BaseCashFlowRow
{
  public function __construct(ICashFlowAdapter $adapter = null) {
    if($adapter) {
      $this->fromAdapter($adapter);
    }
  }
  
  private function fromAdapter($adapter) {
    $this->setModelClass($adapter->getModelClass());
    $this->setModelId($adapter->getModelId());
    $this->setDate($adapter->getDate());
    $this->setDescription($adapter->getDescription());
    $this->setImponibile($adapter->getImponibile());
    $this->setImposte($adapter->getImposte());
  }
}
