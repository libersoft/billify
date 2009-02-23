<?php

Class CashFlowAcquistoAdapter implements ICashFlowAdapter {
  
  protected $document;
  
  public function __construct($document) {
    $this->document = $document;  
  }
  
  public function getDate() {
    return $this->document->getData();
  }
  
  public function getDescription() {
    return $this->document->__toString();
  }
  
  public function getImponibile() {
    return $this->document->getImponibile();
  }
  
  public function getImposte() {
    return $this->document->getImposte();
  }
  
  public function getTotale() {
    return $this->document->getTotale();
  }
  
  public function getModelId() {
    return $this->document->getId();
  }
  
  public function getModelClass() {
    return get_class($this->document);
  }
}