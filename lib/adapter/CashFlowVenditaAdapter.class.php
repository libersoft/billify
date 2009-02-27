<?php

Class CashFlowVenditaAdapter implements ICashFlowAdapter {
  
  protected $document;
  
  public function __construct($document) {
    $this->document = $document;  
    try {
      $this->document->calcolaFattura(TassaPeer::doSelect(new Criteria()), UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
    } 
    catch(Exception $e) {
      $this->document->calcolaFattura();
    }
  }
  
  public function getDate() {
    return $this->document->getData();
  }
  
  public function getDescription() {
    return $this->document->__toString() .' - '.$this->document->getCliente();
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