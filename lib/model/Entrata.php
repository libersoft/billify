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
class Entrata extends Fattura {

	/**
	 * Constructs a new Entrata class, setting the class_key column to FatturaPeer::CLASSKEY_3.
	 */
	public function __construct()
	{

		$this->setClassKey(FatturaPeer::CLASSKEY_3);
	}

} // Entrata
