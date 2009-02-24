<?php

require_once 'lib/model/om/BaseFattura.php';

define('CREDITO', 'credito');
define('DEBITO', 'debito');

/**
 * Skeleton subclass for representing a row from the 'fattura' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */
class Fattura extends BaseFattura {
  
  const PAGATA = 'p';
  const NON_PAGATA = 'n';
  const RIFIUTATA = 'r';
  const INVIATA = 'i';
		
  protected $stato_string = array(self::NON_PAGATA => 'non inviata',
                                  self::PAGATA     => 'pagata',
                                  self::RIFIUTATA  => 'rifiutata',
                                  self::INVIATA    => 'inviata');
                                 
  protected $font_color_stato = array(self::NON_PAGATA => 'black',
                                      self::PAGATA     => 'black',
                                      self::RIFIUTATA  => 'black',
                                      self::INVIATA    => 'white');
                                       
  protected $color_stato = array(self::NON_PAGATA => 'yellow',
                                 self::PAGATA     => 'green',
                                 self::RIFIUTATA  => 'red',
                                 self::INVIATA    => 'blue');
  

	protected $imponibile = 0;
	private $imponibile_scorporato = 0;
	private $imponibile_fine_iva = 0;
	private $sconto_totale = 0;
	private $tasse_ulteriori = array();
	private $ritenuta_acconto = 0;
	private $iva = 0;
	private $totale = 0;
	private $calcola = false;
	private $tipo_ritenuta;
	private $costo_tasse_ulteriori = 0;

	public function __toString() {
	  return 'Fattura '.($this->isProForma()?'Pro-Forma':'N&ordm; '.$this->getNumFattura());
	}
	
	public function toString(){
        return $this->__toString();
	}

	public function setNewNumFattura()
	{
		$conn = Propel::getConnection();
		$stm = $conn->createStatement();

		//Select Invoice whit max ID
		if($this->getData() != "") {
			$year = date('y',strtotime($this->getData()));
		}
		else {
			$year = date('y',time());
		}

		$query = 'SELECT max('.FatturaPeer::NUM_FATTURA .') as max 
		          FROM '.FatturaPeer::TABLE_NAME.' 
		          WHERE '.FatturaPeer::ID_UTENTE .'='.sfContext::getInstance()->getUser()->getAttribute('id_utente').' 
		          AND '.FatturaPeer::DATA.'>= "'.date('y-m-d',mktime(0,0,0,1,1,$year)).'" 
		          AND '.FatturaPeer::DATA .' <= "'.date('y-m-d',mktime(0,0,0,12,31,$year)).'"
		          AND '.FatturaPeer::CLASS_KEY .' = '.FatturaPeer::CLASSKEY_VENDITA ;
		
		$rs = $stm->executeQuery($query);
		$rs->first();
		$max = $rs->get('max');

		//Select Num Fattura and date of Invoice with Max ID
		if($max != "")
		{
			$query2 = 'SELECT '.VenditaPeer::ID.' as id,'.VenditaPeer::DATA.' as data 
			           FROM '.VenditaPeer::TABLE_NAME.' 
			           WHERE '.FatturaPeer::ID_UTENTE .'='.sfContext::getInstance()->getUser()->getAttribute('id_utente').' 
			           AND '.FatturaPeer::NUM_FATTURA .'='.$max.' 
			           AND '.FatturaPeer::DATA.'>= "'.date('y-m-d',mktime(0,0,0,1,1,$year)).'" 
			           AND '.FatturaPeer::DATA .' <= "'.date('y-m-d',mktime(0,0,0,12,31,$year)).'"
			           AND '.FatturaPeer::CLASS_KEY .' = '.FatturaPeer::CLASSKEY_VENDITA ;
			
			$rs = $stm->executeQuery($query2);
			$rs->first();
			$id_fattura = $rs->get('id');
			$data_fattura = $rs->get('data');

			$num_fattura = $max;
			$data = $data_fattura;

			$num_fattura = $num_fattura+1;

		}else
			$num_fattura = 1;

		parent::setNumFattura($num_fattura);
	}

	public function getDataPagamento($format = 'd M Y')
	{
		$data_pagamento = $this->getData();
		$data = explode('-',$data_pagamento);
		$data = date($format, mktime(0, 0, 0, $data[1], $data[2] + (is_object($this->getModoPagamento())?$this->getModoPagamento()->getNumGiorni():0), $data[0]));
		return strftime($data);
	}

	public function checkInRitardo()
	{
		return (strtotime($this->getDataPagamento()) < time() && $this->getStato() == self::INVIATA);
	}

	public function calcImponibileFineIva()
	{
		if($this->getIncludiTasse() == 's')
			$this->imponibile = $this->imponibile_scorporato;

		$imponibile = $this->imponibile - $this->sconto_totale;
		if(count($this->tasse_ulteriori)>0)
			foreach ($this->tasse_ulteriori as $tassa_ulteriore)
			{
				$imponibile += $tassa_ulteriore['costo'];
			}

		$this->imponibile_fine_iva = $imponibile + $this->spese_anticipate;
	}

