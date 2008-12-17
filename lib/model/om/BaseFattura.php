<?php


abstract class BaseFattura extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_utente = 0;


	
	protected $num_fattura = 0;


	
	protected $cliente_id = 0;


	
	protected $data;


	
	protected $data_stato;


	
	protected $modo_pagamento_id;


	
	protected $sconto = 0;


	
	protected $vat = 20;


	
	protected $spese_anticipate = 0;


	
	protected $totale_mem;


	
	protected $imponibile_mem;


	
	protected $stato = 'n';


	
	protected $iva_pagata = 'n';


	
	protected $iva_depositata = 'n';


	
	protected $commercialista = 'n';


	
	protected $note;


	
	protected $calcola_ritenuta_acconto = 'a';


	
	protected $includi_tasse = '';


	
	protected $calcola_tasse = 's';

	
	protected $aUtente;

	
	protected $aCliente;

	
	protected $aModoPagamento;

	
	protected $collDettagliFatturas;

	
	protected $lastDettagliFatturaCriteria = null;

	
	protected $collTagsFatturas;

	
	protected $lastTagsFatturaCriteria = null;

	
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

	
	public function getNumFattura()
	{

		return $this->num_fattura;
	}

	
	public function getClienteId()
	{

		return $this->cliente_id;
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

	
	public function getDataStato($format = 'Y-m-d')
	{

		if ($this->data_stato === null || $this->data_stato === '') {
			return null;
		} elseif (!is_int($this->data_stato)) {
						$ts = strtotime($this->data_stato);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [data_stato] as date/time value: " . var_export($this->data_stato, true));
			}
		} else {
			$ts = $this->data_stato;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getModoPagamentoId()
	{

		return $this->modo_pagamento_id;
	}

	
	public function getSconto()
	{

		return $this->sconto;
	}

	
	public function getVat()
	{

		return $this->vat;
	}

	
	public function getSpeseAnticipate()
	{

		return $this->spese_anticipate;
	}

	
	public function getTotaleMem()
	{

		return $this->totale_mem;
	}

	
	public function getImponibileMem()
	{

		return $this->imponibile_mem;
	}

	
	public function getStato()
	{

		return $this->stato;
	}

	
	public function getIvaPagata()
	{

		return $this->iva_pagata;
	}

	
	public function getIvaDepositata()
	{

		return $this->iva_depositata;
	}

	
	public function getCommercialista()
	{

		return $this->commercialista;
	}

	
	public function getNote()
	{

		return $this->note;
	}

	
	public function getCalcolaRitenutaAcconto()
	{

		return $this->calcola_ritenuta_acconto;
	}

	
	public function getIncludiTasse()
	{

		return $this->includi_tasse;
	}

	
	public function getCalcolaTasse()
	{

		return $this->calcola_tasse;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = FatturaPeer::ID;
		}

	} 
	
	public function setIdUtente($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_utente !== $v || $v === 0) {
			$this->id_utente = $v;
			$this->modifiedColumns[] = FatturaPeer::ID_UTENTE;
		}

		if ($this->aUtente !== null && $this->aUtente->getId() !== $v) {
			$this->aUtente = null;
		}

	} 
	
	public function setNumFattura($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->num_fattura !== $v || $v === 0) {
			$this->num_fattura = $v;
			$this->modifiedColumns[] = FatturaPeer::NUM_FATTURA;
		}

	} 
	
	public function setClienteId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cliente_id !== $v || $v === 0) {
			$this->cliente_id = $v;
			$this->modifiedColumns[] = FatturaPeer::CLIENTE_ID;
		}

		if ($this->aCliente !== null && $this->aCliente->getId() !== $v) {
			$this->aCliente = null;
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
			$this->modifiedColumns[] = FatturaPeer::DATA;
		}

	} 
	
	public function setDataStato($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [data_stato] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->data_stato !== $ts) {
			$this->data_stato = $ts;
			$this->modifiedColumns[] = FatturaPeer::DATA_STATO;
		}

	} 
	
	public function setModoPagamentoId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->modo_pagamento_id !== $v) {
			$this->modo_pagamento_id = $v;
			$this->modifiedColumns[] = FatturaPeer::MODO_PAGAMENTO_ID;
		}

		if ($this->aModoPagamento !== null && $this->aModoPagamento->getId() !== $v) {
			$this->aModoPagamento = null;
		}

	} 
	
	public function setSconto($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sconto !== $v || $v === 0) {
			$this->sconto = $v;
			$this->modifiedColumns[] = FatturaPeer::SCONTO;
		}

	} 
	
	public function setVat($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->vat !== $v || $v === 20) {
			$this->vat = $v;
			$this->modifiedColumns[] = FatturaPeer::VAT;
		}

	} 
	
	public function setSpeseAnticipate($v)
	{

		if ($this->spese_anticipate !== $v || $v === 0) {
			$this->spese_anticipate = $v;
			$this->modifiedColumns[] = FatturaPeer::SPESE_ANTICIPATE;
		}

	} 
	
	public function setTotaleMem($v)
	{

		if ($this->totale_mem !== $v) {
			$this->totale_mem = $v;
			$this->modifiedColumns[] = FatturaPeer::TOTALE_MEM;
		}

	} 
	
	public function setImponibileMem($v)
	{

		if ($this->imponibile_mem !== $v) {
			$this->imponibile_mem = $v;
			$this->modifiedColumns[] = FatturaPeer::IMPONIBILE_MEM;
		}

	} 
	
	public function setStato($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stato !== $v || $v === 'n') {
			$this->stato = $v;
			$this->modifiedColumns[] = FatturaPeer::STATO;
		}

	} 
	
	public function setIvaPagata($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->iva_pagata !== $v || $v === 'n') {
			$this->iva_pagata = $v;
			$this->modifiedColumns[] = FatturaPeer::IVA_PAGATA;
		}

	} 
	
	public function setIvaDepositata($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->iva_depositata !== $v || $v === 'n') {
			$this->iva_depositata = $v;
			$this->modifiedColumns[] = FatturaPeer::IVA_DEPOSITATA;
		}

	} 
	
	public function setCommercialista($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->commercialista !== $v || $v === 'n') {
			$this->commercialista = $v;
			$this->modifiedColumns[] = FatturaPeer::COMMERCIALISTA;
		}

	} 
	
	public function setNote($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->note !== $v) {
			$this->note = $v;
			$this->modifiedColumns[] = FatturaPeer::NOTE;
		}

	} 
	
	public function setCalcolaRitenutaAcconto($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->calcola_ritenuta_acconto !== $v || $v === 'a') {
			$this->calcola_ritenuta_acconto = $v;
			$this->modifiedColumns[] = FatturaPeer::CALCOLA_RITENUTA_ACCONTO;
		}

	} 
	
	public function setIncludiTasse($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->includi_tasse !== $v || $v === '') {
			$this->includi_tasse = $v;
			$this->modifiedColumns[] = FatturaPeer::INCLUDI_TASSE;
		}

	} 
	
	public function setCalcolaTasse($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->calcola_tasse !== $v || $v === 's') {
			$this->calcola_tasse = $v;
			$this->modifiedColumns[] = FatturaPeer::CALCOLA_TASSE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_utente = $rs->getInt($startcol + 1);

			$this->num_fattura = $rs->getInt($startcol + 2);

			$this->cliente_id = $rs->getInt($startcol + 3);

			$this->data = $rs->getDate($startcol + 4, null);

			$this->data_stato = $rs->getDate($startcol + 5, null);

			$this->modo_pagamento_id = $rs->getInt($startcol + 6);

			$this->sconto = $rs->getInt($startcol + 7);

			$this->vat = $rs->getInt($startcol + 8);

			$this->spese_anticipate = $rs->getFloat($startcol + 9);

			$this->totale_mem = $rs->getFloat($startcol + 10);

			$this->imponibile_mem = $rs->getFloat($startcol + 11);

			$this->stato = $rs->getString($startcol + 12);

			$this->iva_pagata = $rs->getString($startcol + 13);

			$this->iva_depositata = $rs->getString($startcol + 14);

			$this->commercialista = $rs->getString($startcol + 15);

			$this->note = $rs->getString($startcol + 16);

			$this->calcola_ritenuta_acconto = $rs->getString($startcol + 17);

			$this->includi_tasse = $rs->getString($startcol + 18);

			$this->calcola_tasse = $rs->getString($startcol + 19);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 20; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Fattura object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FatturaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FatturaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(FatturaPeer::DATABASE_NAME);
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

			if ($this->aCliente !== null) {
				if ($this->aCliente->isModified()) {
					$affectedRows += $this->aCliente->save($con);
				}
				$this->setCliente($this->aCliente);
			}

			if ($this->aModoPagamento !== null) {
				if ($this->aModoPagamento->isModified()) {
					$affectedRows += $this->aModoPagamento->save($con);
				}
				$this->setModoPagamento($this->aModoPagamento);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FatturaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FatturaPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDettagliFatturas !== null) {
				foreach($this->collDettagliFatturas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTagsFatturas !== null) {
				foreach($this->collTagsFatturas as $referrerFK) {
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

			if ($this->aCliente !== null) {
				if (!$this->aCliente->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCliente->getValidationFailures());
				}
			}

			if ($this->aModoPagamento !== null) {
				if (!$this->aModoPagamento->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aModoPagamento->getValidationFailures());
				}
			}


			if (($retval = FatturaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDettagliFatturas !== null) {
					foreach($this->collDettagliFatturas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTagsFatturas !== null) {
					foreach($this->collTagsFatturas as $referrerFK) {
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
		$pos = FatturaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getNumFattura();
				break;
			case 3:
				return $this->getClienteId();
				break;
			case 4:
				return $this->getData();
				break;
			case 5:
				return $this->getDataStato();
				break;
			case 6:
				return $this->getModoPagamentoId();
				break;
			case 7:
				return $this->getSconto();
				break;
			case 8:
				return $this->getVat();
				break;
			case 9:
				return $this->getSpeseAnticipate();
				break;
			case 10:
				return $this->getTotaleMem();
				break;
			case 11:
				return $this->getImponibileMem();
				break;
			case 12:
				return $this->getStato();
				break;
			case 13:
				return $this->getIvaPagata();
				break;
			case 14:
				return $this->getIvaDepositata();
				break;
			case 15:
				return $this->getCommercialista();
				break;
			case 16:
				return $this->getNote();
				break;
			case 17:
				return $this->getCalcolaRitenutaAcconto();
				break;
			case 18:
				return $this->getIncludiTasse();
				break;
			case 19:
				return $this->getCalcolaTasse();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FatturaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdUtente(),
			$keys[2] => $this->getNumFattura(),
			$keys[3] => $this->getClienteId(),
			$keys[4] => $this->getData(),
			$keys[5] => $this->getDataStato(),
			$keys[6] => $this->getModoPagamentoId(),
			$keys[7] => $this->getSconto(),
			$keys[8] => $this->getVat(),
			$keys[9] => $this->getSpeseAnticipate(),
			$keys[10] => $this->getTotaleMem(),
			$keys[11] => $this->getImponibileMem(),
			$keys[12] => $this->getStato(),
			$keys[13] => $this->getIvaPagata(),
			$keys[14] => $this->getIvaDepositata(),
			$keys[15] => $this->getCommercialista(),
			$keys[16] => $this->getNote(),
			$keys[17] => $this->getCalcolaRitenutaAcconto(),
			$keys[18] => $this->getIncludiTasse(),
			$keys[19] => $this->getCalcolaTasse(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FatturaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setNumFattura($value);
				break;
			case 3:
				$this->setClienteId($value);
				break;
			case 4:
				$this->setData($value);
				break;
			case 5:
				$this->setDataStato($value);
				break;
			case 6:
				$this->setModoPagamentoId($value);
				break;
			case 7:
				$this->setSconto($value);
				break;
			case 8:
				$this->setVat($value);
				break;
			case 9:
				$this->setSpeseAnticipate($value);
				break;
			case 10:
				$this->setTotaleMem($value);
				break;
			case 11:
				$this->setImponibileMem($value);
				break;
			case 12:
				$this->setStato($value);
				break;
			case 13:
				$this->setIvaPagata($value);
				break;
			case 14:
				$this->setIvaDepositata($value);
				break;
			case 15:
				$this->setCommercialista($value);
				break;
			case 16:
				$this->setNote($value);
				break;
			case 17:
				$this->setCalcolaRitenutaAcconto($value);
				break;
			case 18:
				$this->setIncludiTasse($value);
				break;
			case 19:
				$this->setCalcolaTasse($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FatturaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdUtente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNumFattura($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setClienteId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setData($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setDataStato($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setModoPagamentoId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setSconto($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setVat($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setSpeseAnticipate($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setTotaleMem($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setImponibileMem($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setStato($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIvaPagata($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setIvaDepositata($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setCommercialista($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setNote($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setCalcolaRitenutaAcconto($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setIncludiTasse($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCalcolaTasse($arr[$keys[19]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FatturaPeer::DATABASE_NAME);

		if ($this->isColumnModified(FatturaPeer::ID)) $criteria->add(FatturaPeer::ID, $this->id);
		if ($this->isColumnModified(FatturaPeer::ID_UTENTE)) $criteria->add(FatturaPeer::ID_UTENTE, $this->id_utente);
		if ($this->isColumnModified(FatturaPeer::NUM_FATTURA)) $criteria->add(FatturaPeer::NUM_FATTURA, $this->num_fattura);
		if ($this->isColumnModified(FatturaPeer::CLIENTE_ID)) $criteria->add(FatturaPeer::CLIENTE_ID, $this->cliente_id);
		if ($this->isColumnModified(FatturaPeer::DATA)) $criteria->add(FatturaPeer::DATA, $this->data);
		if ($this->isColumnModified(FatturaPeer::DATA_STATO)) $criteria->add(FatturaPeer::DATA_STATO, $this->data_stato);
		if ($this->isColumnModified(FatturaPeer::MODO_PAGAMENTO_ID)) $criteria->add(FatturaPeer::MODO_PAGAMENTO_ID, $this->modo_pagamento_id);
		if ($this->isColumnModified(FatturaPeer::SCONTO)) $criteria->add(FatturaPeer::SCONTO, $this->sconto);
		if ($this->isColumnModified(FatturaPeer::VAT)) $criteria->add(FatturaPeer::VAT, $this->vat);
		if ($this->isColumnModified(FatturaPeer::SPESE_ANTICIPATE)) $criteria->add(FatturaPeer::SPESE_ANTICIPATE, $this->spese_anticipate);
		if ($this->isColumnModified(FatturaPeer::TOTALE_MEM)) $criteria->add(FatturaPeer::TOTALE_MEM, $this->totale_mem);
		if ($this->isColumnModified(FatturaPeer::IMPONIBILE_MEM)) $criteria->add(FatturaPeer::IMPONIBILE_MEM, $this->imponibile_mem);
		if ($this->isColumnModified(FatturaPeer::STATO)) $criteria->add(FatturaPeer::STATO, $this->stato);
		if ($this->isColumnModified(FatturaPeer::IVA_PAGATA)) $criteria->add(FatturaPeer::IVA_PAGATA, $this->iva_pagata);
		if ($this->isColumnModified(FatturaPeer::IVA_DEPOSITATA)) $criteria->add(FatturaPeer::IVA_DEPOSITATA, $this->iva_depositata);
		if ($this->isColumnModified(FatturaPeer::COMMERCIALISTA)) $criteria->add(FatturaPeer::COMMERCIALISTA, $this->commercialista);
		if ($this->isColumnModified(FatturaPeer::NOTE)) $criteria->add(FatturaPeer::NOTE, $this->note);
		if ($this->isColumnModified(FatturaPeer::CALCOLA_RITENUTA_ACCONTO)) $criteria->add(FatturaPeer::CALCOLA_RITENUTA_ACCONTO, $this->calcola_ritenuta_acconto);
		if ($this->isColumnModified(FatturaPeer::INCLUDI_TASSE)) $criteria->add(FatturaPeer::INCLUDI_TASSE, $this->includi_tasse);
		if ($this->isColumnModified(FatturaPeer::CALCOLA_TASSE)) $criteria->add(FatturaPeer::CALCOLA_TASSE, $this->calcola_tasse);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FatturaPeer::DATABASE_NAME);

		$criteria->add(FatturaPeer::ID, $this->id);

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

		$copyObj->setNumFattura($this->num_fattura);

		$copyObj->setClienteId($this->cliente_id);

		$copyObj->setData($this->data);

		$copyObj->setDataStato($this->data_stato);

		$copyObj->setModoPagamentoId($this->modo_pagamento_id);

		$copyObj->setSconto($this->sconto);

		$copyObj->setVat($this->vat);

		$copyObj->setSpeseAnticipate($this->spese_anticipate);

		$copyObj->setTotaleMem($this->totale_mem);

		$copyObj->setImponibileMem($this->imponibile_mem);

		$copyObj->setStato($this->stato);

		$copyObj->setIvaPagata($this->iva_pagata);

		$copyObj->setIvaDepositata($this->iva_depositata);

		$copyObj->setCommercialista($this->commercialista);

		$copyObj->setNote($this->note);

		$copyObj->setCalcolaRitenutaAcconto($this->calcola_ritenuta_acconto);

		$copyObj->setIncludiTasse($this->includi_tasse);

		$copyObj->setCalcolaTasse($this->calcola_tasse);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDettagliFatturas() as $relObj) {
				$copyObj->addDettagliFattura($relObj->copy($deepCopy));
			}

			foreach($this->getTagsFatturas() as $relObj) {
				$copyObj->addTagsFattura($relObj->copy($deepCopy));
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
			self::$peer = new FatturaPeer();
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

	
	public function setCliente($v)
	{


		if ($v === null) {
			$this->setClienteId('0');
		} else {
			$this->setClienteId($v->getId());
		}


		$this->aCliente = $v;
	}


	
	public function getCliente($con = null)
	{
		if ($this->aCliente === null && ($this->cliente_id !== null)) {
						$this->aCliente = ClientePeer::retrieveByPK($this->cliente_id, $con);

			
		}
		return $this->aCliente;
	}

	
	public function setModoPagamento($v)
	{


		if ($v === null) {
			$this->setModoPagamentoId(NULL);
		} else {
			$this->setModoPagamentoId($v->getId());
		}


		$this->aModoPagamento = $v;
	}


	
	public function getModoPagamento($con = null)
	{
		if ($this->aModoPagamento === null && ($this->modo_pagamento_id !== null)) {
						$this->aModoPagamento = ModoPagamentoPeer::retrieveByPK($this->modo_pagamento_id, $con);

			
		}
		return $this->aModoPagamento;
	}

	
	public function initDettagliFatturas()
	{
		if ($this->collDettagliFatturas === null) {
			$this->collDettagliFatturas = array();
		}
	}

	
	public function getDettagliFatturas($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDettagliFatturas === null) {
			if ($this->isNew()) {
			   $this->collDettagliFatturas = array();
			} else {

				$criteria->add(DettagliFatturaPeer::FATTURA_ID, $this->getId());

				DettagliFatturaPeer::addSelectColumns($criteria);
				$this->collDettagliFatturas = DettagliFatturaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DettagliFatturaPeer::FATTURA_ID, $this->getId());

				DettagliFatturaPeer::addSelectColumns($criteria);
				if (!isset($this->lastDettagliFatturaCriteria) || !$this->lastDettagliFatturaCriteria->equals($criteria)) {
					$this->collDettagliFatturas = DettagliFatturaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDettagliFatturaCriteria = $criteria;
		return $this->collDettagliFatturas;
	}

	
	public function countDettagliFatturas($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DettagliFatturaPeer::FATTURA_ID, $this->getId());

		return DettagliFatturaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDettagliFattura(DettagliFattura $l)
	{
		$this->collDettagliFatturas[] = $l;
		$l->setFattura($this);
	}

	
	public function initTagsFatturas()
	{
		if ($this->collTagsFatturas === null) {
			$this->collTagsFatturas = array();
		}
	}

	
	public function getTagsFatturas($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTagsFatturas === null) {
			if ($this->isNew()) {
			   $this->collTagsFatturas = array();
			} else {

				$criteria->add(TagsFatturaPeer::ID_FATTURA, $this->getId());

				TagsFatturaPeer::addSelectColumns($criteria);
				$this->collTagsFatturas = TagsFatturaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TagsFatturaPeer::ID_FATTURA, $this->getId());

				TagsFatturaPeer::addSelectColumns($criteria);
				if (!isset($this->lastTagsFatturaCriteria) || !$this->lastTagsFatturaCriteria->equals($criteria)) {
					$this->collTagsFatturas = TagsFatturaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTagsFatturaCriteria = $criteria;
		return $this->collTagsFatturas;
	}

	
	public function countTagsFatturas($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TagsFatturaPeer::ID_FATTURA, $this->getId());

		return TagsFatturaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTagsFattura(TagsFattura $l)
	{
		$this->collTagsFatturas[] = $l;
		$l->setFattura($this);
	}


	
	public function getTagsFatturasJoinUtente($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTagsFatturas === null) {
			if ($this->isNew()) {
				$this->collTagsFatturas = array();
			} else {

				$criteria->add(TagsFatturaPeer::ID_FATTURA, $this->getId());

				$this->collTagsFatturas = TagsFatturaPeer::doSelectJoinUtente($criteria, $con);
			}
		} else {
									
			$criteria->add(TagsFatturaPeer::ID_FATTURA, $this->getId());

			if (!isset($this->lastTagsFatturaCriteria) || !$this->lastTagsFatturaCriteria->equals($criteria)) {
				$this->collTagsFatturas = TagsFatturaPeer::doSelectJoinUtente($criteria, $con);
			}
		}
		$this->lastTagsFatturaCriteria = $criteria;

		return $this->collTagsFatturas;
	}

} 