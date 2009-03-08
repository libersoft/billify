<?php
/**
 * Skeleton subclass for performing query and update operations on the 'fattura' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */
class FatturaPeer extends BaseFatturaPeer {

	const NUM_BLOCCO_FATTURE = 10;

	public static function doSelectRS(Criteria $criteria, $conn = null)
	{
		if(sfConfig::get('sf_app')!='backend') {
			$criteria->add(FatturaPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
		}

		return parent::doSelectStmt($criteria);
	}

} // FatturaPeer
