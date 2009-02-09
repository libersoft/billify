<?php


abstract class BaseTemaFattura extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_utente = 0;


	
	protected $nome = 'null';


	
	protected $template;


	
	protected $css;


	
	protected $logo;

	
	protected $aUtente;

	
	protected $collContattos;

	
	protected $lastContattoCriteria = null;

	
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

	
	public function getNome()
	{

		return $this->nome;
	}

	
	public function getTemplate()
	{

		return $this->template;
	}

	
	public function getCss()
	{

		return $this->css;
	}

	
	public function getLogo()
	{

		return $this->logo;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TemaFatturaPeer::ID;
		}

	} 
	
	public function setIdUtente($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_utente !== $v || $v === 0) {
			$this->id_utente = $v;
			$this->modifiedColumns[] = TemaFatturaPeer::ID_UTENTE;
		}

		if ($this->aUtente !== null && $this->aUtente->getId() !== $v) {
			$this->aUtente = null;
		}

	} 
	
	public function setNome($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nome !== $v || $v === 'null') {
			$this->nome = $v;
			$this->modifiedColumns[] = TemaFatturaPeer::NOME;
		}

	} 
	
	public function setTemplate($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->template !== $v) {
			$this->template = $v;
			$this->modifiedColumns[] = TemaFatturaPeer::TEMPLATE;
		}

	} 
	
	public function setCss($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->css !== $v) {
			$this->css = $v;
			$this->modifiedColumns[] = TemaFatturaPeer::CSS;
		}

	} 
	
	public function setLogo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->logo !== $v) {
			$this->logo = $v;
			$this->modifiedColumns[] = TemaFatturaPeer::LOGO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_utente = $rs->getInt($startcol + 1);

			$this->nome = $rs->getString($startcol + 2);

			$this->template = $rs->getString($startcol + 3);

			$this->css = $rs->getString($startcol + 4);

			$this->logo = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating TemaFattura object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(TemaFatturaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			TemaFatturaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(TemaFatturaPeer::DATABASE_NAME);
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
					$pk = TemaFatturaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += TemaFatturaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collContattos !== null) {
				foreach($this->collContattos as $referrerFK) {
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


			if (($retval = TemaFatturaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collContattos !== null) {
					foreach($this->collContattos as $referrerFK) {
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
		$pos = TemaFatturaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getNome();
				break;
			case 3:
				return $this->getTemplate();
				break;
			case 4:
				return $this->getCss();
				break;
			case 5:
				return $this->getLogo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TemaFatturaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdUtente(),
			$keys[2] => $this->getNome(),
			$keys[3] => $this->getTemplate(),
			$keys[4] => $this->getCss(),
			$keys[5] => $this->getLogo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = TemaFatturaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setNome($value);
				break;
			case 3:
				$this->setTemplate($value);
				break;
			case 4:
				$this->setCss($value);
				break;
			case 5:
				$this->setLogo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = TemaFatturaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdUtente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNome($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setTemplate($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCss($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setLogo($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(TemaFatturaPeer::DATABASE_NAME);

		if ($this->isColumnModified(TemaFatturaPeer::ID)) $criteria->add(TemaFatturaPeer::ID, $this->id);
		if ($this->isColumnModified(TemaFatturaPeer::ID_UTENTE)) $criteria->add(TemaFatturaPeer::ID_UTENTE, $this->id_utente);
		if ($this->isColumnModified(TemaFatturaPeer::NOME)) $criteria->add(TemaFatturaPeer::NOME, $this->nome);
		if ($this->isColumnModified(TemaFatturaPeer::TEMPLATE)) $criteria->add(TemaFatturaPeer::TEMPLATE, $this->template);
		if ($this->isColumnModified(TemaFatturaPeer::CSS)) $criteria->add(TemaFatturaPeer::CSS, $this->css);
		if ($this->isColumnModified(TemaFatturaPeer::LOGO)) $criteria->add(TemaFatturaPeer::LOGO, $this->logo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(TemaFatturaPeer::DATABASE_NAME);

		$criteria->add(TemaFatturaPeer::ID, $this->id);

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

		$copyObj->setNome($this->nome);

		$copyObj->setTemplate($this->template);

		$copyObj->setCss($this->css);

		$copyObj->setLogo($this->logo);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getContattos() as $relObj) {
				$copyObj->addContatto($relObj->copy($deepCopy));
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
			self::$peer = new TemaFatturaPeer();
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

				$criteria->add(ContattoPeer::ID_TEMA_FATTURA, $this->getId());

				ContattoPeer::addSelectColumns($criteria);
				$this->collContattos = ContattoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContattoPeer::ID_TEMA_FATTURA, $this->getId());

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

		$criteria->add(ContattoPeer::ID_TEMA_FATTURA, $this->getId());

		return ContattoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addContatto(Contatto $l)
	{
		$this->collContattos[] = $l;
		$l->setTemaFattura($this);
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

				$criteria->add(ContattoPeer::ID_TEMA_FATTURA, $this->getId());

				$this->collContattos = ContattoPeer::doSelectJoinUtente($criteria, $con);
			}
		} else {
									
			$criteria->add(ContattoPeer::ID_TEMA_FATTURA, $this->getId());

			if (!isset($this->lastContattoCriteria) || !$this->lastContattoCriteria->equals($criteria)) {
				$this->collContattos = ContattoPeer::doSelectJoinUtente($criteria, $con);
			}
		}
		$this->lastContattoCriteria = $criteria;

		return $this->collContattos;
	}


	
	public function getContattosJoinModoPagamento($criteria = null, $con = null)
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

				$criteria->add(ContattoPeer::ID_TEMA_FATTURA, $this->getId());

				$this->collContattos = ContattoPeer::doSelectJoinModoPagamento($criteria, $con);
			}
		} else {
									
			$criteria->add(ContattoPeer::ID_TEMA_FATTURA, $this->getId());

			if (!isset($this->lastContattoCriteria) || !$this->lastContattoCriteria->equals($criteria)) {
				$this->collContattos = ContattoPeer::doSelectJoinModoPagamento($criteria, $con);
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

				$criteria->add(ContattoPeer::ID_TEMA_FATTURA, $this->getId());

				$this->collContattos = ContattoPeer::doSelectJoinBanca($criteria, $con);
			}
		} else {
									
			$criteria->add(ContattoPeer::ID_TEMA_FATTURA, $this->getId());

			if (!isset($this->lastContattoCriteria) || !$this->lastContattoCriteria->equals($criteria)) {
				$this->collContattos = ContattoPeer::doSelectJoinBanca($criteria, $con);
			}
		}
		$this->lastContattoCriteria = $criteria;

		return $this->collContattos;
	}

} 