<?php


abstract class BasePaypal extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $date;


	
	protected $item_name;


	
	protected $receiver_email;


	
	protected $item_number;


	
	protected $quantity;


	
	protected $id_utente;


	
	protected $payment_status;


	
	protected $pending_reason;


	
	protected $payment_gross;


	
	protected $payment_fee;


	
	protected $payment_type;


	
	protected $payment_date = '0';


	
	protected $txn_id;


	
	protected $payer_email;


	
	protected $payer_status = 'unverified';


	
	protected $txn_type = 'subscr_payment';


	
	protected $first_name;


	
	protected $last_name;


	
	protected $address_city;


	
	protected $address_street;


	
	protected $address_state;


	
	protected $address_zip;


	
	protected $address_country;


	
	protected $address_status = 'unconfirmed';


	
	protected $subscr_date;


	
	protected $period1 = 'UNK';


	
	protected $period2 = 'UNK';


	
	protected $period3 = 'UNK';


	
	protected $amount1 = 0;


	
	protected $amount2 = 0;


	
	protected $amount3 = 0;


	
	protected $recurring = 1;


	
	protected $reattempt = 0;


	
	protected $retry_at;


	
	protected $recur_times = 0;


	
	protected $subscr_id;


	
	protected $entirepost;


	
	protected $paypal_verified = 'INVALID';


	
	protected $verify_sign;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getDate($format = 'Y-m-d H:i:s')
	{

		if ($this->date === null || $this->date === '') {
			return null;
		} elseif (!is_int($this->date)) {
						$ts = strtotime($this->date);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [date] as date/time value: " . var_export($this->date, true));
			}
		} else {
			$ts = $this->date;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getItemName()
	{

		return $this->item_name;
	}

	
	public function getReceiverEmail()
	{

		return $this->receiver_email;
	}

	
	public function getItemNumber()
	{

		return $this->item_number;
	}

	
	public function getQuantity()
	{

		return $this->quantity;
	}

	
	public function getIdUtente()
	{

		return $this->id_utente;
	}

	
	public function getPaymentStatus()
	{

		return $this->payment_status;
	}

	
	public function getPendingReason()
	{

		return $this->pending_reason;
	}

	
	public function getPaymentGross()
	{

		return $this->payment_gross;
	}

	
	public function getPaymentFee()
	{

		return $this->payment_fee;
	}

	
	public function getPaymentType()
	{

		return $this->payment_type;
	}

	
	public function getPaymentDate()
	{

		return $this->payment_date;
	}

	
	public function getTxnId()
	{

		return $this->txn_id;
	}

	
	public function getPayerEmail()
	{

		return $this->payer_email;
	}

	
	public function getPayerStatus()
	{

		return $this->payer_status;
	}

	
	public function getTxnType()
	{

		return $this->txn_type;
	}

	
	public function getFirstName()
	{

		return $this->first_name;
	}

	
	public function getLastName()
	{

		return $this->last_name;
	}

	
	public function getAddressCity()
	{

		return $this->address_city;
	}

	
	public function getAddressStreet()
	{

		return $this->address_street;
	}

	
	public function getAddressState()
	{

		return $this->address_state;
	}

	
	public function getAddressZip()
	{

		return $this->address_zip;
	}

	
	public function getAddressCountry()
	{

		return $this->address_country;
	}

	
	public function getAddressStatus()
	{

		return $this->address_status;
	}

	
	public function getSubscrDate()
	{

		return $this->subscr_date;
	}

	
	public function getPeriod1()
	{

		return $this->period1;
	}

	
	public function getPeriod2()
	{

		return $this->period2;
	}

	
	public function getPeriod3()
	{

		return $this->period3;
	}

	
	public function getAmount1()
	{

		return $this->amount1;
	}

	
	public function getAmount2()
	{

		return $this->amount2;
	}

	
	public function getAmount3()
	{

		return $this->amount3;
	}

	
	public function getRecurring()
	{

		return $this->recurring;
	}

	
	public function getReattempt()
	{

		return $this->reattempt;
	}

	
	public function getRetryAt()
	{

		return $this->retry_at;
	}

	
	public function getRecurTimes()
	{

		return $this->recur_times;
	}

	
	public function getSubscrId()
	{

		return $this->subscr_id;
	}

	
	public function getEntirepost()
	{

		return $this->entirepost;
	}

	
	public function getPaypalVerified()
	{

		return $this->paypal_verified;
	}

	
	public function getVerifySign()
	{

		return $this->verify_sign;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = PaypalPeer::ID;
		}

	} 
	
	public function setDate($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [date] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->date !== $ts) {
			$this->date = $ts;
			$this->modifiedColumns[] = PaypalPeer::DATE;
		}

	} 
	
	public function setItemName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->item_name !== $v) {
			$this->item_name = $v;
			$this->modifiedColumns[] = PaypalPeer::ITEM_NAME;
		}

	} 
	
	public function setReceiverEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->receiver_email !== $v) {
			$this->receiver_email = $v;
			$this->modifiedColumns[] = PaypalPeer::RECEIVER_EMAIL;
		}

	} 
	
	public function setItemNumber($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->item_number !== $v) {
			$this->item_number = $v;
			$this->modifiedColumns[] = PaypalPeer::ITEM_NUMBER;
		}

	} 
	
	public function setQuantity($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->quantity !== $v) {
			$this->quantity = $v;
			$this->modifiedColumns[] = PaypalPeer::QUANTITY;
		}

	} 
	
	public function setIdUtente($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_utente !== $v) {
			$this->id_utente = $v;
			$this->modifiedColumns[] = PaypalPeer::ID_UTENTE;
		}

	} 
	
	public function setPaymentStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->payment_status !== $v) {
			$this->payment_status = $v;
			$this->modifiedColumns[] = PaypalPeer::PAYMENT_STATUS;
		}

	} 
	
	public function setPendingReason($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->pending_reason !== $v) {
			$this->pending_reason = $v;
			$this->modifiedColumns[] = PaypalPeer::PENDING_REASON;
		}

	} 
	
	public function setPaymentGross($v)
	{

		if ($this->payment_gross !== $v) {
			$this->payment_gross = $v;
			$this->modifiedColumns[] = PaypalPeer::PAYMENT_GROSS;
		}

	} 
	
	public function setPaymentFee($v)
	{

		if ($this->payment_fee !== $v) {
			$this->payment_fee = $v;
			$this->modifiedColumns[] = PaypalPeer::PAYMENT_FEE;
		}

	} 
	
	public function setPaymentType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->payment_type !== $v) {
			$this->payment_type = $v;
			$this->modifiedColumns[] = PaypalPeer::PAYMENT_TYPE;
		}

	} 
	
	public function setPaymentDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->payment_date !== $v || $v === '0') {
			$this->payment_date = $v;
			$this->modifiedColumns[] = PaypalPeer::PAYMENT_DATE;
		}

	} 
	
	public function setTxnId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->txn_id !== $v) {
			$this->txn_id = $v;
			$this->modifiedColumns[] = PaypalPeer::TXN_ID;
		}

	} 
	
	public function setPayerEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->payer_email !== $v) {
			$this->payer_email = $v;
			$this->modifiedColumns[] = PaypalPeer::PAYER_EMAIL;
		}

	} 
	
	public function setPayerStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->payer_status !== $v || $v === 'unverified') {
			$this->payer_status = $v;
			$this->modifiedColumns[] = PaypalPeer::PAYER_STATUS;
		}

	} 
	
	public function setTxnType($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->txn_type !== $v || $v === 'subscr_payment') {
			$this->txn_type = $v;
			$this->modifiedColumns[] = PaypalPeer::TXN_TYPE;
		}

	} 
	
	public function setFirstName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->first_name !== $v) {
			$this->first_name = $v;
			$this->modifiedColumns[] = PaypalPeer::FIRST_NAME;
		}

	} 
	
	public function setLastName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->last_name !== $v) {
			$this->last_name = $v;
			$this->modifiedColumns[] = PaypalPeer::LAST_NAME;
		}

	} 
	
	public function setAddressCity($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_city !== $v) {
			$this->address_city = $v;
			$this->modifiedColumns[] = PaypalPeer::ADDRESS_CITY;
		}

	} 
	
	public function setAddressStreet($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_street !== $v) {
			$this->address_street = $v;
			$this->modifiedColumns[] = PaypalPeer::ADDRESS_STREET;
		}

	} 
	
	public function setAddressState($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_state !== $v) {
			$this->address_state = $v;
			$this->modifiedColumns[] = PaypalPeer::ADDRESS_STATE;
		}

	} 
	
	public function setAddressZip($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_zip !== $v) {
			$this->address_zip = $v;
			$this->modifiedColumns[] = PaypalPeer::ADDRESS_ZIP;
		}

	} 
	
	public function setAddressCountry($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_country !== $v) {
			$this->address_country = $v;
			$this->modifiedColumns[] = PaypalPeer::ADDRESS_COUNTRY;
		}

	} 
	
	public function setAddressStatus($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->address_status !== $v || $v === 'unconfirmed') {
			$this->address_status = $v;
			$this->modifiedColumns[] = PaypalPeer::ADDRESS_STATUS;
		}

	} 
	
	public function setSubscrDate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->subscr_date !== $v) {
			$this->subscr_date = $v;
			$this->modifiedColumns[] = PaypalPeer::SUBSCR_DATE;
		}

	} 
	
	public function setPeriod1($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->period1 !== $v || $v === 'UNK') {
			$this->period1 = $v;
			$this->modifiedColumns[] = PaypalPeer::PERIOD1;
		}

	} 
	
	public function setPeriod2($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->period2 !== $v || $v === 'UNK') {
			$this->period2 = $v;
			$this->modifiedColumns[] = PaypalPeer::PERIOD2;
		}

	} 
	
	public function setPeriod3($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->period3 !== $v || $v === 'UNK') {
			$this->period3 = $v;
			$this->modifiedColumns[] = PaypalPeer::PERIOD3;
		}

	} 
	
	public function setAmount1($v)
	{

		if ($this->amount1 !== $v || $v === 0) {
			$this->amount1 = $v;
			$this->modifiedColumns[] = PaypalPeer::AMOUNT1;
		}

	} 
	
	public function setAmount2($v)
	{

		if ($this->amount2 !== $v || $v === 0) {
			$this->amount2 = $v;
			$this->modifiedColumns[] = PaypalPeer::AMOUNT2;
		}

	} 
	
	public function setAmount3($v)
	{

		if ($this->amount3 !== $v || $v === 0) {
			$this->amount3 = $v;
			$this->modifiedColumns[] = PaypalPeer::AMOUNT3;
		}

	} 
	
	public function setRecurring($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->recurring !== $v || $v === 1) {
			$this->recurring = $v;
			$this->modifiedColumns[] = PaypalPeer::RECURRING;
		}

	} 
	
	public function setReattempt($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->reattempt !== $v || $v === 0) {
			$this->reattempt = $v;
			$this->modifiedColumns[] = PaypalPeer::REATTEMPT;
		}

	} 
	
	public function setRetryAt($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->retry_at !== $v) {
			$this->retry_at = $v;
			$this->modifiedColumns[] = PaypalPeer::RETRY_AT;
		}

	} 
	
	public function setRecurTimes($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->recur_times !== $v || $v === 0) {
			$this->recur_times = $v;
			$this->modifiedColumns[] = PaypalPeer::RECUR_TIMES;
		}

	} 
	
	public function setSubscrId($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->subscr_id !== $v) {
			$this->subscr_id = $v;
			$this->modifiedColumns[] = PaypalPeer::SUBSCR_ID;
		}

	} 
	
	public function setEntirepost($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->entirepost !== $v) {
			$this->entirepost = $v;
			$this->modifiedColumns[] = PaypalPeer::ENTIREPOST;
		}

	} 
	
	public function setPaypalVerified($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->paypal_verified !== $v || $v === 'INVALID') {
			$this->paypal_verified = $v;
			$this->modifiedColumns[] = PaypalPeer::PAYPAL_VERIFIED;
		}

	} 
	
	public function setVerifySign($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->verify_sign !== $v) {
			$this->verify_sign = $v;
			$this->modifiedColumns[] = PaypalPeer::VERIFY_SIGN;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getString($startcol + 0);

			$this->date = $rs->getTimestamp($startcol + 1, null);

			$this->item_name = $rs->getString($startcol + 2);

			$this->receiver_email = $rs->getString($startcol + 3);

			$this->item_number = $rs->getString($startcol + 4);

			$this->quantity = $rs->getInt($startcol + 5);

			$this->id_utente = $rs->getInt($startcol + 6);

			$this->payment_status = $rs->getString($startcol + 7);

			$this->pending_reason = $rs->getString($startcol + 8);

			$this->payment_gross = $rs->getFloat($startcol + 9);

			$this->payment_fee = $rs->getFloat($startcol + 10);

			$this->payment_type = $rs->getString($startcol + 11);

			$this->payment_date = $rs->getString($startcol + 12);

			$this->txn_id = $rs->getString($startcol + 13);

			$this->payer_email = $rs->getString($startcol + 14);

			$this->payer_status = $rs->getString($startcol + 15);

			$this->txn_type = $rs->getString($startcol + 16);

			$this->first_name = $rs->getString($startcol + 17);

			$this->last_name = $rs->getString($startcol + 18);

			$this->address_city = $rs->getString($startcol + 19);

			$this->address_street = $rs->getString($startcol + 20);

			$this->address_state = $rs->getString($startcol + 21);

			$this->address_zip = $rs->getString($startcol + 22);

			$this->address_country = $rs->getString($startcol + 23);

			$this->address_status = $rs->getString($startcol + 24);

			$this->subscr_date = $rs->getString($startcol + 25);

			$this->period1 = $rs->getString($startcol + 26);

			$this->period2 = $rs->getString($startcol + 27);

			$this->period3 = $rs->getString($startcol + 28);

			$this->amount1 = $rs->getFloat($startcol + 29);

			$this->amount2 = $rs->getFloat($startcol + 30);

			$this->amount3 = $rs->getFloat($startcol + 31);

			$this->recurring = $rs->getInt($startcol + 32);

			$this->reattempt = $rs->getInt($startcol + 33);

			$this->retry_at = $rs->getString($startcol + 34);

			$this->recur_times = $rs->getInt($startcol + 35);

			$this->subscr_id = $rs->getString($startcol + 36);

			$this->entirepost = $rs->getString($startcol + 37);

			$this->paypal_verified = $rs->getString($startcol + 38);

			$this->verify_sign = $rs->getString($startcol + 39);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 40; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Paypal object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PaypalPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PaypalPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PaypalPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = PaypalPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PaypalPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = PaypalPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PaypalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getDate();
				break;
			case 2:
				return $this->getItemName();
				break;
			case 3:
				return $this->getReceiverEmail();
				break;
			case 4:
				return $this->getItemNumber();
				break;
			case 5:
				return $this->getQuantity();
				break;
			case 6:
				return $this->getIdUtente();
				break;
			case 7:
				return $this->getPaymentStatus();
				break;
			case 8:
				return $this->getPendingReason();
				break;
			case 9:
				return $this->getPaymentGross();
				break;
			case 10:
				return $this->getPaymentFee();
				break;
			case 11:
				return $this->getPaymentType();
				break;
			case 12:
				return $this->getPaymentDate();
				break;
			case 13:
				return $this->getTxnId();
				break;
			case 14:
				return $this->getPayerEmail();
				break;
			case 15:
				return $this->getPayerStatus();
				break;
			case 16:
				return $this->getTxnType();
				break;
			case 17:
				return $this->getFirstName();
				break;
			case 18:
				return $this->getLastName();
				break;
			case 19:
				return $this->getAddressCity();
				break;
			case 20:
				return $this->getAddressStreet();
				break;
			case 21:
				return $this->getAddressState();
				break;
			case 22:
				return $this->getAddressZip();
				break;
			case 23:
				return $this->getAddressCountry();
				break;
			case 24:
				return $this->getAddressStatus();
				break;
			case 25:
				return $this->getSubscrDate();
				break;
			case 26:
				return $this->getPeriod1();
				break;
			case 27:
				return $this->getPeriod2();
				break;
			case 28:
				return $this->getPeriod3();
				break;
			case 29:
				return $this->getAmount1();
				break;
			case 30:
				return $this->getAmount2();
				break;
			case 31:
				return $this->getAmount3();
				break;
			case 32:
				return $this->getRecurring();
				break;
			case 33:
				return $this->getReattempt();
				break;
			case 34:
				return $this->getRetryAt();
				break;
			case 35:
				return $this->getRecurTimes();
				break;
			case 36:
				return $this->getSubscrId();
				break;
			case 37:
				return $this->getEntirepost();
				break;
			case 38:
				return $this->getPaypalVerified();
				break;
			case 39:
				return $this->getVerifySign();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PaypalPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getDate(),
			$keys[2] => $this->getItemName(),
			$keys[3] => $this->getReceiverEmail(),
			$keys[4] => $this->getItemNumber(),
			$keys[5] => $this->getQuantity(),
			$keys[6] => $this->getIdUtente(),
			$keys[7] => $this->getPaymentStatus(),
			$keys[8] => $this->getPendingReason(),
			$keys[9] => $this->getPaymentGross(),
			$keys[10] => $this->getPaymentFee(),
			$keys[11] => $this->getPaymentType(),
			$keys[12] => $this->getPaymentDate(),
			$keys[13] => $this->getTxnId(),
			$keys[14] => $this->getPayerEmail(),
			$keys[15] => $this->getPayerStatus(),
			$keys[16] => $this->getTxnType(),
			$keys[17] => $this->getFirstName(),
			$keys[18] => $this->getLastName(),
			$keys[19] => $this->getAddressCity(),
			$keys[20] => $this->getAddressStreet(),
			$keys[21] => $this->getAddressState(),
			$keys[22] => $this->getAddressZip(),
			$keys[23] => $this->getAddressCountry(),
			$keys[24] => $this->getAddressStatus(),
			$keys[25] => $this->getSubscrDate(),
			$keys[26] => $this->getPeriod1(),
			$keys[27] => $this->getPeriod2(),
			$keys[28] => $this->getPeriod3(),
			$keys[29] => $this->getAmount1(),
			$keys[30] => $this->getAmount2(),
			$keys[31] => $this->getAmount3(),
			$keys[32] => $this->getRecurring(),
			$keys[33] => $this->getReattempt(),
			$keys[34] => $this->getRetryAt(),
			$keys[35] => $this->getRecurTimes(),
			$keys[36] => $this->getSubscrId(),
			$keys[37] => $this->getEntirepost(),
			$keys[38] => $this->getPaypalVerified(),
			$keys[39] => $this->getVerifySign(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PaypalPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setDate($value);
				break;
			case 2:
				$this->setItemName($value);
				break;
			case 3:
				$this->setReceiverEmail($value);
				break;
			case 4:
				$this->setItemNumber($value);
				break;
			case 5:
				$this->setQuantity($value);
				break;
			case 6:
				$this->setIdUtente($value);
				break;
			case 7:
				$this->setPaymentStatus($value);
				break;
			case 8:
				$this->setPendingReason($value);
				break;
			case 9:
				$this->setPaymentGross($value);
				break;
			case 10:
				$this->setPaymentFee($value);
				break;
			case 11:
				$this->setPaymentType($value);
				break;
			case 12:
				$this->setPaymentDate($value);
				break;
			case 13:
				$this->setTxnId($value);
				break;
			case 14:
				$this->setPayerEmail($value);
				break;
			case 15:
				$this->setPayerStatus($value);
				break;
			case 16:
				$this->setTxnType($value);
				break;
			case 17:
				$this->setFirstName($value);
				break;
			case 18:
				$this->setLastName($value);
				break;
			case 19:
				$this->setAddressCity($value);
				break;
			case 20:
				$this->setAddressStreet($value);
				break;
			case 21:
				$this->setAddressState($value);
				break;
			case 22:
				$this->setAddressZip($value);
				break;
			case 23:
				$this->setAddressCountry($value);
				break;
			case 24:
				$this->setAddressStatus($value);
				break;
			case 25:
				$this->setSubscrDate($value);
				break;
			case 26:
				$this->setPeriod1($value);
				break;
			case 27:
				$this->setPeriod2($value);
				break;
			case 28:
				$this->setPeriod3($value);
				break;
			case 29:
				$this->setAmount1($value);
				break;
			case 30:
				$this->setAmount2($value);
				break;
			case 31:
				$this->setAmount3($value);
				break;
			case 32:
				$this->setRecurring($value);
				break;
			case 33:
				$this->setReattempt($value);
				break;
			case 34:
				$this->setRetryAt($value);
				break;
			case 35:
				$this->setRecurTimes($value);
				break;
			case 36:
				$this->setSubscrId($value);
				break;
			case 37:
				$this->setEntirepost($value);
				break;
			case 38:
				$this->setPaypalVerified($value);
				break;
			case 39:
				$this->setVerifySign($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PaypalPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDate($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setItemName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setReceiverEmail($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setItemNumber($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setQuantity($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIdUtente($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPaymentStatus($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPendingReason($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setPaymentGross($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setPaymentFee($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setPaymentType($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setPaymentDate($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setTxnId($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setPayerEmail($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setPayerStatus($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setTxnType($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setFirstName($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setLastName($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setAddressCity($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setAddressStreet($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setAddressState($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setAddressZip($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setAddressCountry($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setAddressStatus($arr[$keys[24]]);
		if (array_key_exists($keys[25], $arr)) $this->setSubscrDate($arr[$keys[25]]);
		if (array_key_exists($keys[26], $arr)) $this->setPeriod1($arr[$keys[26]]);
		if (array_key_exists($keys[27], $arr)) $this->setPeriod2($arr[$keys[27]]);
		if (array_key_exists($keys[28], $arr)) $this->setPeriod3($arr[$keys[28]]);
		if (array_key_exists($keys[29], $arr)) $this->setAmount1($arr[$keys[29]]);
		if (array_key_exists($keys[30], $arr)) $this->setAmount2($arr[$keys[30]]);
		if (array_key_exists($keys[31], $arr)) $this->setAmount3($arr[$keys[31]]);
		if (array_key_exists($keys[32], $arr)) $this->setRecurring($arr[$keys[32]]);
		if (array_key_exists($keys[33], $arr)) $this->setReattempt($arr[$keys[33]]);
		if (array_key_exists($keys[34], $arr)) $this->setRetryAt($arr[$keys[34]]);
		if (array_key_exists($keys[35], $arr)) $this->setRecurTimes($arr[$keys[35]]);
		if (array_key_exists($keys[36], $arr)) $this->setSubscrId($arr[$keys[36]]);
		if (array_key_exists($keys[37], $arr)) $this->setEntirepost($arr[$keys[37]]);
		if (array_key_exists($keys[38], $arr)) $this->setPaypalVerified($arr[$keys[38]]);
		if (array_key_exists($keys[39], $arr)) $this->setVerifySign($arr[$keys[39]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PaypalPeer::DATABASE_NAME);

		if ($this->isColumnModified(PaypalPeer::ID)) $criteria->add(PaypalPeer::ID, $this->id);
		if ($this->isColumnModified(PaypalPeer::DATE)) $criteria->add(PaypalPeer::DATE, $this->date);
		if ($this->isColumnModified(PaypalPeer::ITEM_NAME)) $criteria->add(PaypalPeer::ITEM_NAME, $this->item_name);
		if ($this->isColumnModified(PaypalPeer::RECEIVER_EMAIL)) $criteria->add(PaypalPeer::RECEIVER_EMAIL, $this->receiver_email);
		if ($this->isColumnModified(PaypalPeer::ITEM_NUMBER)) $criteria->add(PaypalPeer::ITEM_NUMBER, $this->item_number);
		if ($this->isColumnModified(PaypalPeer::QUANTITY)) $criteria->add(PaypalPeer::QUANTITY, $this->quantity);
		if ($this->isColumnModified(PaypalPeer::ID_UTENTE)) $criteria->add(PaypalPeer::ID_UTENTE, $this->id_utente);
		if ($this->isColumnModified(PaypalPeer::PAYMENT_STATUS)) $criteria->add(PaypalPeer::PAYMENT_STATUS, $this->payment_status);
		if ($this->isColumnModified(PaypalPeer::PENDING_REASON)) $criteria->add(PaypalPeer::PENDING_REASON, $this->pending_reason);
		if ($this->isColumnModified(PaypalPeer::PAYMENT_GROSS)) $criteria->add(PaypalPeer::PAYMENT_GROSS, $this->payment_gross);
		if ($this->isColumnModified(PaypalPeer::PAYMENT_FEE)) $criteria->add(PaypalPeer::PAYMENT_FEE, $this->payment_fee);
		if ($this->isColumnModified(PaypalPeer::PAYMENT_TYPE)) $criteria->add(PaypalPeer::PAYMENT_TYPE, $this->payment_type);
		if ($this->isColumnModified(PaypalPeer::PAYMENT_DATE)) $criteria->add(PaypalPeer::PAYMENT_DATE, $this->payment_date);
		if ($this->isColumnModified(PaypalPeer::TXN_ID)) $criteria->add(PaypalPeer::TXN_ID, $this->txn_id);
		if ($this->isColumnModified(PaypalPeer::PAYER_EMAIL)) $criteria->add(PaypalPeer::PAYER_EMAIL, $this->payer_email);
		if ($this->isColumnModified(PaypalPeer::PAYER_STATUS)) $criteria->add(PaypalPeer::PAYER_STATUS, $this->payer_status);
		if ($this->isColumnModified(PaypalPeer::TXN_TYPE)) $criteria->add(PaypalPeer::TXN_TYPE, $this->txn_type);
		if ($this->isColumnModified(PaypalPeer::FIRST_NAME)) $criteria->add(PaypalPeer::FIRST_NAME, $this->first_name);
		if ($this->isColumnModified(PaypalPeer::LAST_NAME)) $criteria->add(PaypalPeer::LAST_NAME, $this->last_name);
		if ($this->isColumnModified(PaypalPeer::ADDRESS_CITY)) $criteria->add(PaypalPeer::ADDRESS_CITY, $this->address_city);
		if ($this->isColumnModified(PaypalPeer::ADDRESS_STREET)) $criteria->add(PaypalPeer::ADDRESS_STREET, $this->address_street);
		if ($this->isColumnModified(PaypalPeer::ADDRESS_STATE)) $criteria->add(PaypalPeer::ADDRESS_STATE, $this->address_state);
		if ($this->isColumnModified(PaypalPeer::ADDRESS_ZIP)) $criteria->add(PaypalPeer::ADDRESS_ZIP, $this->address_zip);
		if ($this->isColumnModified(PaypalPeer::ADDRESS_COUNTRY)) $criteria->add(PaypalPeer::ADDRESS_COUNTRY, $this->address_country);
		if ($this->isColumnModified(PaypalPeer::ADDRESS_STATUS)) $criteria->add(PaypalPeer::ADDRESS_STATUS, $this->address_status);
		if ($this->isColumnModified(PaypalPeer::SUBSCR_DATE)) $criteria->add(PaypalPeer::SUBSCR_DATE, $this->subscr_date);
		if ($this->isColumnModified(PaypalPeer::PERIOD1)) $criteria->add(PaypalPeer::PERIOD1, $this->period1);
		if ($this->isColumnModified(PaypalPeer::PERIOD2)) $criteria->add(PaypalPeer::PERIOD2, $this->period2);
		if ($this->isColumnModified(PaypalPeer::PERIOD3)) $criteria->add(PaypalPeer::PERIOD3, $this->period3);
		if ($this->isColumnModified(PaypalPeer::AMOUNT1)) $criteria->add(PaypalPeer::AMOUNT1, $this->amount1);
		if ($this->isColumnModified(PaypalPeer::AMOUNT2)) $criteria->add(PaypalPeer::AMOUNT2, $this->amount2);
		if ($this->isColumnModified(PaypalPeer::AMOUNT3)) $criteria->add(PaypalPeer::AMOUNT3, $this->amount3);
		if ($this->isColumnModified(PaypalPeer::RECURRING)) $criteria->add(PaypalPeer::RECURRING, $this->recurring);
		if ($this->isColumnModified(PaypalPeer::REATTEMPT)) $criteria->add(PaypalPeer::REATTEMPT, $this->reattempt);
		if ($this->isColumnModified(PaypalPeer::RETRY_AT)) $criteria->add(PaypalPeer::RETRY_AT, $this->retry_at);
		if ($this->isColumnModified(PaypalPeer::RECUR_TIMES)) $criteria->add(PaypalPeer::RECUR_TIMES, $this->recur_times);
		if ($this->isColumnModified(PaypalPeer::SUBSCR_ID)) $criteria->add(PaypalPeer::SUBSCR_ID, $this->subscr_id);
		if ($this->isColumnModified(PaypalPeer::ENTIREPOST)) $criteria->add(PaypalPeer::ENTIREPOST, $this->entirepost);
		if ($this->isColumnModified(PaypalPeer::PAYPAL_VERIFIED)) $criteria->add(PaypalPeer::PAYPAL_VERIFIED, $this->paypal_verified);
		if ($this->isColumnModified(PaypalPeer::VERIFY_SIGN)) $criteria->add(PaypalPeer::VERIFY_SIGN, $this->verify_sign);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PaypalPeer::DATABASE_NAME);

		$criteria->add(PaypalPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDate($this->date);

		$copyObj->setItemName($this->item_name);

		$copyObj->setReceiverEmail($this->receiver_email);

		$copyObj->setItemNumber($this->item_number);

		$copyObj->setQuantity($this->quantity);

		$copyObj->setIdUtente($this->id_utente);

		$copyObj->setPaymentStatus($this->payment_status);

		$copyObj->setPendingReason($this->pending_reason);

		$copyObj->setPaymentGross($this->payment_gross);

		$copyObj->setPaymentFee($this->payment_fee);

		$copyObj->setPaymentType($this->payment_type);

		$copyObj->setPaymentDate($this->payment_date);

		$copyObj->setTxnId($this->txn_id);

		$copyObj->setPayerEmail($this->payer_email);

		$copyObj->setPayerStatus($this->payer_status);

		$copyObj->setTxnType($this->txn_type);

		$copyObj->setFirstName($this->first_name);

		$copyObj->setLastName($this->last_name);

		$copyObj->setAddressCity($this->address_city);

		$copyObj->setAddressStreet($this->address_street);

		$copyObj->setAddressState($this->address_state);

		$copyObj->setAddressZip($this->address_zip);

		$copyObj->setAddressCountry($this->address_country);

		$copyObj->setAddressStatus($this->address_status);

		$copyObj->setSubscrDate($this->subscr_date);

		$copyObj->setPeriod1($this->period1);

		$copyObj->setPeriod2($this->period2);

		$copyObj->setPeriod3($this->period3);

		$copyObj->setAmount1($this->amount1);

		$copyObj->setAmount2($this->amount2);

		$copyObj->setAmount3($this->amount3);

		$copyObj->setRecurring($this->recurring);

		$copyObj->setReattempt($this->reattempt);

		$copyObj->setRetryAt($this->retry_at);

		$copyObj->setRecurTimes($this->recur_times);

		$copyObj->setSubscrId($this->subscr_id);

		$copyObj->setEntirepost($this->entirepost);

		$copyObj->setPaypalVerified($this->paypal_verified);

		$copyObj->setVerifySign($this->verify_sign);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new PaypalPeer();
		}
		return self::$peer;
	}

} 