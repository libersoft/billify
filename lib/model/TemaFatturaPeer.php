<?php

  // include base peer class
  require_once 'lib/model/om/BaseTemaFatturaPeer.php';
  
  // include object class
  include_once 'lib/model/TemaFattura.php';


/**
 * Skeleton subclass for performing query and update operations on the 'tema_fattura' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class TemaFatturaPeer extends BaseTemaFatturaPeer {
	
	public static function doSelectRS(Criteria $criteria, $conn = null)
	{	
		$criteria->add(TemaFatturaPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
		return parent::doSelectRS($criteria);
	}
	
	public static function createDefault($id_utente){
		
		$tema_fattura = new TemaFattura();
		$tema_fattura->setNome('Default');
		$tema_fattura->setIdUtente($id_utente);
		$tema_fattura->setTemplate(file_get_contents(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'template_fattura'.DIRECTORY_SEPARATOR.'template.htm'));
	    $tema_fattura->setCss(file_get_contents(sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR.'template_fattura'.DIRECTORY_SEPARATOR.'stile.css'));
		$tema_fattura->save();
	}
	
} // TemaFatturaPeer
