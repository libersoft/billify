<?php

require_once 'lib/model/om/BaseImpostazione.php';


/**
 * Skeleton subclass for representing a row from the 'impostazione' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class Impostazione extends BaseImpostazione {

	public function getBoolCodiceCliente(){
		if ($this->codice_cliente == 's')
			return true;
		else 
			return false;
	}
	
	public function getBoolDepositaIva(){
		if ($this->deposita_iva == 's')
			return true;
		else 
			return false;
	}
	
	public function getBoolRiepilogoHome(){
		if ($this->riepilogo_home == 's')
			return true;
		else 
			return false;
	}
	
	public function getBoolFatturaAutomatica(){
		if ($this->fattura_automatica == 's')
			return true;
		else 
			return false;
	}
	
	public function getBoolConsegnaCommercialista(){
		if ($this->consegna_commercialista == 's')
			return true;
		else 
			return false;
	}
} // Impostazione