	public function getTipoRitenuta(){
		return $this->tipo_ritenuta;
	}

	public function calcolaFattura()
	{
		if(!$this->calcola)
		{
			$this->tasse_ulteriori_array = TassaPeer::doSelect(new Criteria());
			try {
			 $this->tipo_ritenuta = UtentePeer::getImpostazione()->getTipoRitenuta();
			}
			catch(Exception $e) {}
			
			$this->calcImponibile();

			if($this->getIncludiTasse() == 's') {
				$this->calcImponibileScorporato();
			}

			$this->calcScontoTotale();

			if($this->getCalcolaTasse() == 's') {
				$this->calcTasseUlteriori();
			}

			$this->calcImponibileFineIva();
			$this->calcRitenutaAcconto();
			$this->calcIva();
			$this->calcTotale();
			$this->calcNettoDaLiquidare();
			$this->calcola = true;
		}
	}

	public function getTasseUlterioriArray()
	{
		return $this->tasse_ulteriori_array;
	}
	
	private function calcImponibile()
	{
		$dettagli_fattura = $this->getDettagliFatturas();

		foreach ($dettagli_fattura as $dettaglio) {
			$det = $this->calcDettaglio($dettaglio);
			$this->imponibile += $det;
			$this->iva += $this->calcIvaDettaglio($det,$dettaglio->getIva());
		}
	}

	private function calcImponibileScorporato()
	{
		$dettagli_fattura = $this->getDettagliFatturas();
		$this->iva = 0;
		foreach ($dettagli_fattura as $dettaglio) {
			$det = $this->calcDettaglio($dettaglio,true);
			$this->imponibile_scorporato += $det;
			$this->iva += $this->calcIvaDettaglio($det,$dettaglio->getIva());
		}
	}

	private function calcDettaglio($dettaglio,$scorpora = false)
	{
		//$dettaglio = ($dettaglio->getPrezzo()*$dettaglio->getQty())-($this->calcSconto(($dettaglio->getPrezzo()*$dettaglio->getQty()),$dettaglio->getSconto()));
		$det = $dettaglio->getTotale();

		if($scorpora && $this->getCalcolaTasse() == 's'){
			return $this->calcDettaglioScorporato($det,$this->getCalcolaTasse() == 's',$this->tasse_ulteriori_array);
		}else{
			return $det;
		}
	}

	private function calcIvaDettaglio($dettaglio,$iva) 
	{
		if($this->getCalcolaTasse() == 's') {
			$vat_tmp_array = $this->tasse_ulteriori_array;
			//$vat = sfConfig::get('app_vat');
			//$vat_tmp_array = explode('|',$vat);
			$tassa = 0;
			foreach ($vat_tmp_array as $vat)
			{
				//list($nome, $valore, $descrizione) = explode('-',$vat);
				$tassa += $dettaglio/100*$vat->getValore();
			}

			return (($dettaglio)/100*$iva) + $tassa/100*$iva;
		}else
			return (($dettaglio)/100*$iva);

	}

	private function calcIvaScorporo($scorporo,$iva){
			return $scorporo/100*$iva;
	}

	static function calcDettaglioScorporato($dettaglio,$calcola_tasse = false, $tasse_ulteriori_array = array())
	{
		if($calcola_tasse) {
			//$vat = sfConfig::get('app_vat');
			//$vat_tmp_array = explode('|',$vat);
			$scorporo = 0;
			$dettaglio_scorporato = 0;
			foreach ($tasse_ulteriori_array as $vat) {
				//list($nome, $valore, $descrizione) = explode('-',$vat);
				$dettaglio_scorporato = $dettaglio/(1+($vat->getValore()/100));
				$scorporo += $dettaglio - $dettaglio_scorporato;
			}
			return $dettaglio_scorporato;
		}
		else	{
			return $dettaglio;
		}
	}

	static function calcScorporo($dettaglio,$calcola_tasse = false, $tasse_ulteriori_array = array())
	{
		$scorporo = 0;
		if($calcola_tasse){
			//$vat = sfConfig::get('app_vat');
			//$vat_tmp_array = explode('|',$vat);
			foreach ($tasse_ulteriori_array as $vat) {
				//list($nome, $valore, $descrizione) = explode('-',$vat);
				$dettaglio_scorporato = $dettaglio/(1+($vat->getValore()/100));
				$scorporo += $dettaglio - $dettaglio_scorporato;
			}
			return $scorporo;
		}
		else {
			return $scorporo;
		}
	}

	private function calcSconto($costo, $sconto)
	{
		return ($costo/100)*$sconto;
	}

	private function calcScontoTotale()
	{
		$this->sconto_totale = (($this->imponibile/100)*$this->getSconto());
	}

	private function calcIva()
	{
		$this->iva = $this->iva + ($this->spese_anticipate/100*$this->getVat());
	}

	private function calcTotale()
	{
		$this->totale = $this->imponibile_fine_iva + $this->iva;
	}

