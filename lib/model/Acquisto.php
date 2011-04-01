<?php

class Acquisto extends Fattura implements FinancialDocument
{

  const PEER = 'AcquistoPeer';

  protected $color_stato = array(self::NON_PAGATA => 'red',
                                 self::PAGATA     => 'green',
                                 self::RIFIUTATA  => 'white',
                                 self::INVIATA    => 'white');

  /**
   * Constructs a new Acquisto class, setting the class_key column to FatturaPeer::CLASSKEY_2.
   */
  public function __construct()
  {
    $this->stato_string[self::NON_PAGATA] = 'non pagata';
    $this->setClassKey(FatturaPeer::CLASSKEY_2);
  }

  public function getTotale()
  {
    return $this->imponibile + $this->imposte;
  }

  public function checkInRitardo()
  {
    return strtotime($this->getDataPagamento()) < time() && $this->getStato() == self::NON_PAGATA;
  }

  public function save(PropelPDO $con = null)
  {
    $this->setDataScadenza($this->getDataPagamento());
    return parent::save($con);
  }

  public function getRoutingRule()
  {
    return 'invoice/edit';
  }

  public function  addToCashFlow(CashFlow $cf)
  {
    $cash_flow_acquisto = new CashFlowPurchaseAdapter($this);
    $cf->addOutcoming($cash_flow_acquisto);;
  }

}
