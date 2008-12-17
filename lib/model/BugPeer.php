<?php

  // include base peer class
  require_once 'lib/model/om/BaseBugPeer.php';
  
  // include object class
  include_once 'lib/model/Bug.php';


/**
 * Skeleton subclass for performing query and update operations on the 'bug' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class BugPeer extends BaseBugPeer {
	
	public static function doSelectRS(Criteria $criteria, $conn = null)
	{	
		if(sfConfig::get('sf_app')!='backend')
			$criteria->add(BugPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
			
		return parent::doSelectRS($criteria);
	}
} // BugPeer
