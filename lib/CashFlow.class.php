<?php

Class CashFlow {
  protected $rows = array();
  
  public function addRow($row) {
    $this->rows[] = $row;
  }
  
  public function getBalance() {
    
  }
}