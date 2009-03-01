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
class Acquisto extends Fattura {
  
  protected $stato_string = array(self::NON_PAGATA => 'non pagata',
                                  self::PAGATA     => 'pagata',
                                  self::RIFIUTATA  => 'rifiutata',
                                  self::INVIATA    => 'inviata');
                                  
  protected $color_stato = array(self::NON_PAGATA => 'red',
                                 self::PAGATA     => 'green',
                                 self::RIFIUTATA  => 'white',
                                 self::INVIATA    => 'white');
                                 
	/**
	 * Constructs a new Acquisto class, setting the class_key column to FatturaPeer::CLASSKEY_2.
	 */
	public function __construct()
	{

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

} // Acquisto
