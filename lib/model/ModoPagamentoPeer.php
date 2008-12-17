<?php

  // include base peer class
  require_once 'lib/model/om/BaseModoPagamentoPeer.php';
  
  // include object class
  include_once 'lib/model/ModoPagamento.php';


/**
 * Skeleton subclass for performing query and update operations on the 'modo_pagamento' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class ModoPagamentoPeer extends BaseModoPagamentoPeer {
	
	public static function doSelectRS(Criteria $criteria, $conn = null)
	{	
		$criteria->addAscendingOrderByColumn(ModoPagamentoPeer::DESCRIZIONE );
		if(sfConfig::get('sf_app')!='backend')
			$criteria->add(ModoPagamentoPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
			
		return parent::doSelectRS($criteria);
	}
	
	public static function inserisciDefault($id_utente){
		
		$con = Propel::getConnection();
		$query = '
    SELECT * 
   	FROM '.ModoPagamentoPeer::TABLE_NAME.'
    WHERE '.ModoPagamentoPeer::ID_UTENTE.' IS NULL';
    
		$stmt = $con->prepareStatement($query);
		$rs = $stmt->executeQuery();
		
		while ($rs->next())
		{
			$modo_pagamento = new ModoPagamento();
			$modo_pagamento->setIdUtente($id_utente);
			$modo_pagamento->setNumGiorni($rs->get('num_giorni'));
			$modo_pagamento->setDescrizione($rs->get('descrizione'));
			$modo_pagamento->save();
		}
	}
	
} // ModoPagamentoPeer
