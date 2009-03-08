<?php
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
class ClientePeer extends ContattoPeer {

  public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return ContattoPeer::populateObjects(ClientePeer::doSelectRS($criteria, $con));
	}
  
	public static function doSelectRS(Criteria $criteria, PropelPDO $conn = null)
	{	
		$criteria->add(ClientePeer::CLASS_KEY, ContattoPeer::CLASSKEY_CLIENTE);
		return parent::doSelectRS($criteria);
	}
	
} // ClientePeer