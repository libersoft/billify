<?php

class Vendita extends Fattura
{
  
  const PEER = 'VenditaPeer';

  private $with_holding_tax_percentage = '0/100';

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

  public function checkWithHoldingTax()
  {
    list($percentage,) = explode('/', $this->with_holding_tax_percentage);
    
    if ($this->getCalcolaRitenutaAcconto() == 'n' || 
       ($this->getCliente() && ($this->getCliente()->getAzienda() != 's' || $this->getCliente()->getCalcolaRitenutaAcconto() == 'n')) ||
       0 === (int)$percentage)
    {
      return false;
    }
    return true;
  }

  public function getWithHoldingTaxPercentage()
  {
    return $this->with_holding_tax_percentage;
  }

  public function setWithHoldingTaxPercentage($v)
  {
    $this->with_holding_tax_percentage = $v;
  }

  public function calcolaFattura($tasse_ulteriori = array(), $tipo_ritenuta = null, $ritenuta_acconto = null)
  {
    $this->setWithHoldingTaxPercentage($ritenuta_acconto);
    parent::calcolaFattura($tasse_ulteriori, $tipo_ritenuta, $ritenuta_acconto);
  }
}
