<?php


abstract class BaseUtente extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $id_invitation_code;


	
	protected $username = 'null';


	
	protected $nome = 'null';


	
	protected $cognome = 'null';


	
	protected $ragione_sociale = 'null';


	
	protected $partita_iva = 'null';


	
	protected $codice_fiscale = 'null';


	
	protected $email = 'null';


	
	protected $password = 'null';


	
	protected $data_attivazione = 943948800;


	
	protected $data_rinnovo = 943948800;


	
	protected $tipo = 'demo';


	
	protected $stato = 'attivo';


	
	protected $fattura = '';


	
	protected $lastlogin = 943948800;


	
	protected $approva_contratto = 0;


	
	protected $approva_policy = 0;


	
	protected $sconto = 0;

	
	protected $collBancas;

	
	protected $lastBancaCriteria = null;

	
	protected $collBugs;

	
	protected $lastBugCriteria = null;

	
	protected $collClientes;

	
	protected $lastClienteCriteria = null;

	
	protected $collCodiceIvas;

	
	protected $lastCodiceIvaCriteria = null;

	
	protected $collFatturas;

	
	protected $lastFatturaCriteria = null;

	
	protected $collImpostaziones;

	
	protected $lastImpostazioneCriteria = null;

	
	protected $collModoPagamentos;

	
	protected $lastModoPagamentoCriteria = null;

	
	protected $collProdottos;

	
	protected $lastProdottoCriteria = null;

	
	protected $collTagsFatturas;

	
	protected $lastTagsFatturaCriteria = null;

	
	protected $collTassas;

	
	protected $lastTassaCriteria = null;

	
	protected $collTemaFatturas;

	
	protected $lastTemaFatturaCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getIdInvitationCode()
	{

		return $this->id_invitation_code;
	}

	
	public function getUsername()
	{

		return $this->username;
	}

	
	public function getNome()
	{

		return $this->nome;
	}

	
	public function getCognome()
	{

		return $this->cognome;
	}

	
	public function getRagioneSociale()
	{

		return $this->ragione_sociale;
	}

	
	public function getPartitaIva()
	{

		return $this->partita_iva;
	}

	
	public function getCodiceFiscale()
	{

		return $this->codice_fiscale;
	}

	
	public function getEmail()
	{

		return $this->email;
	}

	
	public function getPassword()
	{

		return $this->password;
	}

	
	public function getDataAttivazione($format = 'Y-m-d')
	{

		if ($this->data_attivazione === null || $this->data_attivazione === '') {
			return null;
		} elseif (!is_int($this->data_attivazione)) {
						$ts = strtotime($this->data_attivazione);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [data_attivazione] as date/time value: " . var_export($this->data_attivazione, true));
			}
		} else {
			$ts = $this->data_attivazione;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getDataRinnovo($format = 'Y-m-d')
	{

		if ($this->data_rinnovo === null || $this->data_rinnovo === '') {
			return null;
		} elseif (!is_int($this->data_rinnovo)) {
						$ts = strtotime($this->data_rinnovo);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [data_rinnovo] as date/time value: " . var_export($this->data_rinnovo, true));
			}
		} else {
			$ts = $this->data_rinnovo;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getTipo()
	{

		return $this->tipo;
	}

	
	public function getStato()
	{

		return $this->stato;
	}

	
	public function getFattura()
	{

		return $this->fattura;
	}

	
	public function getLastlogin($format = 'Y-m-d H:i:s')
	{

		if ($this->lastlogin === null || $this->lastlogin === '') {
			return null;
		} elseif (!is_int($this->lastlogin)) {
						$ts = strtotime($this->lastlogin);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [lastlogin] as date/time value: " . var_export($this->lastlogin, true));
			}
		} else {
			$ts = $this->lastlogin;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getApprovaContratto()
	{

		return $this->approva_contratto;
	}

	
	public function getApprovaPolicy()
	{

		return $this->approva_policy;
	}

	
	public function getSconto()
	{

		return $this->sconto;
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = UtentePeer::ID;
		}

	} 
	
	public function setIdInvitationCode($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_invitation_code !== $v) {
			$this->id_invitation_code = $v;
			$this->modifiedColumns[] = UtentePeer::ID_INVITATION_CODE;
		}

	} 
	
	public function setUsername($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->username !== $v || $v === 'null') {
			$this->username = $v;
			$this->modifiedColumns[] = UtentePeer::USERNAME;
		}

	} 
	
	public function setNome($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nome !== $v || $v === 'null') {
			$this->nome = $v;
			$this->modifiedColumns[] = UtentePeer::NOME;
		}

	} 
	
	public function setCognome($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cognome !== $v || $v === 'null') {
			$this->cognome = $v;
			$this->modifiedColumns[] = UtentePeer::COGNOME;
		}

	} 
	
	public function setRagioneSociale($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ragione_sociale !== $v || $v === 'null') {
			$this->ragione_sociale = $v;
			$this->modifiedColumns[] = UtentePeer::RAGIONE_SOCIALE;
		}

	} 
	
	public function setPartitaIva($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->partita_iva !== $v || $v === 'null') {
			$this->partita_iva = $v;
			$this->modifiedColumns[] = UtentePeer::PARTITA_IVA;
		}

	} 
	
	public function setCodiceFiscale($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->codice_fiscale !== $v || $v === 'null') {
			$this->codice_fiscale = $v;
			$this->modifiedColumns[] = UtentePeer::CODICE_FISCALE;
		}

	} 
	
	public function setEmail($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->email !== $v || $v === 'null') {
			$this->email = $v;
			$this->modifiedColumns[] = UtentePeer::EMAIL;
		}

	} 
	
	public function setPassword($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->password !== $v || $v === 'null') {
			$this->password = $v;
			$this->modifiedColumns[] = UtentePeer::PASSWORD;
		}

	} 
	
	public function setDataAttivazione($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [data_attivazione] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->data_attivazione !== $ts || $ts === 943948800) {
			$this->data_attivazione = $ts;
			$this->modifiedColumns[] = UtentePeer::DATA_ATTIVAZIONE;
		}

	} 
	
	public function setDataRinnovo($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [data_rinnovo] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->data_rinnovo !== $ts || $ts === 943948800) {
			$this->data_rinnovo = $ts;
			$this->modifiedColumns[] = UtentePeer::DATA_RINNOVO;
		}

	} 
	
	public function setTipo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tipo !== $v || $v === 'demo') {
			$this->tipo = $v;
			$this->modifiedColumns[] = UtentePeer::TIPO;
		}

	} 
	
	public function setStato($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->stato !== $v || $v === 'attivo') {
			$this->stato = $v;
			$this->modifiedColumns[] = UtentePeer::STATO;
		}

	} 
	
	public function setFattura($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->fattura !== $v || $v === '') {
			$this->fattura = $v;
			$this->modifiedColumns[] = UtentePeer::FATTURA;
		}

	} 
	
	public function setLastlogin($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [lastlogin] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->lastlogin !== $ts || $ts === 943948800) {
			$this->lastlogin = $ts;
			$this->modifiedColumns[] = UtentePeer::LASTLOGIN;
		}

	} 
	
	public function setApprovaContratto($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->approva_contratto !== $v || $v === 0) {
			$this->approva_contratto = $v;
			$this->modifiedColumns[] = UtentePeer::APPROVA_CONTRATTO;
		}

	} 
	
	public function setApprovaPolicy($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->approva_policy !== $v || $v === 0) {
			$this->approva_policy = $v;
			$this->modifiedColumns[] = UtentePeer::APPROVA_POLICY;
		}

	} 
	
	public function setSconto($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sconto !== $v || $v === 0) {
			$this->sconto = $v;
			$this->modifiedColumns[] = UtentePeer::SCONTO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->id_invitation_code = $rs->getInt($startcol + 1);

			$this->username = $rs->getString($startcol + 2);

			$this->nome = $rs->getString($startcol + 3);

			$this->cognome = $rs->getString($startcol + 4);

			$this->ragione_sociale = $rs->getString($startcol + 5);

			$this->partita_iva = $rs->getString($startcol + 6);

			$this->codice_fiscale = $rs->getString($startcol + 7);

			$this->email = $rs->getString($startcol + 8);

			$this->password = $rs->getString($startcol + 9);

			$this->data_attivazione = $rs->getDate($startcol + 10, null);

			$this->data_rinnovo = $rs->getDate($startcol + 11, null);

			$this->tipo = $rs->getString($startcol + 12);

			$this->stato = $rs->getString($startcol + 13);

			$this->fattura = $rs->getString($startcol + 14);

			$this->lastlogin = $rs->getTimestamp($startcol + 15, null);

			$this->approva_contratto = $rs->getInt($startcol + 16);

			$this->approva_policy = $rs->getInt($startcol + 17);

			$this->sconto = $rs->getInt($startcol + 18);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 19; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Utente object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UtentePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UtentePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(UtentePeer::DATABASE_NAME);
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
					$pk = UtentePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += UtentePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collBancas !== null) {
				foreach($this->collBancas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collBugs !== null) {
				foreach($this->collBugs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collClientes !== null) {
				foreach($this->collClientes as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCodiceIvas !== null) {
				foreach($this->collCodiceIvas as $referrerFK) {
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

			if ($this->collImpostaziones !== null) {
				foreach($this->collImpostaziones as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collModoPagamentos !== null) {
				foreach($this->collModoPagamentos as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collProdottos !== null) {
				foreach($this->collProdottos as $referrerFK) {
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

			if ($this->collTassas !== null) {
				foreach($this->collTassas as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collTemaFatturas !== null) {
				foreach($this->collTemaFatturas as $referrerFK) {
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


			if (($retval = UtentePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collBancas !== null) {
					foreach($this->collBancas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collBugs !== null) {
					foreach($this->collBugs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collClientes !== null) {
					foreach($this->collClientes as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCodiceIvas !== null) {
					foreach($this->collCodiceIvas as $referrerFK) {
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

				if ($this->collImpostaziones !== null) {
					foreach($this->collImpostaziones as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collModoPagamentos !== null) {
					foreach($this->collModoPagamentos as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collProdottos !== null) {
					foreach($this->collProdottos as $referrerFK) {
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

				if ($this->collTassas !== null) {
					foreach($this->collTassas as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collTemaFatturas !== null) {
					foreach($this->collTemaFatturas as $referrerFK) {
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
		$pos = UtentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getIdInvitationCode();
				break;
			case 2:
				return $this->getUsername();
				break;
			case 3:
				return $this->getNome();
				break;
			case 4:
				return $this->getCognome();
				break;
			case 5:
				return $this->getRagioneSociale();
				break;
			case 6:
				return $this->getPartitaIva();
				break;
			case 7:
				return $this->getCodiceFiscale();
				break;
			case 8:
				return $this->getEmail();
				break;
			case 9:
				return $this->getPassword();
				break;
			case 10:
				return $this->getDataAttivazione();
				break;
			case 11:
				return $this->getDataRinnovo();
				break;
			case 12:
				return $this->getTipo();
				break;
			case 13:
				return $this->getStato();
				break;
			case 14:
				return $this->getFattura();
				break;
			case 15:
				return $this->getLastlogin();
				break;
			case 16:
				return $this->getApprovaContratto();
				break;
			case 17:
				return $this->getApprovaPolicy();
				break;
			case 18:
				return $this->getSconto();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UtentePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIdInvitationCode(),
			$keys[2] => $this->getUsername(),
			$keys[3] => $this->getNome(),
			$keys[4] => $this->getCognome(),
			$keys[5] => $this->getRagioneSociale(),
			$keys[6] => $this->getPartitaIva(),
			$keys[7] => $this->getCodiceFiscale(),
			$keys[8] => $this->getEmail(),
			$keys[9] => $this->getPassword(),
			$keys[10] => $this->getDataAttivazione(),
			$keys[11] => $this->getDataRinnovo(),
			$keys[12] => $this->getTipo(),
			$keys[13] => $this->getStato(),
			$keys[14] => $this->getFattura(),
			$keys[15] => $this->getLastlogin(),
			$keys[16] => $this->getApprovaContratto(),
			$keys[17] => $this->getApprovaPolicy(),
			$keys[18] => $this->getSconto(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UtentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setIdInvitationCode($value);
				break;
			case 2:
				$this->setUsername($value);
				break;
			case 3:
				$this->setNome($value);
				break;
			case 4:
				$this->setCognome($value);
				break;
			case 5:
				$this->setRagioneSociale($value);
				break;
			case 6:
				$this->setPartitaIva($value);
				break;
			case 7:
				$this->setCodiceFiscale($value);
				break;
			case 8:
				$this->setEmail($value);
				break;
			case 9:
				$this->setPassword($value);
				break;
			case 10:
				$this->setDataAttivazione($value);
				break;
			case 11:
				$this->setDataRinnovo($value);
				break;
			case 12:
				$this->setTipo($value);
				break;
			case 13:
				$this->setStato($value);
				break;
			case 14:
				$this->setFattura($value);
				break;
			case 15:
				$this->setLastlogin($value);
				break;
			case 16:
				$this->setApprovaContratto($value);
				break;
			case 17:
				$this->setApprovaPolicy($value);
				break;
			case 18:
				$this->setSconto($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UtentePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIdInvitationCode($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUsername($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNome($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setCognome($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setRagioneSociale($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPartitaIva($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCodiceFiscale($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEmail($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setPassword($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setDataAttivazione($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setDataRinnovo($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setTipo($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setStato($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setFattura($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setLastlogin($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setApprovaContratto($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setApprovaPolicy($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setSconto($arr[$keys[18]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UtentePeer::DATABASE_NAME);

		if ($this->isColumnModified(UtentePeer::ID)) $criteria->add(UtentePeer::ID, $this->id);
		if ($this->isColumnModified(UtentePeer::ID_INVITATION_CODE)) $criteria->add(UtentePeer::ID_INVITATION_CODE, $this->id_invitation_code);
		if ($this->isColumnModified(UtentePeer::USERNAME)) $criteria->add(UtentePeer::USERNAME, $this->username);
		if ($this->isColumnModified(UtentePeer::NOME)) $criteria->add(UtentePeer::NOME, $this->nome);
		if ($this->isColumnModified(UtentePeer::COGNOME)) $criteria->add(UtentePeer::COGNOME, $this->cognome);
		if ($this->isColumnModified(UtentePeer::RAGIONE_SOCIALE)) $criteria->add(UtentePeer::RAGIONE_SOCIALE, $this->ragione_sociale);
		if ($this->isColumnModified(UtentePeer::PARTITA_IVA)) $criteria->add(UtentePeer::PARTITA_IVA, $this->partita_iva);
		if ($this->isColumnModified(UtentePeer::CODICE_FISCALE)) $criteria->add(UtentePeer::CODICE_FISCALE, $this->codice_fiscale);
		if ($this->isColumnModified(UtentePeer::EMAIL)) $criteria->add(UtentePeer::EMAIL, $this->email);
		if ($this->isColumnModified(UtentePeer::PASSWORD)) $criteria->add(UtentePeer::PASSWORD, $this->password);
		if ($this->isColumnModified(UtentePeer::DATA_ATTIVAZIONE)) $criteria->add(UtentePeer::DATA_ATTIVAZIONE, $this->data_attivazione);
		if ($this->isColumnModified(UtentePeer::DATA_RINNOVO)) $criteria->add(UtentePeer::DATA_RINNOVO, $this->data_rinnovo);
		if ($this->isColumnModified(UtentePeer::TIPO)) $criteria->add(UtentePeer::TIPO, $this->tipo);
		if ($this->isColumnModified(UtentePeer::STATO)) $criteria->add(UtentePeer::STATO, $this->stato);
		if ($this->isColumnModified(UtentePeer::FATTURA)) $criteria->add(UtentePeer::FATTURA, $this->fattura);
		if ($this->isColumnModified(UtentePeer::LASTLOGIN)) $criteria->add(UtentePeer::LASTLOGIN, $this->lastlogin);
		if ($this->isColumnModified(UtentePeer::APPROVA_CONTRATTO)) $criteria->add(UtentePeer::APPROVA_CONTRATTO, $this->approva_contratto);
		if ($this->isColumnModified(UtentePeer::APPROVA_POLICY)) $criteria->add(UtentePeer::APPROVA_POLICY, $this->approva_policy);
		if ($this->isColumnModified(UtentePeer::SCONTO)) $criteria->add(UtentePeer::SCONTO, $this->sconto);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UtentePeer::DATABASE_NAME);

		$criteria->add(UtentePeer::ID, $this->id);

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

		$copyObj->setIdInvitationCode($this->id_invitation_code);

		$copyObj->setUsername($this->username);

		$copyObj->setNome($this->nome);

		$copyObj->setCognome($this->cognome);

		$copyObj->setRagioneSociale($this->ragione_sociale);

		$copyObj->setPartitaIva($this->partita_iva);

		$copyObj->setCodiceFiscale($this->codice_fiscale);

		$copyObj->setEmail($this->email);

		$copyObj->setPassword($this->password);

		$copyObj->setDataAttivazione($this->data_attivazione);

		$copyObj->setDataRinnovo($this->data_rinnovo);

		$copyObj->setTipo($this->tipo);

		$copyObj->setStato($this->stato);

		$copyObj->setFattura($this->fattura);

		$copyObj->setLastlogin($this->lastlogin);

		$copyObj->setApprovaContratto($this->approva_contratto);

		$copyObj->setApprovaPolicy($this->approva_policy);

		$copyObj->setSconto($this->sconto);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getBancas() as $relObj) {
				$copyObj->addBanca($relObj->copy($deepCopy));
			}

			foreach($this->getBugs() as $relObj) {
				$copyObj->addBug($relObj->copy($deepCopy));
			}

			foreach($this->getClientes() as $relObj) {
				$copyObj->addCliente($relObj->copy($deepCopy));
			}

			foreach($this->getCodiceIvas() as $relObj) {
				$copyObj->addCodiceIva($relObj->copy($deepCopy));
			}

			foreach($this->getFatturas() as $relObj) {
				$copyObj->addFattura($relObj->copy($deepCopy));
			}

			foreach($this->getImpostaziones() as $relObj) {
				$copyObj->addImpostazione($relObj->copy($deepCopy));
			}

			foreach($this->getModoPagamentos() as $relObj) {
				$copyObj->addModoPagamento($relObj->copy($deepCopy));
			}

			foreach($this->getProdottos() as $relObj) {
				$copyObj->addProdotto($relObj->copy($deepCopy));
			}

			foreach($this->getTagsFatturas() as $relObj) {
				$copyObj->addTagsFattura($relObj->copy($deepCopy));
			}

			foreach($this->getTassas() as $relObj) {
				$copyObj->addTassa($relObj->copy($deepCopy));
			}

			foreach($this->getTemaFatturas() as $relObj) {
				$copyObj->addTemaFattura($relObj->copy($deepCopy));
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
			self::$peer = new UtentePeer();
		}
		return self::$peer;
	}

	
	public function initBancas()
	{
		if ($this->collBancas === null) {
			$this->collBancas = array();
		}
	}

	
	public function getBancas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBancaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBancas === null) {
			if ($this->isNew()) {
			   $this->collBancas = array();
			} else {

				$criteria->add(BancaPeer::ID_UTENTE, $this->getId());

				BancaPeer::addSelectColumns($criteria);
				$this->collBancas = BancaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BancaPeer::ID_UTENTE, $this->getId());

				BancaPeer::addSelectColumns($criteria);
				if (!isset($this->lastBancaCriteria) || !$this->lastBancaCriteria->equals($criteria)) {
					$this->collBancas = BancaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBancaCriteria = $criteria;
		return $this->collBancas;
	}

	
	public function countBancas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseBancaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(BancaPeer::ID_UTENTE, $this->getId());

		return BancaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBanca(Banca $l)
	{
		$this->collBancas[] = $l;
		$l->setUtente($this);
	}

	
	public function initBugs()
	{
		if ($this->collBugs === null) {
			$this->collBugs = array();
		}
	}

	
	public function getBugs($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseBugPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collBugs === null) {
			if ($this->isNew()) {
			   $this->collBugs = array();
			} else {

				$criteria->add(BugPeer::ID_UTENTE, $this->getId());

				BugPeer::addSelectColumns($criteria);
				$this->collBugs = BugPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(BugPeer::ID_UTENTE, $this->getId());

				BugPeer::addSelectColumns($criteria);
				if (!isset($this->lastBugCriteria) || !$this->lastBugCriteria->equals($criteria)) {
					$this->collBugs = BugPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastBugCriteria = $criteria;
		return $this->collBugs;
	}

	
	public function countBugs($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseBugPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(BugPeer::ID_UTENTE, $this->getId());

		return BugPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addBug(Bug $l)
	{
		$this->collBugs[] = $l;
		$l->setUtente($this);
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

				$criteria->add(ClientePeer::ID_UTENTE, $this->getId());

				ClientePeer::addSelectColumns($criteria);
				$this->collClientes = ClientePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ClientePeer::ID_UTENTE, $this->getId());

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

		$criteria->add(ClientePeer::ID_UTENTE, $this->getId());

		return ClientePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCliente(Cliente $l)
	{
		$this->collClientes[] = $l;
		$l->setUtente($this);
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

				$criteria->add(ClientePeer::ID_UTENTE, $this->getId());

				$this->collClientes = ClientePeer::doSelectJoinModoPagamento($criteria, $con);
			}
		} else {
									
			$criteria->add(ClientePeer::ID_UTENTE, $this->getId());

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

				$criteria->add(ClientePeer::ID_UTENTE, $this->getId());

				$this->collClientes = ClientePeer::doSelectJoinTemaFattura($criteria, $con);
			}
		} else {
									
			$criteria->add(ClientePeer::ID_UTENTE, $this->getId());

			if (!isset($this->lastClienteCriteria) || !$this->lastClienteCriteria->equals($criteria)) {
				$this->collClientes = ClientePeer::doSelectJoinTemaFattura($criteria, $con);
			}
		}
		$this->lastClienteCriteria = $criteria;

		return $this->collClientes;
	}


	
	public function getClientesJoinBanca($criteria = null, $con = null)
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

				$criteria->add(ClientePeer::ID_UTENTE, $this->getId());

				$this->collClientes = ClientePeer::doSelectJoinBanca($criteria, $con);
			}
		} else {
									
			$criteria->add(ClientePeer::ID_UTENTE, $this->getId());

			if (!isset($this->lastClienteCriteria) || !$this->lastClienteCriteria->equals($criteria)) {
				$this->collClientes = ClientePeer::doSelectJoinBanca($criteria, $con);
			}
		}
		$this->lastClienteCriteria = $criteria;

		return $this->collClientes;
	}

	
	public function initCodiceIvas()
	{
		if ($this->collCodiceIvas === null) {
			$this->collCodiceIvas = array();
		}
	}

	
	public function getCodiceIvas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseCodiceIvaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCodiceIvas === null) {
			if ($this->isNew()) {
			   $this->collCodiceIvas = array();
			} else {

				$criteria->add(CodiceIvaPeer::ID_UTENTE, $this->getId());

				CodiceIvaPeer::addSelectColumns($criteria);
				$this->collCodiceIvas = CodiceIvaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CodiceIvaPeer::ID_UTENTE, $this->getId());

				CodiceIvaPeer::addSelectColumns($criteria);
				if (!isset($this->lastCodiceIvaCriteria) || !$this->lastCodiceIvaCriteria->equals($criteria)) {
					$this->collCodiceIvas = CodiceIvaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCodiceIvaCriteria = $criteria;
		return $this->collCodiceIvas;
	}

	
	public function countCodiceIvas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseCodiceIvaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CodiceIvaPeer::ID_UTENTE, $this->getId());

		return CodiceIvaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCodiceIva(CodiceIva $l)
	{
		$this->collCodiceIvas[] = $l;
		$l->setUtente($this);
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

				$criteria->add(FatturaPeer::ID_UTENTE, $this->getId());

				FatturaPeer::addSelectColumns($criteria);
				$this->collFatturas = FatturaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FatturaPeer::ID_UTENTE, $this->getId());

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

		$criteria->add(FatturaPeer::ID_UTENTE, $this->getId());

		return FatturaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFattura(Fattura $l)
	{
		$this->collFatturas[] = $l;
		$l->setUtente($this);
	}


	
	public function getFatturasJoinCliente($criteria = null, $con = null)
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

				$criteria->add(FatturaPeer::ID_UTENTE, $this->getId());

				$this->collFatturas = FatturaPeer::doSelectJoinCliente($criteria, $con);
			}
		} else {
									
			$criteria->add(FatturaPeer::ID_UTENTE, $this->getId());

			if (!isset($this->lastFatturaCriteria) || !$this->lastFatturaCriteria->equals($criteria)) {
				$this->collFatturas = FatturaPeer::doSelectJoinCliente($criteria, $con);
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

				$criteria->add(FatturaPeer::ID_UTENTE, $this->getId());

				$this->collFatturas = FatturaPeer::doSelectJoinModoPagamento($criteria, $con);
			}
		} else {
									
			$criteria->add(FatturaPeer::ID_UTENTE, $this->getId());

			if (!isset($this->lastFatturaCriteria) || !$this->lastFatturaCriteria->equals($criteria)) {
				$this->collFatturas = FatturaPeer::doSelectJoinModoPagamento($criteria, $con);
			}
		}
		$this->lastFatturaCriteria = $criteria;

		return $this->collFatturas;
	}

	
	public function initImpostaziones()
	{
		if ($this->collImpostaziones === null) {
			$this->collImpostaziones = array();
		}
	}

	
	public function getImpostaziones($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseImpostazionePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collImpostaziones === null) {
			if ($this->isNew()) {
			   $this->collImpostaziones = array();
			} else {

				$criteria->add(ImpostazionePeer::ID_UTENTE, $this->getId());

				ImpostazionePeer::addSelectColumns($criteria);
				$this->collImpostaziones = ImpostazionePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ImpostazionePeer::ID_UTENTE, $this->getId());

				ImpostazionePeer::addSelectColumns($criteria);
				if (!isset($this->lastImpostazioneCriteria) || !$this->lastImpostazioneCriteria->equals($criteria)) {
					$this->collImpostaziones = ImpostazionePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastImpostazioneCriteria = $criteria;
		return $this->collImpostaziones;
	}

	
	public function countImpostaziones($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseImpostazionePeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ImpostazionePeer::ID_UTENTE, $this->getId());

		return ImpostazionePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addImpostazione(Impostazione $l)
	{
		$this->collImpostaziones[] = $l;
		$l->setUtente($this);
	}

	
	public function initModoPagamentos()
	{
		if ($this->collModoPagamentos === null) {
			$this->collModoPagamentos = array();
		}
	}

	
	public function getModoPagamentos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseModoPagamentoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collModoPagamentos === null) {
			if ($this->isNew()) {
			   $this->collModoPagamentos = array();
			} else {

				$criteria->add(ModoPagamentoPeer::ID_UTENTE, $this->getId());

				ModoPagamentoPeer::addSelectColumns($criteria);
				$this->collModoPagamentos = ModoPagamentoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ModoPagamentoPeer::ID_UTENTE, $this->getId());

				ModoPagamentoPeer::addSelectColumns($criteria);
				if (!isset($this->lastModoPagamentoCriteria) || !$this->lastModoPagamentoCriteria->equals($criteria)) {
					$this->collModoPagamentos = ModoPagamentoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastModoPagamentoCriteria = $criteria;
		return $this->collModoPagamentos;
	}

	
	public function countModoPagamentos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseModoPagamentoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ModoPagamentoPeer::ID_UTENTE, $this->getId());

		return ModoPagamentoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addModoPagamento(ModoPagamento $l)
	{
		$this->collModoPagamentos[] = $l;
		$l->setUtente($this);
	}

	
	public function initProdottos()
	{
		if ($this->collProdottos === null) {
			$this->collProdottos = array();
		}
	}

	
	public function getProdottos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseProdottoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collProdottos === null) {
			if ($this->isNew()) {
			   $this->collProdottos = array();
			} else {

				$criteria->add(ProdottoPeer::ID_UTENTE, $this->getId());

				ProdottoPeer::addSelectColumns($criteria);
				$this->collProdottos = ProdottoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ProdottoPeer::ID_UTENTE, $this->getId());

				ProdottoPeer::addSelectColumns($criteria);
				if (!isset($this->lastProdottoCriteria) || !$this->lastProdottoCriteria->equals($criteria)) {
					$this->collProdottos = ProdottoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastProdottoCriteria = $criteria;
		return $this->collProdottos;
	}

	
	public function countProdottos($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseProdottoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ProdottoPeer::ID_UTENTE, $this->getId());

		return ProdottoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addProdotto(Prodotto $l)
	{
		$this->collProdottos[] = $l;
		$l->setUtente($this);
	}

	
	public function initTagsFatturas()
	{
		if ($this->collTagsFatturas === null) {
			$this->collTagsFatturas = array();
		}
	}

	
	public function getTagsFatturas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTagsFatturaPeer.php';
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

				$criteria->add(TagsFatturaPeer::ID_UTENTE, $this->getId());

				TagsFatturaPeer::addSelectColumns($criteria);
				$this->collTagsFatturas = TagsFatturaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TagsFatturaPeer::ID_UTENTE, $this->getId());

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
				include_once 'lib/model/om/BaseTagsFatturaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TagsFatturaPeer::ID_UTENTE, $this->getId());

		return TagsFatturaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTagsFattura(TagsFattura $l)
	{
		$this->collTagsFatturas[] = $l;
		$l->setUtente($this);
	}


	
	public function getTagsFatturasJoinFattura($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTagsFatturaPeer.php';
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

				$criteria->add(TagsFatturaPeer::ID_UTENTE, $this->getId());

				$this->collTagsFatturas = TagsFatturaPeer::doSelectJoinFattura($criteria, $con);
			}
		} else {
									
			$criteria->add(TagsFatturaPeer::ID_UTENTE, $this->getId());

			if (!isset($this->lastTagsFatturaCriteria) || !$this->lastTagsFatturaCriteria->equals($criteria)) {
				$this->collTagsFatturas = TagsFatturaPeer::doSelectJoinFattura($criteria, $con);
			}
		}
		$this->lastTagsFatturaCriteria = $criteria;

		return $this->collTagsFatturas;
	}

	
	public function initTassas()
	{
		if ($this->collTassas === null) {
			$this->collTassas = array();
		}
	}

	
	public function getTassas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTassaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTassas === null) {
			if ($this->isNew()) {
			   $this->collTassas = array();
			} else {

				$criteria->add(TassaPeer::ID_UTENTE, $this->getId());

				TassaPeer::addSelectColumns($criteria);
				$this->collTassas = TassaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TassaPeer::ID_UTENTE, $this->getId());

				TassaPeer::addSelectColumns($criteria);
				if (!isset($this->lastTassaCriteria) || !$this->lastTassaCriteria->equals($criteria)) {
					$this->collTassas = TassaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTassaCriteria = $criteria;
		return $this->collTassas;
	}

	
	public function countTassas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTassaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TassaPeer::ID_UTENTE, $this->getId());

		return TassaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTassa(Tassa $l)
	{
		$this->collTassas[] = $l;
		$l->setUtente($this);
	}

	
	public function initTemaFatturas()
	{
		if ($this->collTemaFatturas === null) {
			$this->collTemaFatturas = array();
		}
	}

	
	public function getTemaFatturas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseTemaFatturaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collTemaFatturas === null) {
			if ($this->isNew()) {
			   $this->collTemaFatturas = array();
			} else {

				$criteria->add(TemaFatturaPeer::ID_UTENTE, $this->getId());

				TemaFatturaPeer::addSelectColumns($criteria);
				$this->collTemaFatturas = TemaFatturaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(TemaFatturaPeer::ID_UTENTE, $this->getId());

				TemaFatturaPeer::addSelectColumns($criteria);
				if (!isset($this->lastTemaFatturaCriteria) || !$this->lastTemaFatturaCriteria->equals($criteria)) {
					$this->collTemaFatturas = TemaFatturaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastTemaFatturaCriteria = $criteria;
		return $this->collTemaFatturas;
	}

	
	public function countTemaFatturas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseTemaFatturaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(TemaFatturaPeer::ID_UTENTE, $this->getId());

		return TemaFatturaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addTemaFattura(TemaFattura $l)
	{
		$this->collTemaFatturas[] = $l;
		$l->setUtente($this);
	}

} 