<?php

require_once 'lib/model/om/BaseProdotto.php';


/**
 * Skeleton subclass for representing a row from the 'prodotto' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class Prodotto extends BaseProdotto {
	public function __toString(){
		return $this->getNome();
	}
	
	public function setPrezzo($v)
	{

		if ($this->prezzo !== $v || $v === '0') {
			$this->prezzo = str_replace(',','.',$v);
			$this->modifiedColumns[] = ProdottoPeer::PREZZO;
		}

	} // setPrezzo()
} // Prodotto
