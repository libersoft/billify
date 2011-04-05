<?php

class Vendita extends Fattura
{
  
  const PEER = 'VenditaPeer';

  private $pattern;

  public function __construct()
  {
    parent::__construct();
    $this->setClassKey(FatturaPeer::CLASSKEY_1);
  }

  public function save(PropelPDO $con = null)
  {
    $this->setDataScadenza($this->getDataPagamento());
    return parent::save($con);
  }
  
  public function getRoutingRule()
  {
      return 'fattura/show';
  }

  public function addToCashFlow(CashFlow $cf)
  {
    $this->calcolaFattura();
    if (!$this->getDataScadenza())
    {
      $this->save();
    }

    $cash_flow_vendita = new CashFlowSalesAdapter($this);
    $cf->addIncoming($cash_flow_vendita);
  }

  public function getPlainNumFattura()
  {
    return $this->num_fattura;
  }

  public function  getNumFattura()
  {
    if ($this->id_utente)
    {
      return $this->getUtente()->getImpostazione()->getInvoiceDecorator($this)->getNumFattura();
    }

    return $this->num_fattura;
  }
}
