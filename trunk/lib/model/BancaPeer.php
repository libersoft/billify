<?php

  // include base peer class
  require_once 'lib/model/om/BaseBancaPeer.php';
  
  // include object class
  include_once 'lib/model/Banca.php';


/**
 * Skeleton subclass for performing query and update operations on the 'banca' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class BancaPeer extends BaseBancaPeer {

	public static function doSelectRS(Criteria $criteria, $conn = null)
	{	
		$criteria->add(BancaPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
		return parent::doSelectRS($criteria);
	}
	
	public static function createDefault($id_utente){
		$banca = new Banca();
		$banca->setNomeBanca('Banca Default');
		$banca->setIdUtente($id_utente);
		$banca->setAbi('0000');
		$banca->setCab('0000');
		$banca->setCin('0000');
		$banca->setNumeroConto('0000');
		$banca->save();
	}
} // BancaPeer
