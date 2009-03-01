<?php


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'contatto' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class Fornitore extends Contatto {

	/**
	 * Constructs a new Fornitore class, setting the class_key column to ContattoPeer::CLASSKEY_2.
	 */
	public function __construct()
	{

		$this->setClassKey(ContattoPeer::CLASSKEY_2);
	}

} // Fornitore
