<?php


/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'cash_flow_row' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model
 */
class CashOutcome extends CashFlowRow {

	/**
	 * Constructs a new CashOutcome class, setting the class_key column to CashFlowRowPeer::CLASSKEY_1.
	 */
	public function __construct(ICashFlowAdapter $adapter = null) {
		$this->setClassKey(CashFlowRowPeer::CLASSKEY_1);
		parent::__construct($adapter);
	}

} // CashOutcome
