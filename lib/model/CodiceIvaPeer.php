<?php

  // include base peer class
  require_once 'lib/model/om/BaseCodiceIvaPeer.php';
  
  // include object class
  include_once 'lib/model/CodiceIva.php';


/**
 * Skeleton subclass for performing query and update operations on the 'codice_iva' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class CodiceIvaPeer extends BaseCodiceIvaPeer {
	
	public static function doSelectRS(Criteria $criteria, $conn = null)
	{	
		if(sfConfig::get('sf_app')!='backend')
			$criteria->add(CodiceIvaPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
			
		return parent::doSelectRS($criteria);
	}
	
	public static function inserisciDefault($id_utente){
		
		$con = Propel::getConnection();
		$query = '
    SELECT * 
   	FROM '.CodiceIvaPeer::TABLE_NAME.'
    WHERE '.CodiceIvaPeer::ID_UTENTE.' IS NULL';
    
		$stmt = $con->prepare($query);
		$rs = $stmt->execute();
		
		while ($rs->next())
		{
			$codice_iva = new CodiceIva();
			$codice_iva->setIdUtente($id_utente);
			$codice_iva->setNome($rs->get('nome'));
			$codice_iva->setValore($rs->get('valore'));
			$codice_iva->setDescrizione($rs->get('descrizione'));
			$codice_iva->save();
		}
	}
	
} // CodiceIvaPeer
