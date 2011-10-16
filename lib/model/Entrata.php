<?php

class Entrata extends Fattura
{
  protected $stato_string = array(
    self::NON_PAGATA => 'non pagata',
    self::PAGATA     => 'pagata',
    self::RIFIUTATA  => 'rifiutata',
    self::INVIATA    => 'inviata'
  );

  protected $color_stato = array(
    self::NON_PAGATA => 'warning',
    self::PAGATA     => 'success',
    self::RIFIUTATA  => 'important',
    self::INVIATA    => 'info'
  );

  public function __construct()
  {
    parent::__construct();
    $this->setClassKey(FatturaPeer::CLASSKEY_3);
  }

  public function checkInRitardo()
  {
    return strtotime($this->getDataScadenza()) < time() && $this->getStato() == self::NON_PAGATA;
  }

  public function  addToCashFlow(CashFlow $cf)
  {
    $cash_flow_entrance = new CashFlowEntranceAdapter($this);
    $cf->addIncoming($cash_flow_entrance);
  }

  public function getData($format = 'd/m/Y')
  {
    return parent::getData($format);
  }

  public function  getDataScadenza($format = 'd/m/Y')
  {
    return parent::getDataScadenza($format);
  }
}