	public function calcTasseUlteriori()
	{
		$vat_tmp_array = $this->tasse_ulteriori_array;
		//$vat = sfConfig::get('app_vat');
		//$vat_tmp_array = explode('|',$vat);
		$all_vat = array();
		$tasse_ulteriori = array();
		foreach ($vat_tmp_array as $vat) {
			//list($nome, $valore, $descrizione) = explode('-',$vat);
			if($this->getIncludiTasse() == 's'){
				$totale = ($this->imponibile-$this->sconto_totale+$this->spese_anticipate);
				$costo = $totale - ($totale/(1+($vat->getValore()/100)));
			}
			else {
				$costo = (($this->imponibile-$this->sconto_totale+$this->spese_anticipate)/100*$vat->getValore());
			}

			$this->costo_tasse_ulteriori += $costo;
			$tasse_ulteriori[]= array('nome'=> $vat->getNome(), 'valore' => $vat->getValore(), 'descrizione' => $vat->getDescrizione(), 'costo' => $costo);
		}
		$this->tasse_ulteriori = $tasse_ulteriori;
	}

	public function calcRitenutaAcconto()
	{
		try {
        		list($percentuale, $percentuale_totale) = explode('/', UtentePeer::getImpostazione()->getRitenutaAcconto());
        		if(($this->getCliente()->getAzienda() == 's' && $this->getCalcolaRitenutaAcconto() == 'a') || $this->getCalcolaRitenutaAcconto() == 's') {
        			$this->ritenuta_acconto = (($this->imponibile_fine_iva/100*$percentuale)/100*$percentuale_totale);
        		}
		}
		catch(Exception $e) {}
	}

	public function calcNettoDaLiquidare()
	{
		if($this->tipo_ritenuta == CREDITO) {
			$this->netto_da_liquidare = $this->totale + $this->ritenuta_acconto;
		}
		else {
			$this->netto_da_liquidare = $this->totale - $this->ritenuta_acconto;
		}
	}

	public function getNettoDaLiquidare()
	{
		return $this->netto_da_liquidare;
	}

	public function getImponibile()
	{
		return $this->imponibile;
	}

	public function getImponibileScorporato()
	{
		return $this->imponibile_scorporato;
	}

	public function getImponibileFineIva()
	{
		return $this->imponibile_fine_iva;
	}

	public function getIva()
	{
		return $this->iva;
	}

	public function getTasseUlteriori()
	{
		return $this->tasse_ulteriori;
	}

	public function getRitenutaAcconto()
	{
		return $this->ritenuta_acconto;
	}

	public function getScontoTotale()
	{
		return $this->sconto_totale;
	}

	public function getTotale()
	{
		return $this->totale;
	}

	public function getStato($string = false)
	{
	  if($string) {
	    
  	  if($this->stato) {
  	   return $this->stato_string[$this->stato];
  	  }
  	  
  	  return $this->stato_string[self::NON_PAGATA];
	  }
	  
	  return $this->stato;
	  
	}

	public function getColorStato()
	{
	  if($this->stato) {
	   return $this->color_stato[$this->stato];
	  }
	  
	  return $this->color_stato[self::NON_PAGATA];
	}

	public function getFontColorStato()
	{
	  if($this->stato) {
	   return $this->font_color_stato[$this->stato];
	  }
	  
	  return $this->font_color_stato[self::NON_PAGATA];
	  
	}

	public function delete($conn = null)
	{
		$dettagli_fattura = $this->getDettagliFatturas();
		foreach ($dettagli_fattura as $dettaglio)
		{
			$dettaglio->delete();
		}
		parent::delete($conn);
	}

	public function isProForma(){
		if ($this->getNumFattura()==0)
			return true;

		return false;
	}

	public function setRegolare(){
		$this->setNewNumFattura();
		$this->setData(date('y-m-d',time()));
	}

	public function setSpeseAnticipate($v){
		if ($this->spese_anticipate !== $v || $v === '0') {
			$this->spese_anticipate = str_replace(',','.',$v);
			$this->modifiedColumns[] = FatturaPeer::SPESE_ANTICIPATE;
		}
	}

	public function getTags()
	{
		$c = new Criteria();
		$c->clearSelectColumns();
		//$c->addAscendingOrderByColumn(TagsFatturaPeer::TAG_NORMALIZZATO);
		$c->add(TagsFatturaPeer::ID_FATTURA, $this->getId());

		return TagsFatturaPeer::doSelect($c);
	}

  public function getCliente($con = null) {
    return $this->getContatto($con);
  }

  public function setCliente($v) {
    $this->setContatto($v);
  }
  
  public function save($con = null) {
    parent::save();
    
    if($this->getClassKey() == FatturaPeer::CLASSKEY_ACQUISTO ) {
      $co = new CashOutcome(new CashFlowAcquistoAdapter($this));
    }
    else {
      $co = new CashIncome(new CashFlowVenditaAdapter($this));
    }
    
    $co->save();
  }

} // Fattura

function numFormat($number){
	return number_format($number, 2, ',', '.');
}
