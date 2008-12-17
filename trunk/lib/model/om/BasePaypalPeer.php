<?php


abstract class BasePaypalPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'paypal';

	
	const CLASS_DEFAULT = 'lib.model.Paypal';

	
	const NUM_COLUMNS = 40;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'paypal.ID';

	
	const DATE = 'paypal.DATE';

	
	const ITEM_NAME = 'paypal.ITEM_NAME';

	
	const RECEIVER_EMAIL = 'paypal.RECEIVER_EMAIL';

	
	const ITEM_NUMBER = 'paypal.ITEM_NUMBER';

	
	const QUANTITY = 'paypal.QUANTITY';

	
	const ID_UTENTE = 'paypal.ID_UTENTE';

	
	const PAYMENT_STATUS = 'paypal.PAYMENT_STATUS';

	
	const PENDING_REASON = 'paypal.PENDING_REASON';

	
	const PAYMENT_GROSS = 'paypal.PAYMENT_GROSS';

	
	const PAYMENT_FEE = 'paypal.PAYMENT_FEE';

	
	const PAYMENT_TYPE = 'paypal.PAYMENT_TYPE';

	
	const PAYMENT_DATE = 'paypal.PAYMENT_DATE';

	
	const TXN_ID = 'paypal.TXN_ID';

	
	const PAYER_EMAIL = 'paypal.PAYER_EMAIL';

	
	const PAYER_STATUS = 'paypal.PAYER_STATUS';

	
	const TXN_TYPE = 'paypal.TXN_TYPE';

	
	const FIRST_NAME = 'paypal.FIRST_NAME';

	
	const LAST_NAME = 'paypal.LAST_NAME';

	
	const ADDRESS_CITY = 'paypal.ADDRESS_CITY';

	
	const ADDRESS_STREET = 'paypal.ADDRESS_STREET';

	
	const ADDRESS_STATE = 'paypal.ADDRESS_STATE';

	
	const ADDRESS_ZIP = 'paypal.ADDRESS_ZIP';

	
	const ADDRESS_COUNTRY = 'paypal.ADDRESS_COUNTRY';

	
	const ADDRESS_STATUS = 'paypal.ADDRESS_STATUS';

	
	const SUBSCR_DATE = 'paypal.SUBSCR_DATE';

	
	const PERIOD1 = 'paypal.PERIOD1';

	
	const PERIOD2 = 'paypal.PERIOD2';

	
	const PERIOD3 = 'paypal.PERIOD3';

	
	const AMOUNT1 = 'paypal.AMOUNT1';

	
	const AMOUNT2 = 'paypal.AMOUNT2';

	
	const AMOUNT3 = 'paypal.AMOUNT3';

	
	const RECURRING = 'paypal.RECURRING';

	
	const REATTEMPT = 'paypal.REATTEMPT';

	
	const RETRY_AT = 'paypal.RETRY_AT';

	
	const RECUR_TIMES = 'paypal.RECUR_TIMES';

	
	const SUBSCR_ID = 'paypal.SUBSCR_ID';

	
	const ENTIREPOST = 'paypal.ENTIREPOST';

	
	const PAYPAL_VERIFIED = 'paypal.PAYPAL_VERIFIED';

	
	const VERIFY_SIGN = 'paypal.VERIFY_SIGN';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'Date', 'ItemName', 'ReceiverEmail', 'ItemNumber', 'Quantity', 'IdUtente', 'PaymentStatus', 'PendingReason', 'PaymentGross', 'PaymentFee', 'PaymentType', 'PaymentDate', 'TxnId', 'PayerEmail', 'PayerStatus', 'TxnType', 'FirstName', 'LastName', 'AddressCity', 'AddressStreet', 'AddressState', 'AddressZip', 'AddressCountry', 'AddressStatus', 'SubscrDate', 'Period1', 'Period2', 'Period3', 'Amount1', 'Amount2', 'Amount3', 'Recurring', 'Reattempt', 'RetryAt', 'RecurTimes', 'SubscrId', 'Entirepost', 'PaypalVerified', 'VerifySign', ),
		BasePeer::TYPE_COLNAME => array (PaypalPeer::ID, PaypalPeer::DATE, PaypalPeer::ITEM_NAME, PaypalPeer::RECEIVER_EMAIL, PaypalPeer::ITEM_NUMBER, PaypalPeer::QUANTITY, PaypalPeer::ID_UTENTE, PaypalPeer::PAYMENT_STATUS, PaypalPeer::PENDING_REASON, PaypalPeer::PAYMENT_GROSS, PaypalPeer::PAYMENT_FEE, PaypalPeer::PAYMENT_TYPE, PaypalPeer::PAYMENT_DATE, PaypalPeer::TXN_ID, PaypalPeer::PAYER_EMAIL, PaypalPeer::PAYER_STATUS, PaypalPeer::TXN_TYPE, PaypalPeer::FIRST_NAME, PaypalPeer::LAST_NAME, PaypalPeer::ADDRESS_CITY, PaypalPeer::ADDRESS_STREET, PaypalPeer::ADDRESS_STATE, PaypalPeer::ADDRESS_ZIP, PaypalPeer::ADDRESS_COUNTRY, PaypalPeer::ADDRESS_STATUS, PaypalPeer::SUBSCR_DATE, PaypalPeer::PERIOD1, PaypalPeer::PERIOD2, PaypalPeer::PERIOD3, PaypalPeer::AMOUNT1, PaypalPeer::AMOUNT2, PaypalPeer::AMOUNT3, PaypalPeer::RECURRING, PaypalPeer::REATTEMPT, PaypalPeer::RETRY_AT, PaypalPeer::RECUR_TIMES, PaypalPeer::SUBSCR_ID, PaypalPeer::ENTIREPOST, PaypalPeer::PAYPAL_VERIFIED, PaypalPeer::VERIFY_SIGN, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'date', 'item_name', 'receiver_email', 'item_number', 'quantity', 'id_utente', 'payment_status', 'pending_reason', 'payment_gross', 'payment_fee', 'payment_type', 'payment_date', 'txn_id', 'payer_email', 'payer_status', 'txn_type', 'first_name', 'last_name', 'address_city', 'address_street', 'address_state', 'address_zip', 'address_country', 'address_status', 'subscr_date', 'period1', 'period2', 'period3', 'amount1', 'amount2', 'amount3', 'recurring', 'reattempt', 'retry_at', 'recur_times', 'subscr_id', 'entirepost', 'paypal_verified', 'verify_sign', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'Date' => 1, 'ItemName' => 2, 'ReceiverEmail' => 3, 'ItemNumber' => 4, 'Quantity' => 5, 'IdUtente' => 6, 'PaymentStatus' => 7, 'PendingReason' => 8, 'PaymentGross' => 9, 'PaymentFee' => 10, 'PaymentType' => 11, 'PaymentDate' => 12, 'TxnId' => 13, 'PayerEmail' => 14, 'PayerStatus' => 15, 'TxnType' => 16, 'FirstName' => 17, 'LastName' => 18, 'AddressCity' => 19, 'AddressStreet' => 20, 'AddressState' => 21, 'AddressZip' => 22, 'AddressCountry' => 23, 'AddressStatus' => 24, 'SubscrDate' => 25, 'Period1' => 26, 'Period2' => 27, 'Period3' => 28, 'Amount1' => 29, 'Amount2' => 30, 'Amount3' => 31, 'Recurring' => 32, 'Reattempt' => 33, 'RetryAt' => 34, 'RecurTimes' => 35, 'SubscrId' => 36, 'Entirepost' => 37, 'PaypalVerified' => 38, 'VerifySign' => 39, ),
		BasePeer::TYPE_COLNAME => array (PaypalPeer::ID => 0, PaypalPeer::DATE => 1, PaypalPeer::ITEM_NAME => 2, PaypalPeer::RECEIVER_EMAIL => 3, PaypalPeer::ITEM_NUMBER => 4, PaypalPeer::QUANTITY => 5, PaypalPeer::ID_UTENTE => 6, PaypalPeer::PAYMENT_STATUS => 7, PaypalPeer::PENDING_REASON => 8, PaypalPeer::PAYMENT_GROSS => 9, PaypalPeer::PAYMENT_FEE => 10, PaypalPeer::PAYMENT_TYPE => 11, PaypalPeer::PAYMENT_DATE => 12, PaypalPeer::TXN_ID => 13, PaypalPeer::PAYER_EMAIL => 14, PaypalPeer::PAYER_STATUS => 15, PaypalPeer::TXN_TYPE => 16, PaypalPeer::FIRST_NAME => 17, PaypalPeer::LAST_NAME => 18, PaypalPeer::ADDRESS_CITY => 19, PaypalPeer::ADDRESS_STREET => 20, PaypalPeer::ADDRESS_STATE => 21, PaypalPeer::ADDRESS_ZIP => 22, PaypalPeer::ADDRESS_COUNTRY => 23, PaypalPeer::ADDRESS_STATUS => 24, PaypalPeer::SUBSCR_DATE => 25, PaypalPeer::PERIOD1 => 26, PaypalPeer::PERIOD2 => 27, PaypalPeer::PERIOD3 => 28, PaypalPeer::AMOUNT1 => 29, PaypalPeer::AMOUNT2 => 30, PaypalPeer::AMOUNT3 => 31, PaypalPeer::RECURRING => 32, PaypalPeer::REATTEMPT => 33, PaypalPeer::RETRY_AT => 34, PaypalPeer::RECUR_TIMES => 35, PaypalPeer::SUBSCR_ID => 36, PaypalPeer::ENTIREPOST => 37, PaypalPeer::PAYPAL_VERIFIED => 38, PaypalPeer::VERIFY_SIGN => 39, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'date' => 1, 'item_name' => 2, 'receiver_email' => 3, 'item_number' => 4, 'quantity' => 5, 'id_utente' => 6, 'payment_status' => 7, 'pending_reason' => 8, 'payment_gross' => 9, 'payment_fee' => 10, 'payment_type' => 11, 'payment_date' => 12, 'txn_id' => 13, 'payer_email' => 14, 'payer_status' => 15, 'txn_type' => 16, 'first_name' => 17, 'last_name' => 18, 'address_city' => 19, 'address_street' => 20, 'address_state' => 21, 'address_zip' => 22, 'address_country' => 23, 'address_status' => 24, 'subscr_date' => 25, 'period1' => 26, 'period2' => 27, 'period3' => 28, 'amount1' => 29, 'amount2' => 30, 'amount3' => 31, 'recurring' => 32, 'reattempt' => 33, 'retry_at' => 34, 'recur_times' => 35, 'subscr_id' => 36, 'entirepost' => 37, 'paypal_verified' => 38, 'verify_sign' => 39, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/PaypalMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.PaypalMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = PaypalPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(PaypalPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(PaypalPeer::ID);

		$criteria->addSelectColumn(PaypalPeer::DATE);

		$criteria->addSelectColumn(PaypalPeer::ITEM_NAME);

		$criteria->addSelectColumn(PaypalPeer::RECEIVER_EMAIL);

		$criteria->addSelectColumn(PaypalPeer::ITEM_NUMBER);

		$criteria->addSelectColumn(PaypalPeer::QUANTITY);

		$criteria->addSelectColumn(PaypalPeer::ID_UTENTE);

		$criteria->addSelectColumn(PaypalPeer::PAYMENT_STATUS);

		$criteria->addSelectColumn(PaypalPeer::PENDING_REASON);

		$criteria->addSelectColumn(PaypalPeer::PAYMENT_GROSS);

		$criteria->addSelectColumn(PaypalPeer::PAYMENT_FEE);

		$criteria->addSelectColumn(PaypalPeer::PAYMENT_TYPE);

		$criteria->addSelectColumn(PaypalPeer::PAYMENT_DATE);

		$criteria->addSelectColumn(PaypalPeer::TXN_ID);

		$criteria->addSelectColumn(PaypalPeer::PAYER_EMAIL);

		$criteria->addSelectColumn(PaypalPeer::PAYER_STATUS);

		$criteria->addSelectColumn(PaypalPeer::TXN_TYPE);

		$criteria->addSelectColumn(PaypalPeer::FIRST_NAME);

		$criteria->addSelectColumn(PaypalPeer::LAST_NAME);

		$criteria->addSelectColumn(PaypalPeer::ADDRESS_CITY);

		$criteria->addSelectColumn(PaypalPeer::ADDRESS_STREET);

		$criteria->addSelectColumn(PaypalPeer::ADDRESS_STATE);

		$criteria->addSelectColumn(PaypalPeer::ADDRESS_ZIP);

		$criteria->addSelectColumn(PaypalPeer::ADDRESS_COUNTRY);

		$criteria->addSelectColumn(PaypalPeer::ADDRESS_STATUS);

		$criteria->addSelectColumn(PaypalPeer::SUBSCR_DATE);

		$criteria->addSelectColumn(PaypalPeer::PERIOD1);

		$criteria->addSelectColumn(PaypalPeer::PERIOD2);

		$criteria->addSelectColumn(PaypalPeer::PERIOD3);

		$criteria->addSelectColumn(PaypalPeer::AMOUNT1);

		$criteria->addSelectColumn(PaypalPeer::AMOUNT2);

		$criteria->addSelectColumn(PaypalPeer::AMOUNT3);

		$criteria->addSelectColumn(PaypalPeer::RECURRING);

		$criteria->addSelectColumn(PaypalPeer::REATTEMPT);

		$criteria->addSelectColumn(PaypalPeer::RETRY_AT);

		$criteria->addSelectColumn(PaypalPeer::RECUR_TIMES);

		$criteria->addSelectColumn(PaypalPeer::SUBSCR_ID);

		$criteria->addSelectColumn(PaypalPeer::ENTIREPOST);

		$criteria->addSelectColumn(PaypalPeer::PAYPAL_VERIFIED);

		$criteria->addSelectColumn(PaypalPeer::VERIFY_SIGN);

	}

	const COUNT = 'COUNT(paypal.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT paypal.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(PaypalPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(PaypalPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = PaypalPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = PaypalPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return PaypalPeer::populateObjects(PaypalPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			PaypalPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = PaypalPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return PaypalPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(PaypalPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(PaypalPeer::ID);
			$selectCriteria->add(PaypalPeer::ID, $criteria->remove(PaypalPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(PaypalPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(PaypalPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Paypal) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(PaypalPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Paypal $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(PaypalPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(PaypalPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(PaypalPeer::DATABASE_NAME, PaypalPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = PaypalPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(PaypalPeer::DATABASE_NAME);

		$criteria->add(PaypalPeer::ID, $pk);


		$v = PaypalPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(PaypalPeer::ID, $pks, Criteria::IN);
			$objs = PaypalPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasePaypalPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/PaypalMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.PaypalMapBuilder');
}
