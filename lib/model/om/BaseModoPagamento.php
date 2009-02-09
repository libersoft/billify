<?php


abstract class BaseModoPagamento extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_utente;


	
	protected $num_giorni = 0;


	
	protected $descrizione;

	
	protected $aUtente;

	
	protected $collContattos;

	
	protected $lastContattoCriteria = null;

	
	protected $collFatturas;

	
	protected $lastFatturaCriteria = null;

	
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

	
	public function getNumGiorni()
	{

		return $this->num_giorni;
	}

	
	public function getDescrizione()
	{

		return $this->descrizione;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ModoPagamentoPeer::ID;
		}

	} 
	
	public function setIdUtente($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_utente !== $v) {
			$this->id_utente = $v;
			$this->modifiedColumns[] = ModoPagamentoPeer::ID_UTENTE;
		}

		if ($this->aUtente !== null && $this->aUtente->getId() !== $v) {
			$this->aUtente = null;
		}

	} 
	
	public function setNumGiorni($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->num_giorni !== $v || $v === 0) {
			$this->num_giorni = $v;
			$this->modifiedColumns[] = ModoPagamentoPeer::NUM_GIORNI;
		}

	} 
	
	public function setDescrizione($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->descrizione !== $v) {
			$this->descrizione = $v;
			$this->modifiedColumns[] = ModoPagamentoPeer::DESCRIZIONE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_utente = $rs->getInt($startcol + 1);

			$this->num_giorni = $rs->getInt($startcol + 2);

			$this->descrizione = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ModoPagamento object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ModoPagamentoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ModoPagamentoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ModoPagamentoPeer::DATABASE_NAME);
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
					$pk = ModoPagamentoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ModoPagamentoPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collContattos !== null) {
				foreach($this->collContattos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFatturas !== null) {
				foreach($this->collFatturas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

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


			if (($retval = ModoPagamentoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collContattos !== null) {
					foreach($this->collContattos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFatturas !== null) {
					foreach($this->collFatturas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ModoPagamentoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getNumGiorni();
				break;
			case 3:
				return $this->getDescrizione();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ModoPagamentoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdUtente(),
			$keys[2] => $this->getNumGiorni(),
			$keys[3] => $this->getDescrizione(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ModoPagamentoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setNumGiorni($value);
				break;
			case 3:
				$this->setDescrizione($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ModoPagamentoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdUtente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNumGiorni($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDescrizione($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ModoPagamentoPeer::DATABASE_NAME);

		if ($this->isColumnModified(ModoPagamentoPeer::ID)) $criteria->add(ModoPagamentoPeer::ID, $this->id);
		if ($this->isColumnModified(ModoPagamentoPeer::ID_UTENTE)) $criteria->add(ModoPagamentoPeer::ID_UTENTE, $this->id_utente);
		if ($this->isColumnModified(ModoPagamentoPeer::NUM_GIORNI)) $criteria->add(ModoPagamentoPeer::NUM_GIORNI, $this->num_giorni);
		if ($this->isColumnModified(ModoPagamentoPeer::DESCRIZIONE)) $criteria->add(ModoPagamentoPeer::DESCRIZIONE, $this->descrizione);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ModoPagamentoPeer::DATABASE_NAME);

		$criteria->add(ModoPagamentoPeer::ID, $this->id);

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

		$copyObj->setNumGiorni($this->num_giorni);

		$copyObj->setDescrizione($this->descrizione);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getContattos() as $relObj) {
				$copyObj->addContatto($relObj->copy($deepCopy));
			}

			foreach($this->getFatturas() as $relObj) {
				$copyObj->addFattura($relObj->copy($deepCopy));
			}

		} 

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
			self::$peer = new ModoPagamentoPeer();
		}
		return self::$peer;
	}

	
	public function setUtente($v)
	{


		if ($v === null) {
			$this->setIdUtente(NULL);
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

	
	public function initContattos()
	{
		if ($this->collContattos === null) {
			$this->collContattos = array();
		}
	}

	
	public function getContattos($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContattos === null) {
			if ($this->isNew()) {
			   $this->collContattos = array();
			} else {

				$criteria->add(ContattoPeer::MODO_PAGAMENTO_ID, $this->getId());

				ContattoPeer::addSelectColumns($criteria);
				$this->collContattos = ContattoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContattoPeer::MODO_PAGAMENTO_ID, $this->getId());

				ContattoPeer::addSelectColumns($criteria);
				if (!isset($this->lastContattoCriteria) || !$this->lastContattoCriteria->equals($criteria)) {
					$this->collContattos = ContattoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastContattoCriteria = $criteria;
		return $this->collContattos;
	}

	
	public function countContattos($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ContattoPeer::MODO_PAGAMENTO_ID, $this->getId());

		return ContattoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addContatto(Contatto $l)
	{
		$this->collContattos[] = $l;
		$l->setModoPagamento($this);
	}


	
	public function getContattosJoinUtente($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContattos === null) {
			if ($this->isNew()) {
				$this->collContattos = array();
			} else {

				$criteria->add(ContattoPeer::MODO_PAGAMENTO_ID, $this->getId());

				$this->collContattos = ContattoPeer::doSelectJoinUtente($criteria, $con);
			}
		} else {
									
			$criteria->add(ContattoPeer::MODO_PAGAMENTO_ID, $this->getId());

			if (!isset($this->lastContattoCriteria) || !$this->lastContattoCriteria->equals($criteria)) {
				$this->collContattos = ContattoPeer::doSelectJoinUtente($criteria, $con);
			}
		}
		$this->lastContattoCriteria = $criteria;

		return $this->collContattos;
	}


	
	public function getContattosJoinTemaFattura($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContattos === null) {
			if ($this->isNew()) {
				$this->collContattos = array();
			} else {

				$criteria->add(ContattoPeer::MODO_PAGAMENTO_ID, $this->getId());

				$this->collContattos = ContattoPeer::doSelectJoinTemaFattura($criteria, $con);
			}
		} else {
									
			$criteria->add(ContattoPeer::MODO_PAGAMENTO_ID, $this->getId());

			if (!isset($this->lastContattoCriteria) || !$this->lastContattoCriteria->equals($criteria)) {
				$this->collContattos = ContattoPeer::doSelectJoinTemaFattura($criteria, $con);
			}
		}
		$this->lastContattoCriteria = $criteria;

		return $this->collContattos;
	}


	
	public function getContattosJoinBanca($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContattos === null) {
			if ($this->isNew()) {
				$this->collContattos = array();
			} else {

				$criteria->add(ContattoPeer::MODO_PAGAMENTO_ID, $this->getId());

				$this->collContattos = ContattoPeer::doSelectJoinBanca($criteria, $con);
			}
		} else {
									
			$criteria->add(ContattoPeer::MODO_PAGAMENTO_ID, $this->getId());

			if (!isset($this->lastContattoCriteria) || !$this->lastContattoCriteria->equals($criteria)) {
				$this->collContattos = ContattoPeer::doSelectJoinBanca($criteria, $con);
			}
		}
		$this->lastContattoCriteria = $criteria;

		return $this->collContattos;
	}

	
	public function initFatturas()
	{
		if ($this->collFatturas === null) {
			$this->collFatturas = array();
		}
	}

	
	public function getFatturas($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFatturas === null) {
			if ($this->isNew()) {
			   $this->collFatturas = array();
			} else {

				$criteria->add(FatturaPeer::MODO_PAGAMENTO_ID, $this->getId());

				FatturaPeer::addSelectColumns($criteria);
				$this->collFatturas = FatturaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FatturaPeer::MODO_PAGAMENTO_ID, $this->getId());

				FatturaPeer::addSelectColumns($criteria);
				if (!isset($this->lastFatturaCriteria) || !$this->lastFatturaCriteria->equals($criteria)) {
					$this->collFatturas = FatturaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFatturaCriteria = $criteria;
		return $this->collFatturas;
	}

	
	public function countFatturas($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FatturaPeer::MODO_PAGAMENTO_ID, $this->getId());

		return FatturaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFattura(Fattura $l)
	{
		$this->collFatturas[] = $l;
		$l->setModoPagamento($this);
	}


	
	public function getFatturasJoinContatto($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFatturas === null) {
			if ($this->isNew()) {
				$this->collFatturas = array();
			} else {

				$criteria->add(FatturaPeer::MODO_PAGAMENTO_ID, $this->getId());

				$this->collFatturas = FatturaPeer::doSelectJoinContatto($criteria, $con);
			}
		} else {
									
			$criteria->add(FatturaPeer::MODO_PAGAMENTO_ID, $this->getId());

			if (!isset($this->lastFatturaCriteria) || !$this->lastFatturaCriteria->equals($criteria)) {
				$this->collFatturas = FatturaPeer::doSelectJoinContatto($criteria, $con);
			}
		}
		$this->lastFatturaCriteria = $criteria;

		return $this->collFatturas;
	}


	
	public function getFatturasJoinUtente($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFatturas === null) {
			if ($this->isNew()) {
				$this->collFatturas = array();
			} else {

				$criteria->add(FatturaPeer::MODO_PAGAMENTO_ID, $this->getId());

				$this->collFatturas = FatturaPeer::doSelectJoinUtente($criteria, $con);
			}
		} else {
									
			$criteria->add(FatturaPeer::MODO_PAGAMENTO_ID, $this->getId());

			if (!isset($this->lastFatturaCriteria) || !$this->lastFatturaCriteria->equals($criteria)) {
				$this->collFatturas = FatturaPeer::doSelectJoinUtente($criteria, $con);
			}
		}
		$this->lastFatturaCriteria = $criteria;

		return $this->collFatturas;
	}

} 