<?php


abstract class BaseTagsFattura extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_fattura = 0;


	
	protected $id_utente = 0;


	
	protected $tag = 'null';


	
	protected $tag_normalizzato = 'null';


	
	protected $data;

	
	protected $aFattura;

	
	protected $aUtente;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdFattura()
	{

		return $this->id_fattura;
	}

	
	public function getIdUtente()
	{

		return $this->id_utente;
	}

	
	public function getTag()
	{

		return $this->tag;
	}

	
	public function getTagNormalizzato()
	{

		return $this->tag_normalizzato;
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

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TagsFatturaPeer::ID;
		}

	} 
	
	public function setIdFattura($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_fattura !== $v || $v === 0) {
			$this->id_fattura = $v;
			$this->modifiedColumns[] = TagsFatturaPeer::ID_FATTURA;
		}

		if ($this->aFattura !== null && $this->aFattura->getId() !== $v) {
			$this->aFattura = null;
		}

	} 
	
	public function setIdUtente($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_utente !== $v || $v === 0) {
			$this->id_utente = $v;
			$this->modifiedColumns[] = TagsFatturaPeer::ID_UTENTE;
		}

		if ($this->aUtente !== null && $this->aUtente->getId() !== $v) {
			$this->aUtente = null;
		}

	} 
	
	public function setTag($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag !== $v || $v === 'null') {
			$this->tag = $v;
			$this->modifiedColumns[] = TagsFatturaPeer::TAG;
		}

	} 
	
	public function setTagNormalizzato($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tag_normalizzato !== $v || $v === 'null') {
			$this->tag_normalizzato = $v;
			$this->modifiedColumns[] = TagsFatturaPeer::TAG_NORMALIZZATO;
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
		if ($this->data !== $ts) {
			$this->data = $ts;
			$this->modifiedColumns[] = TagsFatturaPeer::DATA;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_fattura = $rs->getInt($startcol + 1);

			$this->id_utente = $rs->getInt($startcol + 2);

			$this->tag = $rs->getString($startcol + 3);

			$this->tag_normalizzato = $rs->getString($startcol + 4);

			$this->data = $rs->getDate($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TagsFattura object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TagsFatturaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TagsFatturaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TagsFatturaPeer::DATABASE_NAME);
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


												
			if ($this->aFattura !== null) {
				if ($this->aFattura->isModified()) {
					$affectedRows += $this->aFattura->save($con);
				}
				$this->setFattura($this->aFattura);
			}

			if ($this->aUtente !== null) {
				if ($this->aUtente->isModified()) {
					$affectedRows += $this->aUtente->save($con);
				}
				$this->setUtente($this->aUtente);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = TagsFatturaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TagsFatturaPeer::doUpdate($this, $con);
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


												
			if ($this->aFattura !== null) {
				if (!$this->aFattura->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFattura->getValidationFailures());
				}
			}

			if ($this->aUtente !== null) {
				if (!$this->aUtente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUtente->getValidationFailures());
				}
			}


			if (($retval = TagsFatturaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TagsFatturaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdFattura();
				break;
			case 2:
				return $this->getIdUtente();
				break;
			case 3:
				return $this->getTag();
				break;
			case 4:
				return $this->getTagNormalizzato();
				break;
			case 5:
				return $this->getData();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TagsFatturaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdFattura(),
			$keys[2] => $this->getIdUtente(),
			$keys[3] => $this->getTag(),
			$keys[4] => $this->getTagNormalizzato(),
			$keys[5] => $this->getData(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TagsFatturaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdFattura($value);
				break;
			case 2:
				$this->setIdUtente($value);
				break;
			case 3:
				$this->setTag($value);
				break;
			case 4:
				$this->setTagNormalizzato($value);
				break;
			case 5:
				$this->setData($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TagsFatturaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdFattura($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIdUtente($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTag($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTagNormalizzato($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setData($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TagsFatturaPeer::DATABASE_NAME);

		if ($this->isColumnModified(TagsFatturaPeer::ID)) $criteria->add(TagsFatturaPeer::ID, $this->id);
		if ($this->isColumnModified(TagsFatturaPeer::ID_FATTURA)) $criteria->add(TagsFatturaPeer::ID_FATTURA, $this->id_fattura);
		if ($this->isColumnModified(TagsFatturaPeer::ID_UTENTE)) $criteria->add(TagsFatturaPeer::ID_UTENTE, $this->id_utente);
		if ($this->isColumnModified(TagsFatturaPeer::TAG)) $criteria->add(TagsFatturaPeer::TAG, $this->tag);
		if ($this->isColumnModified(TagsFatturaPeer::TAG_NORMALIZZATO)) $criteria->add(TagsFatturaPeer::TAG_NORMALIZZATO, $this->tag_normalizzato);
		if ($this->isColumnModified(TagsFatturaPeer::DATA)) $criteria->add(TagsFatturaPeer::DATA, $this->data);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TagsFatturaPeer::DATABASE_NAME);

		$criteria->add(TagsFatturaPeer::ID, $this->id);

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

		$copyObj->setIdFattura($this->id_fattura);

		$copyObj->setIdUtente($this->id_utente);

		$copyObj->setTag($this->tag);

		$copyObj->setTagNormalizzato($this->tag_normalizzato);

		$copyObj->setData($this->data);


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
			self::$peer = new TagsFatturaPeer();
		}
		return self::$peer;
	}

	
	public function setFattura($v)
	{


		if ($v === null) {
			$this->setIdFattura('0');
		} else {
			$this->setIdFattura($v->getId());
		}


		$this->aFattura = $v;
	}


	
	public function getFattura($con = null)
	{
		if ($this->aFattura === null && ($this->id_fattura !== null)) {
						$this->aFattura = FatturaPeer::retrieveByPK($this->id_fattura, $con);

			
		}
		return $this->aFattura;
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
		if ($this->aUtente === null && ($this->id_utente !== null)) {
						$this->aUtente = UtentePeer::retrieveByPK($this->id_utente, $con);

			
		}
		return $this->aUtente;
	}

} 