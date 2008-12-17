<?php


abstract class BaseImpostazione extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id_utente = 0;


	
	protected $num_clienti = 20;


	
	protected $num_fatture = 20;


	
	protected $righe_dettagli = 5;


	
	protected $ritenuta_acconto = '20/100';


	
	protected $tipo_ritenuta = 'debito';


	
	protected $riepilogo_home = '';


	
	protected $consegna_commercialista = '';


	
	protected $deposita_iva = '';


	
	protected $fattura_automatica = 's';


	
	protected $codice_cliente = '';


	
	protected $label_imponibile = 'Imponibile';


	
	protected $label_spese = 'Spese Anticipate';


	
	protected $label_imponibile_iva = 'Imponibile ai fini iva';


	
	protected $label_iva = 'Iva';


	
	protected $label_totale_fattura = 'Totale Fattura';


	
	protected $label_ritenuta_acconto = 'Ritenuta d\'acconto';


	
	protected $label_netto_liquidare = 'Netto da liquidare';


	
	protected $label_quantita = 'Qty';


	
	protected $label_descrizione = 'Descrizione';


	
	protected $label_prezzo_singolo = 'Prezzo Singolo';


	
	protected $label_prezzo_totale = 'Prezzo Totale';


	
	protected $label_sconto = 'Sconto';

	
	protected $aUtente;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIdUtente()
	{

		return $this->id_utente;
	}

	
	public function getNumClienti()
	{

		return $this->num_clienti;
	}

	
	public function getNumFatture()
	{

		return $this->num_fatture;
	}

	
	public function getRigheDettagli()
	{

		return $this->righe_dettagli;
	}

	
	public function getRitenutaAcconto()
	{

		return $this->ritenuta_acconto;
	}

	
	public function getTipoRitenuta()
	{

		return $this->tipo_ritenuta;
	}

	
	public function getRiepilogoHome()
	{

		return $this->riepilogo_home;
	}

	
	public function getConsegnaCommercialista()
	{

		return $this->consegna_commercialista;
	}

	
	public function getDepositaIva()
	{

		return $this->deposita_iva;
	}

	
	public function getFatturaAutomatica()
	{

		return $this->fattura_automatica;
	}

	
	public function getCodiceCliente()
	{

		return $this->codice_cliente;
	}

	
	public function getLabelImponibile()
	{

		return $this->label_imponibile;
	}

	
	public function getLabelSpese()
	{

		return $this->label_spese;
	}

	
	public function getLabelImponibileIva()
	{

		return $this->label_imponibile_iva;
	}

	
	public function getLabelIva()
	{

		return $this->label_iva;
	}

	
	public function getLabelTotaleFattura()
	{

		return $this->label_totale_fattura;
	}

	
	public function getLabelRitenutaAcconto()
	{

		return $this->label_ritenuta_acconto;
	}

	
	public function getLabelNettoLiquidare()
	{

		return $this->label_netto_liquidare;
	}

	
	public function getLabelQuantita()
	{

		return $this->label_quantita;
	}

	
	public function getLabelDescrizione()
	{

		return $this->label_descrizione;
	}

	
	public function getLabelPrezzoSingolo()
	{

		return $this->label_prezzo_singolo;
	}

	
	public function getLabelPrezzoTotale()
	{

		return $this->label_prezzo_totale;
	}

	
	public function getLabelSconto()
	{

		return $this->label_sconto;
	}

	
	public function setIdUtente($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id_utente !== $v || $v === 0) {
			$this->id_utente = $v;
			$this->modifiedColumns[] = ImpostazionePeer::ID_UTENTE;
		}

		if ($this->aUtente !== null && $this->aUtente->getId() !== $v) {
			$this->aUtente = null;
		}

	} 
	
	public function setNumClienti($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->num_clienti !== $v || $v === 20) {
			$this->num_clienti = $v;
			$this->modifiedColumns[] = ImpostazionePeer::NUM_CLIENTI;
		}

	} 
	
	public function setNumFatture($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->num_fatture !== $v || $v === 20) {
			$this->num_fatture = $v;
			$this->modifiedColumns[] = ImpostazionePeer::NUM_FATTURE;
		}

	} 
	
	public function setRigheDettagli($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->righe_dettagli !== $v || $v === 5) {
			$this->righe_dettagli = $v;
			$this->modifiedColumns[] = ImpostazionePeer::RIGHE_DETTAGLI;
		}

	} 
	
	public function setRitenutaAcconto($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ritenuta_acconto !== $v || $v === '20/100') {
			$this->ritenuta_acconto = $v;
			$this->modifiedColumns[] = ImpostazionePeer::RITENUTA_ACCONTO;
		}

	} 
	
	public function setTipoRitenuta($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->tipo_ritenuta !== $v || $v === 'debito') {
			$this->tipo_ritenuta = $v;
			$this->modifiedColumns[] = ImpostazionePeer::TIPO_RITENUTA;
		}

	} 
	
	public function setRiepilogoHome($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->riepilogo_home !== $v || $v === '') {
			$this->riepilogo_home = $v;
			$this->modifiedColumns[] = ImpostazionePeer::RIEPILOGO_HOME;
		}

	} 
	
	public function setConsegnaCommercialista($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->consegna_commercialista !== $v || $v === '') {
			$this->consegna_commercialista = $v;
			$this->modifiedColumns[] = ImpostazionePeer::CONSEGNA_COMMERCIALISTA;
		}

	} 
	
	public function setDepositaIva($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->deposita_iva !== $v || $v === '') {
			$this->deposita_iva = $v;
			$this->modifiedColumns[] = ImpostazionePeer::DEPOSITA_IVA;
		}

	} 
	
	public function setFatturaAutomatica($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->fattura_automatica !== $v || $v === 's') {
			$this->fattura_automatica = $v;
			$this->modifiedColumns[] = ImpostazionePeer::FATTURA_AUTOMATICA;
		}

	} 
	
	public function setCodiceCliente($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->codice_cliente !== $v || $v === '') {
			$this->codice_cliente = $v;
			$this->modifiedColumns[] = ImpostazionePeer::CODICE_CLIENTE;
		}

	} 
	
	public function setLabelImponibile($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_imponibile !== $v || $v === 'Imponibile') {
			$this->label_imponibile = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_IMPONIBILE;
		}

	} 
	
	public function setLabelSpese($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_spese !== $v || $v === 'Spese Anticipate') {
			$this->label_spese = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_SPESE;
		}

	} 
	
	public function setLabelImponibileIva($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_imponibile_iva !== $v || $v === 'Imponibile ai fini iva') {
			$this->label_imponibile_iva = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_IMPONIBILE_IVA;
		}

	} 
	
	public function setLabelIva($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_iva !== $v || $v === 'Iva') {
			$this->label_iva = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_IVA;
		}

	} 
	
	public function setLabelTotaleFattura($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_totale_fattura !== $v || $v === 'Totale Fattura') {
			$this->label_totale_fattura = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_TOTALE_FATTURA;
		}

	} 
	
	public function setLabelRitenutaAcconto($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_ritenuta_acconto !== $v || $v === 'Ritenuta d\'acconto') {
			$this->label_ritenuta_acconto = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_RITENUTA_ACCONTO;
		}

	} 
	
	public function setLabelNettoLiquidare($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_netto_liquidare !== $v || $v === 'Netto da liquidare') {
			$this->label_netto_liquidare = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_NETTO_LIQUIDARE;
		}

	} 
	
	public function setLabelQuantita($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_quantita !== $v || $v === 'Qty') {
			$this->label_quantita = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_QUANTITA;
		}

	} 
	
	public function setLabelDescrizione($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_descrizione !== $v || $v === 'Descrizione') {
			$this->label_descrizione = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_DESCRIZIONE;
		}

	} 
	
	public function setLabelPrezzoSingolo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_prezzo_singolo !== $v || $v === 'Prezzo Singolo') {
			$this->label_prezzo_singolo = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_PREZZO_SINGOLO;
		}

	} 
	
	public function setLabelPrezzoTotale($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_prezzo_totale !== $v || $v === 'Prezzo Totale') {
			$this->label_prezzo_totale = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_PREZZO_TOTALE;
		}

	} 
	
	public function setLabelSconto($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->label_sconto !== $v || $v === 'Sconto') {
			$this->label_sconto = $v;
			$this->modifiedColumns[] = ImpostazionePeer::LABEL_SCONTO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id_utente = $rs->getInt($startcol + 0);

			$this->num_clienti = $rs->getInt($startcol + 1);

			$this->num_fatture = $rs->getInt($startcol + 2);

			$this->righe_dettagli = $rs->getInt($startcol + 3);

			$this->ritenuta_acconto = $rs->getString($startcol + 4);

			$this->tipo_ritenuta = $rs->getString($startcol + 5);

			$this->riepilogo_home = $rs->getString($startcol + 6);

			$this->consegna_commercialista = $rs->getString($startcol + 7);

			$this->deposita_iva = $rs->getString($startcol + 8);

			$this->fattura_automatica = $rs->getString($startcol + 9);

			$this->codice_cliente = $rs->getString($startcol + 10);

			$this->label_imponibile = $rs->getString($startcol + 11);

			$this->label_spese = $rs->getString($startcol + 12);

			$this->label_imponibile_iva = $rs->getString($startcol + 13);

			$this->label_iva = $rs->getString($startcol + 14);

			$this->label_totale_fattura = $rs->getString($startcol + 15);

			$this->label_ritenuta_acconto = $rs->getString($startcol + 16);

			$this->label_netto_liquidare = $rs->getString($startcol + 17);

			$this->label_quantita = $rs->getString($startcol + 18);

			$this->label_descrizione = $rs->getString($startcol + 19);

			$this->label_prezzo_singolo = $rs->getString($startcol + 20);

			$this->label_prezzo_totale = $rs->getString($startcol + 21);

			$this->label_sconto = $rs->getString($startcol + 22);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 23; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Impostazione object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ImpostazionePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ImpostazionePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ImpostazionePeer::DATABASE_NAME);
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
					$pk = ImpostazionePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ImpostazionePeer::doUpdate($this, $con);
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


			if (($retval = ImpostazionePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ImpostazionePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIdUtente();
				break;
			case 1:
				return $this->getNumClienti();
				break;
			case 2:
				return $this->getNumFatture();
				break;
			case 3:
				return $this->getRigheDettagli();
				break;
			case 4:
				return $this->getRitenutaAcconto();
				break;
			case 5:
				return $this->getTipoRitenuta();
				break;
			case 6:
				return $this->getRiepilogoHome();
				break;
			case 7:
				return $this->getConsegnaCommercialista();
				break;
			case 8:
				return $this->getDepositaIva();
				break;
			case 9:
				return $this->getFatturaAutomatica();
				break;
			case 10:
				return $this->getCodiceCliente();
				break;
			case 11:
				return $this->getLabelImponibile();
				break;
			case 12:
				return $this->getLabelSpese();
				break;
			case 13:
				return $this->getLabelImponibileIva();
				break;
			case 14:
				return $this->getLabelIva();
				break;
			case 15:
				return $this->getLabelTotaleFattura();
				break;
			case 16:
				return $this->getLabelRitenutaAcconto();
				break;
			case 17:
				return $this->getLabelNettoLiquidare();
				break;
			case 18:
				return $this->getLabelQuantita();
				break;
			case 19:
				return $this->getLabelDescrizione();
				break;
			case 20:
				return $this->getLabelPrezzoSingolo();
				break;
			case 21:
				return $this->getLabelPrezzoTotale();
				break;
			case 22:
				return $this->getLabelSconto();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ImpostazionePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIdUtente(),
			$keys[1] => $this->getNumClienti(),
			$keys[2] => $this->getNumFatture(),
			$keys[3] => $this->getRigheDettagli(),
			$keys[4] => $this->getRitenutaAcconto(),
			$keys[5] => $this->getTipoRitenuta(),
			$keys[6] => $this->getRiepilogoHome(),
			$keys[7] => $this->getConsegnaCommercialista(),
			$keys[8] => $this->getDepositaIva(),
			$keys[9] => $this->getFatturaAutomatica(),
			$keys[10] => $this->getCodiceCliente(),
			$keys[11] => $this->getLabelImponibile(),
			$keys[12] => $this->getLabelSpese(),
			$keys[13] => $this->getLabelImponibileIva(),
			$keys[14] => $this->getLabelIva(),
			$keys[15] => $this->getLabelTotaleFattura(),
			$keys[16] => $this->getLabelRitenutaAcconto(),
			$keys[17] => $this->getLabelNettoLiquidare(),
			$keys[18] => $this->getLabelQuantita(),
			$keys[19] => $this->getLabelDescrizione(),
			$keys[20] => $this->getLabelPrezzoSingolo(),
			$keys[21] => $this->getLabelPrezzoTotale(),
			$keys[22] => $this->getLabelSconto(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ImpostazionePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIdUtente($value);
				break;
			case 1:
				$this->setNumClienti($value);
				break;
			case 2:
				$this->setNumFatture($value);
				break;
			case 3:
				$this->setRigheDettagli($value);
				break;
			case 4:
				$this->setRitenutaAcconto($value);
				break;
			case 5:
				$this->setTipoRitenuta($value);
				break;
			case 6:
				$this->setRiepilogoHome($value);
				break;
			case 7:
				$this->setConsegnaCommercialista($value);
				break;
			case 8:
				$this->setDepositaIva($value);
				break;
			case 9:
				$this->setFatturaAutomatica($value);
				break;
			case 10:
				$this->setCodiceCliente($value);
				break;
			case 11:
				$this->setLabelImponibile($value);
				break;
			case 12:
				$this->setLabelSpese($value);
				break;
			case 13:
				$this->setLabelImponibileIva($value);
				break;
			case 14:
				$this->setLabelIva($value);
				break;
			case 15:
				$this->setLabelTotaleFattura($value);
				break;
			case 16:
				$this->setLabelRitenutaAcconto($value);
				break;
			case 17:
				$this->setLabelNettoLiquidare($value);
				break;
			case 18:
				$this->setLabelQuantita($value);
				break;
			case 19:
				$this->setLabelDescrizione($value);
				break;
			case 20:
				$this->setLabelPrezzoSingolo($value);
				break;
			case 21:
				$this->setLabelPrezzoTotale($value);
				break;
			case 22:
				$this->setLabelSconto($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ImpostazionePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIdUtente($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNumClienti($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNumFatture($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRigheDettagli($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setRitenutaAcconto($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTipoRitenuta($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setRiepilogoHome($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setConsegnaCommercialista($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDepositaIva($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setFatturaAutomatica($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCodiceCliente($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setLabelImponibile($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setLabelSpese($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setLabelImponibileIva($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setLabelIva($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setLabelTotaleFattura($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setLabelRitenutaAcconto($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setLabelNettoLiquidare($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setLabelQuantita($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setLabelDescrizione($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setLabelPrezzoSingolo($arr[$keys[20]]);
		if (array_key_exists($keys[21], $arr)) $this->setLabelPrezzoTotale($arr[$keys[21]]);
		if (array_key_exists($keys[22], $arr)) $this->setLabelSconto($arr[$keys[22]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ImpostazionePeer::DATABASE_NAME);

		if ($this->isColumnModified(ImpostazionePeer::ID_UTENTE)) $criteria->add(ImpostazionePeer::ID_UTENTE, $this->id_utente);
		if ($this->isColumnModified(ImpostazionePeer::NUM_CLIENTI)) $criteria->add(ImpostazionePeer::NUM_CLIENTI, $this->num_clienti);
		if ($this->isColumnModified(ImpostazionePeer::NUM_FATTURE)) $criteria->add(ImpostazionePeer::NUM_FATTURE, $this->num_fatture);
		if ($this->isColumnModified(ImpostazionePeer::RIGHE_DETTAGLI)) $criteria->add(ImpostazionePeer::RIGHE_DETTAGLI, $this->righe_dettagli);
		if ($this->isColumnModified(ImpostazionePeer::RITENUTA_ACCONTO)) $criteria->add(ImpostazionePeer::RITENUTA_ACCONTO, $this->ritenuta_acconto);
		if ($this->isColumnModified(ImpostazionePeer::TIPO_RITENUTA)) $criteria->add(ImpostazionePeer::TIPO_RITENUTA, $this->tipo_ritenuta);
		if ($this->isColumnModified(ImpostazionePeer::RIEPILOGO_HOME)) $criteria->add(ImpostazionePeer::RIEPILOGO_HOME, $this->riepilogo_home);
		if ($this->isColumnModified(ImpostazionePeer::CONSEGNA_COMMERCIALISTA)) $criteria->add(ImpostazionePeer::CONSEGNA_COMMERCIALISTA, $this->consegna_commercialista);
		if ($this->isColumnModified(ImpostazionePeer::DEPOSITA_IVA)) $criteria->add(ImpostazionePeer::DEPOSITA_IVA, $this->deposita_iva);
		if ($this->isColumnModified(ImpostazionePeer::FATTURA_AUTOMATICA)) $criteria->add(ImpostazionePeer::FATTURA_AUTOMATICA, $this->fattura_automatica);
		if ($this->isColumnModified(ImpostazionePeer::CODICE_CLIENTE)) $criteria->add(ImpostazionePeer::CODICE_CLIENTE, $this->codice_cliente);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_IMPONIBILE)) $criteria->add(ImpostazionePeer::LABEL_IMPONIBILE, $this->label_imponibile);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_SPESE)) $criteria->add(ImpostazionePeer::LABEL_SPESE, $this->label_spese);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_IMPONIBILE_IVA)) $criteria->add(ImpostazionePeer::LABEL_IMPONIBILE_IVA, $this->label_imponibile_iva);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_IVA)) $criteria->add(ImpostazionePeer::LABEL_IVA, $this->label_iva);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_TOTALE_FATTURA)) $criteria->add(ImpostazionePeer::LABEL_TOTALE_FATTURA, $this->label_totale_fattura);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_RITENUTA_ACCONTO)) $criteria->add(ImpostazionePeer::LABEL_RITENUTA_ACCONTO, $this->label_ritenuta_acconto);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_NETTO_LIQUIDARE)) $criteria->add(ImpostazionePeer::LABEL_NETTO_LIQUIDARE, $this->label_netto_liquidare);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_QUANTITA)) $criteria->add(ImpostazionePeer::LABEL_QUANTITA, $this->label_quantita);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_DESCRIZIONE)) $criteria->add(ImpostazionePeer::LABEL_DESCRIZIONE, $this->label_descrizione);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_PREZZO_SINGOLO)) $criteria->add(ImpostazionePeer::LABEL_PREZZO_SINGOLO, $this->label_prezzo_singolo);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_PREZZO_TOTALE)) $criteria->add(ImpostazionePeer::LABEL_PREZZO_TOTALE, $this->label_prezzo_totale);
		if ($this->isColumnModified(ImpostazionePeer::LABEL_SCONTO)) $criteria->add(ImpostazionePeer::LABEL_SCONTO, $this->label_sconto);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ImpostazionePeer::DATABASE_NAME);

		$criteria->add(ImpostazionePeer::ID_UTENTE, $this->id_utente);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIdUtente();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIdUtente($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNumClienti($this->num_clienti);

		$copyObj->setNumFatture($this->num_fatture);

		$copyObj->setRigheDettagli($this->righe_dettagli);

		$copyObj->setRitenutaAcconto($this->ritenuta_acconto);

		$copyObj->setTipoRitenuta($this->tipo_ritenuta);

		$copyObj->setRiepilogoHome($this->riepilogo_home);

		$copyObj->setConsegnaCommercialista($this->consegna_commercialista);

		$copyObj->setDepositaIva($this->deposita_iva);

		$copyObj->setFatturaAutomatica($this->fattura_automatica);

		$copyObj->setCodiceCliente($this->codice_cliente);

		$copyObj->setLabelImponibile($this->label_imponibile);

		$copyObj->setLabelSpese($this->label_spese);

		$copyObj->setLabelImponibileIva($this->label_imponibile_iva);

		$copyObj->setLabelIva($this->label_iva);

		$copyObj->setLabelTotaleFattura($this->label_totale_fattura);

		$copyObj->setLabelRitenutaAcconto($this->label_ritenuta_acconto);

		$copyObj->setLabelNettoLiquidare($this->label_netto_liquidare);

		$copyObj->setLabelQuantita($this->label_quantita);

		$copyObj->setLabelDescrizione($this->label_descrizione);

		$copyObj->setLabelPrezzoSingolo($this->label_prezzo_singolo);

		$copyObj->setLabelPrezzoTotale($this->label_prezzo_totale);

		$copyObj->setLabelSconto($this->label_sconto);


		$copyObj->setNew(true);

		$copyObj->setIdUtente('0'); 
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
			self::$peer = new ImpostazionePeer();
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

} 