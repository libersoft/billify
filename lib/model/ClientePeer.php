<?php

  // include base peer class
  require_once 'lib/model/om/BaseClientePeer.php';
  
  // include object class
  include_once 'lib/model/Cliente.php';


/**
 * Skeleton subclass for performing query and update operations on the 'cliente' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class ClientePeer extends BaseClientePeer {

	public static function doSelectRS(Criteria $criteria, $conn = null)
	{	
		if(sfConfig::get('sf_app')!='backend')
			$criteria->add(ClientePeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
			
		return parent::doSelectRS($criteria);
	}
	
} // ClientePeer