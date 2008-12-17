<?php


abstract class BaseCliente extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_utente = 0;


	
	protected $azienda = '';


	
	protected $ragione_sociale;


	
	protected $via;


	
	protected $citta;


	
	protected $provincia;


	
	protected $cap;


	
	protected $piva;


	
	protected $cf;


	
	protected $cognome;


	
	protected $nome;


	
	protected $telefono;


	
	protected $fax;


	
	protected $cellulare;


	
	protected $email;


	
	protected $modo_pagamento_id;


	
	protected $stato = 'a';


	
	protected $note;


	
	protected $id_tema_fattura;


	
	protected $id_banca;


	
	protected $calcola_ritenuta_acconto = 'a';


	
	protected $includi_tasse = '';


	
	protected $calcola_tasse = 's';


	
	protected $cod;

	
	protected $aUtente;

	
	protected $aModoPagamento;

	
	protected $aTemaFattura;

	
	protected $aBanca;

	
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

	
	public function getAzienda()
	{

		return $this->azienda;
	}

	
	public function getRagioneSociale()
	{

		return $this->ragione_sociale;
	}

	
	public function getVia()
	{

		return $this->via;
	}

	
	public function getCitta()
	{

		return $this->citta;
	}

	
	public function getProvincia()
	{

		return $this->provincia;
	}

	
	public function getCap()
	{

		return $this->cap;
	}

	
	public function getPiva()
	{

		return $this->piva;
	}

	
	public function getCf()
	{

		return $this->cf;
	}

	
	public function getCognome()
	{

		return $this->cognome;
	}

	
	public function getNome()
	{

		return $this->nome;
	}

	
	public function getTelefono()
	{

		return $this->telefono;
	}

	
	public function getFax()
	{

		return $this->fax;
	}

	
	public function getCellulare()
	{

		return $this->cellulare;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getModoPagamentoId()
	{

		return $this->modo_pagamento_id;
	}

	
	public function getStato()
	{

		return $this->stato;
	}

	
	public function getNote()
	{

		return $this->note;
	}

	
	public function getIdTemaFattura()
	{

		return $this->id_tema_fattura;
	}

	
	public function getIdBanca()
	{

		return $this->id_banca;
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

	
	public function getCod()
	{

		return $this->cod;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ClientePeer::ID;
		}

	} 
	
	public function setIdUtente($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_utente !== $v || $v === 0) {
			$this->id_utente = $v;
			$this->modifiedColumns[] = ClientePeer::ID_UTENTE;
		}

		if ($this->aUtente !== null && $this->aUtente->getId() !== $v) {
			$this->aUtente = null;
		}

	} 
	
	public function setAzienda($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->azienda !== $v || $v === '') {
			$this->azienda = $v;
			$this->modifiedColumns[] = ClientePeer::AZIENDA;
		}

	} 
	
	public function setRagioneSociale($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ragione_sociale !== $v) {
			$this->ragione_sociale = $v;
			$this->modifiedColumns[] = ClientePeer::RAGIONE_SOCIALE;
		}

	} 
	
	public function setVia($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->via !== $v) {
			$this->via = $v;
			$this->modifiedColumns[] = ClientePeer::VIA;
		}

	} 
	
	public function setCitta($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->citta !== $v) {
			$this->citta = $v;
			$this->modifiedColumns[] = ClientePeer::CITTA;
		}

	} 
	
	public function setProvincia($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->provincia !== $v) {
			$this->provincia = $v;
			$this->modifiedColumns[] = ClientePeer::PROVINCIA;
		}

	} 
	
	public function setCap($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cap !== $v) {
			$this->cap = $v;
			$this->modifiedColumns[] = ClientePeer::CAP;
		}

	} 
	
	public function setPiva($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->piva !== $v) {
			$this->piva = $v;
			$this->modifiedColumns[] = ClientePeer::PIVA;
		}

	} 
	
	public function setCf($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cf !== $v) {
			$this->cf = $v;
			$this->modifiedColumns[] = ClientePeer::CF;
		}

	} 
	
	public function setCognome($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cognome !== $v) {
			$this->cognome = $v;
			$this->modifiedColumns[] = ClientePeer::COGNOME;
		}

	} 
	
	public function setNome($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nome !== $v) {
			$this->nome = $v;
			$this->modifiedColumns[] = ClientePeer::NOME;
		}

	} 
	
	public function setTelefono($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->telefono !== $v) {
			$this->telefono = $v;
			$this->modifiedColumns[] = ClientePeer::TELEFONO;
		}

	} 
	
	public function setFax($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->fax !== $v) {
			$this->fax = $v;
			$this->modifiedColumns[] = ClientePeer::FAX;
		}

	} 
	
	public function setCellulare($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cellulare !== $v) {
			$this->cellulare = $v;
			$this->modifiedColumns[] = ClientePeer::CELLULARE;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v) {
			$this->email = $v;
			$this->modifiedColumns[] = ClientePeer::EMAIL;
		}

	} 
	
	public function setModoPagamentoId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->modo_pagamento_id !== $v) {
			$this->modo_pagamento_id = $v;
			$this->modifiedColumns[] = ClientePeer::MODO_PAGAMENTO_ID;
		}

		if ($this->aModoPagamento !== null && $this->aModoPagamento->getId() !== $v) {
			$this->aModoPagamento = null;
		}

	} 
	
	public function setStato($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stato !== $v || $v === 'a') {
			$this->stato = $v;
			$this->modifiedColumns[] = ClientePeer::STATO;
		}

	} 
	
	public function setNote($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->note !== $v) {
			$this->note = $v;
			$this->modifiedColumns[] = ClientePeer::NOTE;
		}

	} 
	
	public function setIdTemaFattura($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_tema_fattura !== $v) {
			$this->id_tema_fattura = $v;
			$this->modifiedColumns[] = ClientePeer::ID_TEMA_FATTURA;
		}

		if ($this->aTemaFattura !== null && $this->aTemaFattura->getId() !== $v) {
			$this->aTemaFattura = null;
		}

	} 
	
	public function setIdBanca($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_banca !== $v) {
			$this->id_banca = $v;
			$this->modifiedColumns[] = ClientePeer::ID_BANCA;
		}

		if ($this->aBanca !== null && $this->aBanca->getId() !== $v) {
			$this->aBanca = null;
		}

	} 
	
	public function setCalcolaRitenutaAcconto($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->calcola_ritenuta_acconto !== $v || $v === 'a') {
			$this->calcola_ritenuta_acconto = $v;
			$this->modifiedColumns[] = ClientePeer::CALCOLA_RITENUTA_ACCONTO;
		}

	} 
	
	public function setIncludiTasse($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->includi_tasse !== $v || $v === '') {
			$this->includi_tasse = $v;
			$this->modifiedColumns[] = ClientePeer::INCLUDI_TASSE;
		}

	} 
	
	public function setCalcolaTasse($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->calcola_tasse !== $v || $v === 's') {
			$this->calcola_tasse = $v;
			$this->modifiedColumns[] = ClientePeer::CALCOLA_TASSE;
		}

	} 
	
	public function setCod($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cod !== $v) {
			$this->cod = $v;
			$this->modifiedColumns[] = ClientePeer::COD;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_utente = $rs->getInt($startcol + 1);

			$this->azienda = $rs->getString($startcol + 2);

			$this->ragione_sociale = $rs->getString($startcol + 3);

			$this->via = $rs->getString($startcol + 4);

			$this->citta = $rs->getString($startcol + 5);

			$this->provincia = $rs->getString($startcol + 6);

			$this->cap = $rs->getString($startcol + 7);

			$this->piva = $rs->getString($startcol + 8);

			$this->cf = $rs->getString($startcol + 9);

			$this->cognome = $rs->getString($startcol + 10);

			$this->nome = $rs->getString($startcol + 11);

			$this->telefono = $rs->getString($startcol + 12);

			$this->fax = $rs->getString($startcol + 13);

			$this->cellulare = $rs->getString($startcol + 14);

			$this->email = $rs->getString($startcol + 15);

			$this->modo_pagamento_id = $rs->getInt($startcol + 16);

			$this->stato = $rs->getString($startcol + 17);

			$this->note = $rs->getString($startcol + 18);

			$this->id_tema_fattura = $rs->getInt($startcol + 19);

			$this->id_banca = $rs->getInt($startcol + 20);

			$this->calcola_ritenuta_acconto = $rs->getString($startcol + 21);

			$this->includi_tasse = $rs->getString($startcol + 22);

			$this->calcola_tasse = $rs->getString($startcol + 23);

			$this->cod = $rs->getString($startcol + 24);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 25; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Cliente object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ClientePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ClientePeer::DATABASE_NAME);
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

			if ($this->aModoPagamento !== null) {
				if ($this->aModoPagamento->isModified()) {
					$affectedRows += $this->aModoPagamento->save($con);
				}
				$this->setModoPagamento($this->aModoPagamento);
			}

			if ($this->aTemaFattura !== null) {
				if ($this->aTemaFattura->isModified()) {
					$affectedRows += $this->aTemaFattura->save($con);
				}
				$this->setTemaFattura($this->aTemaFattura);
			}

			if ($this->aBanca !== null) {
				if ($this->aBanca->isModified()) {
					$affectedRows += $this->aBanca->save($con);
				}
				$this->setBanca($this->aBanca);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ClientePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ClientePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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

			if ($this->aModoPagamento !== null) {
				if (!$this->aModoPagamento->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aModoPagamento->getValidationFailures());
				}
			}

			if ($this->aTemaFattura !== null) {
				if (!$this->aTemaFattura->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aTemaFattura->getValidationFailures());
				}
			}

			if ($this->aBanca !== null) {
				if (!$this->aBanca->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBanca->getValidationFailures());
				}
			}


			if (($retval = ClientePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
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
		$pos = ClientePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getAzienda();
				break;
			case 3:
				return $this->getRagioneSociale();
				break;
			case 4:
				return $this->getVia();
				break;
			case 5:
				return $this->getCitta();
				break;
			case 6:
				return $this->getProvincia();
				break;
			case 7:
				return $this->getCap();
				break;
			case 8:
				return $this->getPiva();
				break;
			case 9:
				return $this->getCf();
				break;
			case 10:
				return $this->getCognome();
				break;
			case 11:
				return $this->getNome();
				break;
			case 12:
				return $this->getTelefono();
				break;
			case 13:
				return $this->getFax();
				break;
			case 14:
				return $this->getCellulare();
				break;
			case 15:
				return $this->getEmail();
				break;
			case 16:
				return $this->getModoPagamentoId();
				break;
			case 17:
				return $this->getStato();
				break;
			case 18:
				return $this->getNote();
				break;
			case 19:
				return $this->getIdTemaFattura();
				break;
			case 20:
				return $this->getIdBanca();
				break;
			case 21:
				return $this->getCalcolaRitenutaAcconto();
				break;
			case 22:
				return $this->getIncludiTasse();
				break;
			case 23:
				return $this->getCalcolaTasse();
				break;
			case 24:
				return $this->getCod();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClientePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdUtente(),
			$keys[2] => $this->getAzienda(),
			$keys[3] => $this->getRagioneSociale(),
			$keys[4] => $this->getVia(),
			$keys[5] => $this->getCitta(),
			$keys[6] => $this->getProvincia(),
			$keys[7] => $this->getCap(),
			$keys[8] => $this->getPiva(),
			$keys[9] => $this->getCf(),
			$keys[10] => $this->getCognome(),
			$keys[11] => $this->getNome(),
			$keys[12] => $this->getTelefono(),
			$keys[13] => $this->getFax(),
			$keys[14] => $this->getCellulare(),
			$keys[15] => $this->getEmail(),
			$keys[16] => $this->getModoPagamentoId(),
			$keys[17] => $this->getStato(),
			$keys[18] => $this->getNote(),
			$keys[19] => $this->getIdTemaFattura(),
			$keys[20] => $this->getIdBanca(),
			$keys[21] => $this->getCalcolaRitenutaAcconto(),
			$keys[22] => $this->getIncludiTasse(),
			$keys[23] => $this->getCalcolaTasse(),
			$keys[24] => $this->getCod(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ClientePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setAzienda($value);
				break;
			case 3:
				$this->setRagioneSociale($value);
				break;
			case 4:
				$this->setVia($value);
				break;
			case 5:
				$this->setCitta($value);
				break;
			case 6:
				$this->setProvincia($value);
				break;
			case 7:
				$this->setCap($value);
				break;
			case 8:
				$this->setPiva($value);
				break;
			case 9:
				$this->setCf($value);
				break;
			case 10:
				$this->setCognome($value);
				break;
			case 11:
				$this->setNome($value);
				break;
			case 12:
				$this->setTelefono($value);
				break;
			case 13:
				$this->setFax($value);
				break;
			case 14:
				$this->setCellulare($value);
				break;
			case 15:
				$this->setEmail($value);
				break;
			case 16:
				$this->setModoPagamentoId($value);
				break;
			case 17:
				$this->setStato($value);
				break;
			case 18:
				$this->setNote($value);
				break;
			case 19:
				$this->setIdTemaFattura($value);
				break;
			case 20:
				$this->setIdBanca($value);
				break;
			case 21:
				$this->setCalcolaRitenutaAcconto($value);
				break;
			case 22:
				$this->setIncludiTasse($value);
				break;
			case 23:
				$this->setCalcolaTasse($value);
				break;
			case 24:
				$this->setCod($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ClientePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdUtente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAzienda($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRagioneSociale($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setVia($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCitta($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setProvincia($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCap($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPiva($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCf($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCognome($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setNome($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setTelefono($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setFax($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setCellulare($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setEmail($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setModoPagamentoId($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setStato($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setNote($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setIdTemaFattura($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setIdBanca($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setCalcolaRitenutaAcconto($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setIncludiTasse($arr[$keys[22]]);
		if (array_key_exists($keys[23], $arr)) $this->setCalcolaTasse($arr[$keys[23]]);
		if (array_key_exists($keys[24], $arr)) $this->setCod($arr[$keys[24]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ClientePeer::DATABASE_NAME);

		if ($this->isColumnModified(ClientePeer::ID)) $criteria->add(ClientePeer::ID, $this->id);
		if ($this->isColumnModified(ClientePeer::ID_UTENTE)) $criteria->add(ClientePeer::ID_UTENTE, $this->id_utente);
		if ($this->isColumnModified(ClientePeer::AZIENDA)) $criteria->add(ClientePeer::AZIENDA, $this->azienda);
		if ($this->isColumnModified(ClientePeer::RAGIONE_SOCIALE)) $criteria->add(ClientePeer::RAGIONE_SOCIALE, $this->ragione_sociale);
		if ($this->isColumnModified(ClientePeer::VIA)) $criteria->add(ClientePeer::VIA, $this->via);
		if ($this->isColumnModified(ClientePeer::CITTA)) $criteria->add(ClientePeer::CITTA, $this->citta);
		if ($this->isColumnModified(ClientePeer::PROVINCIA)) $criteria->add(ClientePeer::PROVINCIA, $this->provincia);
		if ($this->isColumnModified(ClientePeer::CAP)) $criteria->add(ClientePeer::CAP, $this->cap);
		if ($this->isColumnModified(ClientePeer::PIVA)) $criteria->add(ClientePeer::PIVA, $this->piva);
		if ($this->isColumnModified(ClientePeer::CF)) $criteria->add(ClientePeer::CF, $this->cf);
		if ($this->isColumnModified(ClientePeer::COGNOME)) $criteria->add(ClientePeer::COGNOME, $this->cognome);
		if ($this->isColumnModified(ClientePeer::NOME)) $criteria->add(ClientePeer::NOME, $this->nome);
		if ($this->isColumnModified(ClientePeer::TELEFONO)) $criteria->add(ClientePeer::TELEFONO, $this->telefono);
		if ($this->isColumnModified(ClientePeer::FAX)) $criteria->add(ClientePeer::FAX, $this->fax);
		if ($this->isColumnModified(ClientePeer::CELLULARE)) $criteria->add(ClientePeer::CELLULARE, $this->cellulare);
		if ($this->isColumnModified(ClientePeer::EMAIL)) $criteria->add(ClientePeer::EMAIL, $this->email);
		if ($this->isColumnModified(ClientePeer::MODO_PAGAMENTO_ID)) $criteria->add(ClientePeer::MODO_PAGAMENTO_ID, $this->modo_pagamento_id);
		if ($this->isColumnModified(ClientePeer::STATO)) $criteria->add(ClientePeer::STATO, $this->stato);
		if ($this->isColumnModified(ClientePeer::NOTE)) $criteria->add(ClientePeer::NOTE, $this->note);
		if ($this->isColumnModified(ClientePeer::ID_TEMA_FATTURA)) $criteria->add(ClientePeer::ID_TEMA_FATTURA, $this->id_tema_fattura);
		if ($this->isColumnModified(ClientePeer::ID_BANCA)) $criteria->add(ClientePeer::ID_BANCA, $this->id_banca);
		if ($this->isColumnModified(ClientePeer::CALCOLA_RITENUTA_ACCONTO)) $criteria->add(ClientePeer::CALCOLA_RITENUTA_ACCONTO, $this->calcola_ritenuta_acconto);
		if ($this->isColumnModified(ClientePeer::INCLUDI_TASSE)) $criteria->add(ClientePeer::INCLUDI_TASSE, $this->includi_tasse);
		if ($this->isColumnModified(ClientePeer::CALCOLA_TASSE)) $criteria->add(ClientePeer::CALCOLA_TASSE, $this->calcola_tasse);
		if ($this->isColumnModified(ClientePeer::COD)) $criteria->add(ClientePeer::COD, $this->cod);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ClientePeer::DATABASE_NAME);

		$criteria->add(ClientePeer::ID, $this->id);

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

		$copyObj->setAzienda($this->azienda);

		$copyObj->setRagioneSociale($this->ragione_sociale);

		$copyObj->setVia($this->via);

		$copyObj->setCitta($this->citta);

		$copyObj->setProvincia($this->provincia);

		$copyObj->setCap($this->cap);

		$copyObj->setPiva($this->piva);

		$copyObj->setCf($this->cf);

		$copyObj->setCognome($this->cognome);

		$copyObj->setNome($this->nome);

		$copyObj->setTelefono($this->telefono);

		$copyObj->setFax($this->fax);

		$copyObj->setCellulare($this->cellulare);

		$copyObj->setEmail($this->email);

		$copyObj->setModoPagamentoId($this->modo_pagamento_id);

		$copyObj->setStato($this->stato);

		$copyObj->setNote($this->note);

		$copyObj->setIdTemaFattura($this->id_tema_fattura);

		$copyObj->setIdBanca($this->id_banca);

		$copyObj->setCalcolaRitenutaAcconto($this->calcola_ritenuta_acconto);

		$copyObj->setIncludiTasse($this->includi_tasse);

		$copyObj->setCalcolaTasse($this->calcola_tasse);

		$copyObj->setCod($this->cod);


		if ($deepCopy) {
									$copyObj->setNew(false);

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
			self::$peer = new ClientePeer();
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
				include_once 'lib/model/om/BaseModoPagamentoPeer.php';

		if ($this->aModoPagamento === null && ($this->modo_pagamento_id !== null)) {

			$this->aModoPagamento = ModoPagamentoPeer::retrieveByPK($this->modo_pagamento_id, $con);

			
		}
		return $this->aModoPagamento;
	}

	
	public function setTemaFattura($v)
	{


		if ($v === null) {
			$this->setIdTemaFattura(NULL);
		} else {
			$this->setIdTemaFattura($v->getId());
		}


		$this->aTemaFattura = $v;
	}


	
	public function getTemaFattura($con = null)
	{
				include_once 'lib/model/om/BaseTemaFatturaPeer.php';

		if ($this->aTemaFattura === null && ($this->id_tema_fattura !== null)) {

			$this->aTemaFattura = TemaFatturaPeer::retrieveByPK($this->id_tema_fattura, $con);

			
		}
		return $this->aTemaFattura;
	}

	
	public function setBanca($v)
	{


		if ($v === null) {
			$this->setIdBanca(NULL);
		} else {
			$this->setIdBanca($v->getId());
		}


		$this->aBanca = $v;
	}


	
	public function getBanca($con = null)
	{
				include_once 'lib/model/om/BaseBancaPeer.php';

		if ($this->aBanca === null && ($this->id_banca !== null)) {

			$this->aBanca = BancaPeer::retrieveByPK($this->id_banca, $con);

			
		}
		return $this->aBanca;
	}

	
	public function initFatturas()
	{
		if ($this->collFatturas === null) {
			$this->collFatturas = array();
		}
	}

	
	public function getFatturas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFatturaPeer.php';
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

				$criteria->add(FatturaPeer::CLIENTE_ID, $this->getId());

				FatturaPeer::addSelectColumns($criteria);
				$this->collFatturas = FatturaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FatturaPeer::CLIENTE_ID, $this->getId());

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
				include_once 'lib/model/om/BaseFatturaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FatturaPeer::CLIENTE_ID, $this->getId());

		return FatturaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFattura(Fattura $l)
	{
		$this->collFatturas[] = $l;
		$l->setCliente($this);
	}


	
	public function getFatturasJoinUtente($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFatturaPeer.php';
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

				$criteria->add(FatturaPeer::CLIENTE_ID, $this->getId());

				$this->collFatturas = FatturaPeer::doSelectJoinUtente($criteria, $con);
			}
		} else {
									
			$criteria->add(FatturaPeer::CLIENTE_ID, $this->getId());

			if (!isset($this->lastFatturaCriteria) || !$this->lastFatturaCriteria->equals($criteria)) {
				$this->collFatturas = FatturaPeer::doSelectJoinUtente($criteria, $con);
			}
		}
		$this->lastFatturaCriteria = $criteria;

		return $this->collFatturas;
	}


	
	public function getFatturasJoinModoPagamento($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFatturaPeer.php';
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

				$criteria->add(FatturaPeer::CLIENTE_ID, $this->getId());

				$this->collFatturas = FatturaPeer::doSelectJoinModoPagamento($criteria, $con);
			}
		} else {
									
			$criteria->add(FatturaPeer::CLIENTE_ID, $this->getId());

			if (!isset($this->lastFatturaCriteria) || !$this->lastFatturaCriteria->equals($criteria)) {
				$this->collFatturas = FatturaPeer::doSelectJoinModoPagamento($criteria, $con);
			}
		}
		$this->lastFatturaCriteria = $criteria;

		return $this->collFatturas;
	}

} 