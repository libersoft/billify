<?php

class Vendita extends Fattura implements FinancialDocument
{

  const PEER = 'VenditaPeer';

  /**
   * Constructs a new Vendita class, setting the class_key column to FatturaPeer::CLASSKEY_1.
   */
  public function __construct()
  {
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

} // Vendita
