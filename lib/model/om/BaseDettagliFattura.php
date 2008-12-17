<?php


abstract class BaseDettagliFattura extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $fattura_id = 0;


	
	protected $descrizione;


	
	protected $qty = '0';


	
	protected $sconto = '0';


	
	protected $iva = 0;


	
	protected $prezzo = '0';

	
	protected $aFattura;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getFatturaId()
	{

		return $this->fattura_id;
	}

	
	public function getDescrizione()
	{

		return $this->descrizione;
	}

	
	public function getQty()
	{

		return $this->qty;
	}

	
	public function getSconto()
	{

		return $this->sconto;
	}

	
	public function getIva()
	{

		return $this->iva;
	}

	
	public function getPrezzo()
	{

		return $this->prezzo;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = DettagliFatturaPeer::ID;
		}

	} 
	
	public function setFatturaId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fattura_id !== $v || $v === 0) {
			$this->fattura_id = $v;
			$this->modifiedColumns[] = DettagliFatturaPeer::FATTURA_ID;
		}

		if ($this->aFattura !== null && $this->aFattura->getId() !== $v) {
			$this->aFattura = null;
		}

	} 
	
	public function setDescrizione($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descrizione !== $v) {
			$this->descrizione = $v;
			$this->modifiedColumns[] = DettagliFatturaPeer::DESCRIZIONE;
		}

	} 
	
	public function setQty($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->qty !== $v || $v === '0') {
			$this->qty = $v;
			$this->modifiedColumns[] = DettagliFatturaPeer::QTY;
		}

	} 
	
	public function setSconto($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sconto !== $v || $v === '0') {
			$this->sconto = $v;
			$this->modifiedColumns[] = DettagliFatturaPeer::SCONTO;
		}

	} 
	
	public function setIva($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->iva !== $v || $v === 0) {
			$this->iva = $v;
			$this->modifiedColumns[] = DettagliFatturaPeer::IVA;
		}

	} 
	
	public function setPrezzo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->prezzo !== $v || $v === '0') {
			$this->prezzo = $v;
			$this->modifiedColumns[] = DettagliFatturaPeer::PREZZO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->fattura_id = $rs->getInt($startcol + 1);

			$this->descrizione = $rs->getString($startcol + 2);

			$this->qty = $rs->getString($startcol + 3);

			$this->sconto = $rs->getString($startcol + 4);

			$this->iva = $rs->getInt($startcol + 5);

			$this->prezzo = $rs->getString($startcol + 6);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 7; 
		} catch (Exception $e) {
			throw new PropelException("Error populating DettagliFattura object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DettagliFatturaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DettagliFatturaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(DettagliFatturaPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DettagliFatturaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DettagliFatturaPeer::doUpdate($this, $con);
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


			if (($retval = DettagliFatturaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DettagliFatturaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getFatturaId();
				break;
			case 2:
				return $this->getDescrizione();
				break;
			case 3:
				return $this->getQty();
				break;
			case 4:
				return $this->getSconto();
				break;
			case 5:
				return $this->getIva();
				break;
			case 6:
				return $this->getPrezzo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DettagliFatturaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getFatturaId(),
			$keys[2] => $this->getDescrizione(),
			$keys[3] => $this->getQty(),
			$keys[4] => $this->getSconto(),
			$keys[5] => $this->getIva(),
			$keys[6] => $this->getPrezzo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DettagliFatturaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setFatturaId($value);
				break;
			case 2:
				$this->setDescrizione($value);
				break;
			case 3:
				$this->setQty($value);
				break;
			case 4:
				$this->setSconto($value);
				break;
			case 5:
				$this->setIva($value);
				break;
			case 6:
				$this->setPrezzo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DettagliFatturaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFatturaId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDescrizione($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setQty($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSconto($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIva($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPrezzo($arr[$keys[6]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DettagliFatturaPeer::DATABASE_NAME);

		if ($this->isColumnModified(DettagliFatturaPeer::ID)) $criteria->add(DettagliFatturaPeer::ID, $this->id);
		if ($this->isColumnModified(DettagliFatturaPeer::FATTURA_ID)) $criteria->add(DettagliFatturaPeer::FATTURA_ID, $this->fattura_id);
		if ($this->isColumnModified(DettagliFatturaPeer::DESCRIZIONE)) $criteria->add(DettagliFatturaPeer::DESCRIZIONE, $this->descrizione);
		if ($this->isColumnModified(DettagliFatturaPeer::QTY)) $criteria->add(DettagliFatturaPeer::QTY, $this->qty);
		if ($this->isColumnModified(DettagliFatturaPeer::SCONTO)) $criteria->add(DettagliFatturaPeer::SCONTO, $this->sconto);
		if ($this->isColumnModified(DettagliFatturaPeer::IVA)) $criteria->add(DettagliFatturaPeer::IVA, $this->iva);
		if ($this->isColumnModified(DettagliFatturaPeer::PREZZO)) $criteria->add(DettagliFatturaPeer::PREZZO, $this->prezzo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DettagliFatturaPeer::DATABASE_NAME);

		$criteria->add(DettagliFatturaPeer::ID, $this->id);

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

		$copyObj->setFatturaId($this->fattura_id);

		$copyObj->setDescrizione($this->descrizione);

		$copyObj->setQty($this->qty);

		$copyObj->setSconto($this->sconto);

		$copyObj->setIva($this->iva);

		$copyObj->setPrezzo($this->prezzo);


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
			self::$peer = new DettagliFatturaPeer();
		}
		return self::$peer;
	}

	
	public function setFattura($v)
	{


		if ($v === null) {
			$this->setFatturaId('0');
		} else {
			$this->setFatturaId($v->getId());
		}


		$this->aFattura = $v;
	}


	
	public function getFattura($con = null)
	{
		if ($this->aFattura === null && ($this->fattura_id !== null)) {
						$this->aFattura = FatturaPeer::retrieveByPK($this->fattura_id, $con);

			
		}
		return $this->aFattura;
	}

} 