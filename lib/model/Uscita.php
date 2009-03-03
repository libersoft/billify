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
class Uscita extends Fattura {

  /**
    * Constructs a new Uscita class, setting the class_key column to FatturaPeer::CLASSKEY_3.
    */
  public function __construct()
  {
    $this->setClassKey(FatturaPeer::CLASSKEY_3);
  }

  /**
   * Check if data scadenza is minus than time and stato in NON PAGATA
   *
   * @return boolean
   */
  public function checkInRitardo()
  {
    return strtotime($this->getDataScadenza()) < time() && $this->getStato() == self::NON_PAGATA;
  }
} // Uscita
