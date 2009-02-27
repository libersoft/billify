<?php

Class CashFlow {
  protected $incoming = array();
  protected $outcoming = array();
  protected $rows = array();
  protected $with_imposte = false;
  
  private function sum($rows) {
    $balance = 0;
    
    foreach ($rows as $row) {
      $balance += $row->getImponibile() + ($this->with_imposte ? $row->getImposte() : 0);  
    }
    
    return $balance;
  }
  
  public function withImposte() {
      $this->with_imposte = true;
  }
  
  public function withoutImposte() {
      $this->with_imposte = false;
  }
  
  public function addOutcoming(ICashFlowAdapter $row) {
      $this->outcoming[] = $row;
      $this->rows[] = $row;
  }
  
  public function addIncoming(ICashFlowAdapter $row) {
      $this->incoming[] = $row;
      $this->rows[] = $row;
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
  
  public function getRows() {
    return $this->rows;
  }
}