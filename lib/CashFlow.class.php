<?php

Class CashFlow {
  protected $incoming = array();
  protected $outcoming = array();
  protected $with_imposte = false;
  
  private function sum($rows) {
    $balance = 0;
    
    foreach ($rows as $row) {
      $balance += $row->getImponibile() + ($this->with_imposte ? $row->getImposte() : 0);  
    }
    
    return $balance;
  }
  
  private function getMethodName($row) {
    return ($row instanceof CashIncome ? 'addIncoming' : 'addOutcoming');
  }
  
  public function withImposte() {
      $this->with_imposte = true;
  }
  
  public function withoutImposte() {
      $this->with_imposte = false;
  }
  
  public function addOutcoming(CashOutcome $row) {
      $this->outcoming[] = $row;
  }
  
  public function addIncoming(CashIncome $row) {
      $this->incoming[] = $row;
  }
  
  public function addRow($row) {
    $method = $this->getMethodName($row);
    $this->$method($row);
  }
  
  public function getBalance() {
    return $this->getIncoming() - $this->getOutcoming();
  }
  
  public function getIncoming() {
    return $this->sum($this->incoming);
  }
  
  public function getOutcoming() {
    return $this->sum($this->outcoming);
  }
}