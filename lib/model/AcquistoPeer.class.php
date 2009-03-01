<?php 


Class AcquistoPeer extends FatturaPeer {
  
  public static function doSelect(Criteria $criteria, $con = null)
	{
		return AcquistoPeer::populateObjects(AcquistoPeer::doSelectRS($criteria, $con));
	}
  
	public static function doSelectRS(Criteria $criteria, $conn = null)
	{	
		$criteria->add(AcquistoPeer::CLASS_KEY, AcquistoPeer::CLASSKEY_ACQUISTO);
		return parent::doSelectRS($criteria);
	}
}