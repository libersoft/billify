<?php


abstract class BaseBug extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_utente = 0;


	
	protected $priorita = 'null';


	
	protected $modulo = 'null';


	
	protected $testo;


	
	protected $data = 943948800;


	
	protected $stato = 'null';

	
	protected $aUtente;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdUtente()
	{

		return $this->id_utente;
	}

	
	public function getPriorita()
	{

		return $this->priorita;
	}

	
	public function getModulo()
	{

		return $this->modulo;
	}

	
	public function getTesto()
	{

		return $this->testo;
	}

	
	public function getData($format = 'Y-m-d')
	{

		if ($this->data === null || $this->data === '') {
			return null;
		} elseif (!is_int($this->data)) {
						$ts = strtotime($this->data);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [data] as date/time value: " . var_export($this->data, true));
			}
		} else {
			$ts = $this->data;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getStato()
	{

		return $this->stato;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BugPeer::ID;
		}

	} 
	
	public function setIdUtente($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_utente !== $v || $v === 0) {
			$this->id_utente = $v;
			$this->modifiedColumns[] = BugPeer::ID_UTENTE;
		}

		if ($this->aUtente !== null && $this->aUtente->getId() !== $v) {
			$this->aUtente = null;
		}

	} 
	
	public function setPriorita($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->priorita !== $v || $v === 'null') {
			$this->priorita = $v;
			$this->modifiedColumns[] = BugPeer::PRIORITA;
		}

	} 
	
	public function setModulo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->modulo !== $v || $v === 'null') {
			$this->modulo = $v;
			$this->modifiedColumns[] = BugPeer::MODULO;
		}

	} 
	
	public function setTesto($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->testo !== $v) {
			$this->testo = $v;
			$this->modifiedColumns[] = BugPeer::TESTO;
		}

	} 
	
	public function setData($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [data] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->data !== $ts || $ts === 943948800) {
			$this->data = $ts;
			$this->modifiedColumns[] = BugPeer::DATA;
		}

	} 
	
	public function setStato($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stato !== $v || $v === 'null') {
			$this->stato = $v;
			$this->modifiedColumns[] = BugPeer::STATO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_utente = $rs->getInt($startcol + 1);

			$this->priorita = $rs->getString($startcol + 2);

			$this->modulo = $rs->getString($startcol + 3);

			$this->testo = $rs->getString($startcol + 4);

			$this->data = $rs->getDate($startcol + 5, null);

			$this->stato = $rs->getString($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Bug object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BugPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BugPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(BugPeer::DATABASE_NAME);
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


												
			if ($this->aUtente !== null) {
				if ($this->aUtente->isModified()) {
					$affectedRows += $this->aUtente->save($con);
				}
				$this->setUtente($this->aUtente);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = BugPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BugPeer::doUpdate($this, $con);
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


												
			if ($this->aUtente !== null) {
				if (!$this->aUtente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUtente->getValidationFailures());
				}
			}


			if (($retval = BugPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BugPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdUtente();
				break;
			case 2:
				return $this->getPriorita();
				break;
			case 3:
				return $this->getModulo();
				break;
			case 4:
				return $this->getTesto();
				break;
			case 5:
				return $this->getData();
				break;
			case 6:
				return $this->getStato();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BugPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdUtente(),
			$keys[2] => $this->getPriorita(),
			$keys[3] => $this->getModulo(),
			$keys[4] => $this->getTesto(),
			$keys[5] => $this->getData(),
			$keys[6] => $this->getStato(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BugPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdUtente($value);
				break;
			case 2:
				$this->setPriorita($value);
				break;
			case 3:
				$this->setModulo($value);
				break;
			case 4:
				$this->setTesto($value);
				break;
			case 5:
				$this->setData($value);
				break;
			case 6:
				$this->setStato($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BugPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdUtente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPriorita($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setModulo($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTesto($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setData($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setStato($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BugPeer::DATABASE_NAME);

		if ($this->isColumnModified(BugPeer::ID)) $criteria->add(BugPeer::ID, $this->id);
		if ($this->isColumnModified(BugPeer::ID_UTENTE)) $criteria->add(BugPeer::ID_UTENTE, $this->id_utente);
		if ($this->isColumnModified(BugPeer::PRIORITA)) $criteria->add(BugPeer::PRIORITA, $this->priorita);
		if ($this->isColumnModified(BugPeer::MODULO)) $criteria->add(BugPeer::MODULO, $this->modulo);
		if ($this->isColumnModified(BugPeer::TESTO)) $criteria->add(BugPeer::TESTO, $this->testo);
		if ($this->isColumnModified(BugPeer::DATA)) $criteria->add(BugPeer::DATA, $this->data);
		if ($this->isColumnModified(BugPeer::STATO)) $criteria->add(BugPeer::STATO, $this->stato);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BugPeer::DATABASE_NAME);

		$criteria->add(BugPeer::ID, $this->id);

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

		$copyObj->setIdUtente($this->id_utente);

		$copyObj->setPriorita($this->priorita);

		$copyObj->setModulo($this->modulo);

		$copyObj->setTesto($this->testo);

		$copyObj->setData($this->data);

		$copyObj->setStato($this->stato);


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
			self::$peer = new BugPeer();
		}
		return self::$peer;
	}

	
	public function setUtente($v)
	{


		if ($v === null) {
			$this->setIdUtente('0');
		} else {
			$this->setIdUtente($v->getId());
		}


		$this->aUtente = $v;
	}


	
	public function getUtente($con = null)
	{
				include_once 'lib/model/om/BaseUtentePeer.php';

		if ($this->aUtente === null && ($this->id_utente !== null)) {

			$this->aUtente = UtentePeer::retrieveByPK($this->id_utente, $con);

			
		}
		return $this->aUtente;
	}

} 