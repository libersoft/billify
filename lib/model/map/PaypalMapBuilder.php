<?php



class PaypalMapBuilder {

	
	const CLASS_NAME = 'lib.model.map.PaypalMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('paypal');
		$tMap->setPhpName('Paypal');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'string', CreoleTypes::BIGINT, true, null);

		$tMap->addColumn('DATE', 'Date', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('ITEM_NAME', 'ItemName', 'string', CreoleTypes::VARCHAR, false, 130);

		$tMap->addColumn('RECEIVER_EMAIL', 'ReceiverEmail', 'string', CreoleTypes::VARCHAR, false, 125);

		$tMap->addColumn('ITEM_NUMBER', 'ItemNumber', 'string', CreoleTypes::VARCHAR, false, 130);

		$tMap->addColumn('QUANTITY', 'Quantity', 'int', CreoleTypes::SMALLINT, false, null);

		$tMap->addColumn('ID_UTENTE', 'IdUtente', 'int', CreoleTypes::INTEGER, false, null);

		$tMap->addColumn('PAYMENT_STATUS', 'PaymentStatus', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('PENDING_REASON', 'PendingReason', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('PAYMENT_GROSS', 'PaymentGross', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PAYMENT_FEE', 'PaymentFee', 'double', CreoleTypes::FLOAT, false, null);

		$tMap->addColumn('PAYMENT_TYPE', 'PaymentType', 'string', CreoleTypes::CHAR, false, null);

		$tMap->addColumn('PAYMENT_DATE', 'PaymentDate', 'string', CreoleTypes::VARCHAR, true, 50);

		$tMap->addColumn('TXN_ID', 'TxnId', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('PAYER_EMAIL', 'PayerEmail', 'string', CreoleTypes::VARCHAR, false, 125);

		$tMap->addColumn('PAYER_STATUS', 'PayerStatus', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('TXN_TYPE', 'TxnType', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('FIRST_NAME', 'FirstName', 'string', CreoleTypes::VARCHAR, false, 35);

		$tMap->addColumn('LAST_NAME', 'LastName', 'string', CreoleTypes::VARCHAR, false, 60);

		$tMap->addColumn('ADDRESS_CITY', 'AddressCity', 'string', CreoleTypes::VARCHAR, false, 60);

		$tMap->addColumn('ADDRESS_STREET', 'AddressStreet', 'string', CreoleTypes::VARCHAR, false, 60);

		$tMap->addColumn('ADDRESS_STATE', 'AddressState', 'string', CreoleTypes::VARCHAR, false, 60);

		$tMap->addColumn('ADDRESS_ZIP', 'AddressZip', 'string', CreoleTypes::VARCHAR, false, 15);

		$tMap->addColumn('ADDRESS_COUNTRY', 'AddressCountry', 'string', CreoleTypes::VARCHAR, false, 60);

		$tMap->addColumn('ADDRESS_STATUS', 'AddressStatus', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('SUBSCR_DATE', 'SubscrDate', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('PERIOD1', 'Period1', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('PERIOD2', 'Period2', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('PERIOD3', 'Period3', 'string', CreoleTypes::VARCHAR, true, 20);

		$tMap->addColumn('AMOUNT1', 'Amount1', 'double', CreoleTypes::FLOAT, true, null);

		$tMap->addColumn('AMOUNT2', 'Amount2', 'double', CreoleTypes::FLOAT, true, null);

		$tMap->addColumn('AMOUNT3', 'Amount3', 'double', CreoleTypes::FLOAT, true, null);

		$tMap->addColumn('RECURRING', 'Recurring', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('REATTEMPT', 'Reattempt', 'int', CreoleTypes::TINYINT, true, null);

		$tMap->addColumn('RETRY_AT', 'RetryAt', 'string', CreoleTypes::VARCHAR, false, 50);

		$tMap->addColumn('RECUR_TIMES', 'RecurTimes', 'int', CreoleTypes::SMALLINT, true, null);

		$tMap->addColumn('SUBSCR_ID', 'SubscrId', 'string', CreoleTypes::VARCHAR, false, 20);

		$tMap->addColumn('ENTIREPOST', 'Entirepost', 'string', CreoleTypes::LONGVARCHAR, false, null);

		$tMap->addColumn('PAYPAL_VERIFIED', 'PaypalVerified', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('VERIFY_SIGN', 'VerifySign', 'string', CreoleTypes::VARCHAR, false, 125);

	} 
} 