<?php

require_once 'lib/model/om/BaseDettagliFattura.php';


/**
 * Skeleton subclass for representing a row from the 'dettagli_fattura' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class DettagliFattura extends BaseDettagliFattura {

	private $totale = 0;
	
	public function getTotale()
	{
		return ($this->qty*$this->prezzo)-($this->qty*$this->prezzo)/100*$this->sconto;
	}
	
	public function getDescrizioneEditing(){
		return stripcslashes(htmlentities($this->descrizione));
	}
	
	public function setPrezzo($v)
	{

		if ($this->prezzo !== $v || $v === '0') {
			$this->prezzo = str_replace(',','.',$v);
			$this->modifiedColumns[] = DettagliFatturaPeer::PREZZO;
		}

	} // setPrezzo()
	
	public function save($con = null) {
	  parent::save();
        
	  if(!is_null($this->getFattura())) {
	     $this->getFattura()->save();
	  }

  }
} // DettagliFattura
