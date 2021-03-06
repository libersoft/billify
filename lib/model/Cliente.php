<?php
/**
 * Skeleton subclass for representing a row from the 'cliente' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */
class Cliente extends Contatto {

  protected $azienda = 's';

  /**
	 * Constructs a new Fornitore class, setting the class_key column to ContattoPeer::CLASSKEY_2.
	 */
	public function __construct()
	{

		$this->setClassKey(ContattoPeer::CLASSKEY_1);
	}

	public function __toString() {
        if($this->getAzienda() == 's') {
  		return $this->ragione_sociale;
  	 }  
  	 else {
  		return $this->cognome.' '.$this->nome;
  	 }
	}
	
	public function toString(){
	 return $this->__toString();	
	}

	public function getPivaOrCf(){
		if($this->getAzienda()=='s') {
			return LABEL_PIVA.$this->getPiva().TAG_BR.LABEL_CODICE_FISCALE.$this->getCf();
		}
		return LABEL_CODICE_FISCALE.$this->getCf();
	}

	public function getTotaleFatture($year = null) {
	  $c = new Criteria();
	  
	  if(!is_null($year)) {
	    $c->add(FatturaPeer::DATA, date('y-m-d', mktime(0, 0, 0, 1, 1, $year)), Criteria::GREATER_EQUAL);
	    $c->addAnd(FatturaPeer::DATA, date('y-m-d', mktime(0, 0, 0, 12, 31, $year)), Criteria::LESS_EQUAL);
	  }

	  $fatture = $this->getFatturas($c);
	  
	  $totale = 0;
	  $tasse = TassaPeer::doSelect(new Criteria());
	  
	  foreach ($fatture as $fattura) {
	    $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
	    $totale += $fattura->getImponibile();
	  }

	  return $totale;
	}

  public function getContatto() {
    if(!$this->contatto && $this->cognome != '') {
      return $this->nome.' '.$this->cognome;
    }

    return $this->contatto;
  }

} // Cliente
