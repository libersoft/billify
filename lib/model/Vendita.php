<?php


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'fattura' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Vendita extends Fattura {

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



} // Vendita
