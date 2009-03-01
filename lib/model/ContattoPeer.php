<?php

/**
 * Subclass for performing query and update operations on the 'contatto' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ContattoPeer extends BaseContattoPeer
{
  public static function doSelectRS(Criteria $criteria, $conn = null)
	{	
		if(sfConfig::get('sf_app') != 'backend') {
			$criteria->add(ContattoPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
    }
		return parent::doSelectRS($criteria);
	}
}
