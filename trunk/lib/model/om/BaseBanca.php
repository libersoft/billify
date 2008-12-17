<?php


abstract class BaseBanca extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_utente = 0;


	
	protected $abi = 'null';


	
	protected $cab = 'null';


	
	protected $cin = 'null';


	
	protected $iban = 'null';


	
	protected $numero_conto = 'null';


	
	protected $nome_banca = 'null';

	
	protected $aUtente;

	
	protected $collClientes;

	
	protected $lastClienteCriteria = null;

	
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

	
	public function getAbi()
	{

		return $this->abi;
	}

	
	public function getCab()
	{

		return $this->cab;
	}

	
	public function getCin()
	{

		return $this->cin;
	}

	
	public function getIban()
	{

		return $this->iban;
	}

	
	public function getNumeroConto()
	{

		return $this->numero_conto;
	}

	
	public function getNomeBanca()
	{

		return $this->nome_banca;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BancaPeer::ID;
		}

	} 
	
	public function setIdUtente($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_utente !== $v || $v === 0) {
			$this->id_utente = $v;
			$this->modifiedColumns[] = BancaPeer::ID_UTENTE;
		}

		if ($this->aUtente !== null && $this->aUtente->getId() !== $v) {
			$this->aUtente = null;
		}

	} 
	
	public function setAbi($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->abi !== $v || $v === 'null') {
			$this->abi = $v;
			$this->modifiedColumns[] = BancaPeer::ABI;
		}

	} 
	
	public function setCab($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cab !== $v || $v === 'null') {
			$this->cab = $v;
			$this->modifiedColumns[] = BancaPeer::CAB;
		}

	} 
	
	public function setCin($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cin !== $v || $v === 'null') {
			$this->cin = $v;
			$this->modifiedColumns[] = BancaPeer::CIN;
		}

	} 
	
	public function setIban($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->iban !== $v || $v === 'null') {
			$this->iban = $v;
			$this->modifiedColumns[] = BancaPeer::IBAN;
		}

	} 
	
	public function setNumeroConto($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->numero_conto !== $v || $v === 'null') {
			$this->numero_conto = $v;
			$this->modifiedColumns[] = BancaPeer::NUMERO_CONTO;
		}

	} 
	
	public function setNomeBanca($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nome_banca !== $v || $v === 'null') {
			$this->nome_banca = $v;
			$this->modifiedColumns[] = BancaPeer::NOME_BANCA;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_utente = $rs->getInt($startcol + 1);

			$this->abi = $rs->getString($startcol + 2);

			$this->cab = $rs->getString($startcol + 3);

			$this->cin = $rs->getString($startcol + 4);

			$this->iban = $rs->getString($startcol + 5);

			$this->numero_conto = $rs->getString($startcol + 6);

			$this->nome_banca = $rs->getString($startcol + 7);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 8; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Banca object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BancaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BancaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(BancaPeer::DATABASE_NAME);
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
					$pk = BancaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BancaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collClientes !== null) {
				foreach($this->collClientes as $referrerFK) {
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


			if (($retval = BancaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collClientes !== null) {
					foreach($this->collClientes as $referrerFK) {
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
		$pos = BancaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getAbi();
				break;
			case 3:
				return $this->getCab();
				break;
			case 4:
				return $this->getCin();
				break;
			case 5:
				return $this->getIban();
				break;
			case 6:
				return $this->getNumeroConto();
				break;
			case 7:
				return $this->getNomeBanca();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BancaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdUtente(),
			$keys[2] => $this->getAbi(),
			$keys[3] => $this->getCab(),
			$keys[4] => $this->getCin(),
			$keys[5] => $this->getIban(),
			$keys[6] => $this->getNumeroConto(),
			$keys[7] => $this->getNomeBanca(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BancaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setAbi($value);
				break;
			case 3:
				$this->setCab($value);
				break;
			case 4:
				$this->setCin($value);
				break;
			case 5:
				$this->setIban($value);
				break;
			case 6:
				$this->setNumeroConto($value);
				break;
			case 7:
				$this->setNomeBanca($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BancaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdUtente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAbi($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCab($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCin($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIban($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setNumeroConto($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setNomeBanca($arr[$keys[7]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BancaPeer::DATABASE_NAME);

		if ($this->isColumnModified(BancaPeer::ID)) $criteria->add(BancaPeer::ID, $this->id);
		if ($this->isColumnModified(BancaPeer::ID_UTENTE)) $criteria->add(BancaPeer::ID_UTENTE, $this->id_utente);
		if ($this->isColumnModified(BancaPeer::ABI)) $criteria->add(BancaPeer::ABI, $this->abi);
		if ($this->isColumnModified(BancaPeer::CAB)) $criteria->add(BancaPeer::CAB, $this->cab);
		if ($this->isColumnModified(BancaPeer::CIN)) $criteria->add(BancaPeer::CIN, $this->cin);
		if ($this->isColumnModified(BancaPeer::IBAN)) $criteria->add(BancaPeer::IBAN, $this->iban);
		if ($this->isColumnModified(BancaPeer::NUMERO_CONTO)) $criteria->add(BancaPeer::NUMERO_CONTO, $this->numero_conto);
		if ($this->isColumnModified(BancaPeer::NOME_BANCA)) $criteria->add(BancaPeer::NOME_BANCA, $this->nome_banca);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BancaPeer::DATABASE_NAME);

		$criteria->add(BancaPeer::ID, $this->id);

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

		$copyObj->setAbi($this->abi);

		$copyObj->setCab($this->cab);

		$copyObj->setCin($this->cin);

		$copyObj->setIban($this->iban);

		$copyObj->setNumeroConto($this->numero_conto);

		$copyObj->setNomeBanca($this->nome_banca);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getClientes() as $relObj) {
				$copyObj->addCliente($relObj->copy($deepCopy));
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
			self::$peer = new BancaPeer();
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

	
	public function initClientes()
	{
		if ($this->collClientes === null) {
			$this->collClientes = array();
		}
	}

	
	public function getClientes($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClientePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClientes === null) {
			if ($this->isNew()) {
			   $this->collClientes = array();
			} else {

				$criteria->add(ClientePeer::ID_BANCA, $this->getId());

				ClientePeer::addSelectColumns($criteria);
				$this->collClientes = ClientePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClientePeer::ID_BANCA, $this->getId());

				ClientePeer::addSelectColumns($criteria);
				if (!isset($this->lastClienteCriteria) || !$this->lastClienteCriteria->equals($criteria)) {
					$this->collClientes = ClientePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastClienteCriteria = $criteria;
		return $this->collClientes;
	}

	
	public function countClientes($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseClientePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ClientePeer::ID_BANCA, $this->getId());

		return ClientePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCliente(Cliente $l)
	{
		$this->collClientes[] = $l;
		$l->setBanca($this);
	}


	
	public function getClientesJoinUtente($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClientePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClientes === null) {
			if ($this->isNew()) {
				$this->collClientes = array();
			} else {

				$criteria->add(ClientePeer::ID_BANCA, $this->getId());

				$this->collClientes = ClientePeer::doSelectJoinUtente($criteria, $con);
			}
		} else {
									
			$criteria->add(ClientePeer::ID_BANCA, $this->getId());

			if (!isset($this->lastClienteCriteria) || !$this->lastClienteCriteria->equals($criteria)) {
				$this->collClientes = ClientePeer::doSelectJoinUtente($criteria, $con);
			}
		}
		$this->lastClienteCriteria = $criteria;

		return $this->collClientes;
	}


	
	public function getClientesJoinModoPagamento($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClientePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClientes === null) {
			if ($this->isNew()) {
				$this->collClientes = array();
			} else {

				$criteria->add(ClientePeer::ID_BANCA, $this->getId());

				$this->collClientes = ClientePeer::doSelectJoinModoPagamento($criteria, $con);
			}
		} else {
									
			$criteria->add(ClientePeer::ID_BANCA, $this->getId());

			if (!isset($this->lastClienteCriteria) || !$this->lastClienteCriteria->equals($criteria)) {
				$this->collClientes = ClientePeer::doSelectJoinModoPagamento($criteria, $con);
			}
		}
		$this->lastClienteCriteria = $criteria;

		return $this->collClientes;
	}


	
	public function getClientesJoinTemaFattura($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseClientePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collClientes === null) {
			if ($this->isNew()) {
				$this->collClientes = array();
			} else {

				$criteria->add(ClientePeer::ID_BANCA, $this->getId());

				$this->collClientes = ClientePeer::doSelectJoinTemaFattura($criteria, $con);
			}
		} else {
									
			$criteria->add(ClientePeer::ID_BANCA, $this->getId());

			if (!isset($this->lastClienteCriteria) || !$this->lastClienteCriteria->equals($criteria)) {
				$this->collClientes = ClientePeer::doSelectJoinTemaFattura($criteria, $con);
			}
		}
		$this->lastClienteCriteria = $criteria;

		return $this->collClientes;
	}

} 