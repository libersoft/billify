<?php

require_once 'lib/model/om/BaseTemaFattura.php';


/**
 * Skeleton subclass for representing a row from the 'tema_fattura' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */

define('SI', 's');
define('NO', 'n');

define('LOGO','LOGO');
define('RAGIONE_SOCIALE','RAGIONE_SOCIALE');
define('NOME','NOME');
define('COGNOME','COGNOME');
define('PIVA','PIVA');
define('CF','CF');

define('NOME_BANCA','NOME_BANCA');
define('ABI','ABI');
define('CAB','CAB');
define('CIN','CIN');
define('NUM_CONTO','NUM_CONTO');
define('IBAN', 'IBAN');
define('FATTURA_NOTA', 'FATTURA_NOTA');

define('CSS','CSS');

define('CLIENTE_INTESTAZIONE','CLIENTE_INTESTAZIONE');
define('CLIENTE_VIA','CLIENTE_VIA');
define('CLIENTE_CAP','CLIENTE_CAP');
define('CLIENTE_CITTA','CLIENTE_CITTA');
define('CLIENTE_PROVINCIA','CLIENTE_PROVINCIA');
define('CLIENTE_PIVA_OR_CF','CLIENTE_PIVA_OR_CF');

define('NOTA_CREDITO_OR_FATTURA','NOTA_CREDITO_OR_FATTURA');
define('PROFORMA_OR_NUM','PROFORMA_OR_NUM');
define('FATTURA_DATA','FATTURA_DATA');
define('FATTURA_PAGAMENTO','FATTURA_PAGAMENTO');
define('FATTURA_IMPONIBILE','FATTURA_IMPONIBILE');
define('FATTURA_VAL_SCONTO','FATTURA_VAL_SCONTO');
define('FATTURA_SCONTO','FATTURA_SCONTO');
define('FATTURA_SPESE_ANTICIPATE','FATTURA_SPESE_ANTICIPATE');
define('FATTURA_IMPONIBILE_IVA','FATTURA_IMPONIBILE_IVA');
define('FATTURA_IVA','FATTURA_IVA');
define('FATTURA_TOTALE','FATTURA_TOTALE');
define('FATTURA_NETTO_LIQUIDARE','FATTURA_NETTO_LIQUIDARE');
define('FATTURA_RITENUTA_ACCONTO','FATTURA_RITENUTA_ACCONTO');

define('PROFORMA_ART_21','PROFORMA_ART_21');
define('PROFORMA_PAGAMENTO','PROFORMA_PAGAMENTO');

define('DETTAGLIO_FATTURA_QTY','DETTAGLIO_FATTURA_QTY');
define('DETTAGLIO_FATTURA_DESCRIZIONE','DETTAGLIO_FATTURA_DESCRIZIONE');
define('DETTAGLIO_FATTURA_PREZZO_SINGOLO','DETTAGLIO_FATTURA_PREZZO_SINGOLO');
define('DETTAGLIO_FATTURA_SCONTO','DETTAGLIO_FATTURA_SCONTO');
define('DETTAGLIO_FATTURA_PREZZO_TOTALE','DETTAGLIO_FATTURA_PREZZO_TOTALE');
define('DETTAGLIO_FATTURA_IVA','IVA');

define('TASSA_LABEL','TASSA_LABEL');
define('TASSA_VALUE','TASSA_VALUE');

define('LABEL_PRO_FORMA_ART_21','La presente non costituisce fattura a norma dell\'articolo 21 del DTR numero 633/72 e non deve essere da voi annotata sul libro degli acquisti.');
define('LABEL_PRO_FORMA_PAGAMENTO','A ricevimento del saldo sar&agrave; emessa regolare fattura.');
define('LABEL_PIVA','P.Iva: ');
define('LABEL_CODICE_FISCALE','CF: ');
define('LABEL_NOTA_CREDITO','Nota Credito');
define('LABEL_FATTURA','Fattura');
define('LABEL_PROFORMA','pro-forma');
define('LABEL_NUM_FATTURA','');
define('TAG_BR','<br/>');

define ('PDF_EURO_SIMBOL',' !');

class TemaFattura extends BaseTemaFattura {

	public function setFattura($fattura){
		$this->fattura = clone $fattura;
	}

	private function parser($string){

		$string_start = '
<html>
<head><title></title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<style>[CSS]</style>
</head>
<body>';

		$string_end = '</body></html>';
		$string = $string_start.$string.$string_end;

		$utente = $this->fattura->getUtente();
		$banca = $this->fattura->getCliente()->getBanca();
		$cliente = $this->fattura->getCliente();

		$patterns = array();
		$replacements = array();

		if(!is_null($this->getLogo()) && $this->getLogo() != ""){
			$patterns[] = ('/\['.LOGO.'\]/');
			$replacements[] = ('<img width="100" src="uploads/'.$this->getLogo().'">');
		}

		$patterns[] = ('/\['.RAGIONE_SOCIALE.'\]/');
		$replacements[] = ($utente->getRagioneSociale());

		$patterns[] = ('/\['.NOME.'\]/');
		$replacements[] = ($utente->getNome());

		$patterns[] = ('/\['.COGNOME.'\]/');
		$replacements[] = ($utente->getCognome());

		$patterns[] = ('/\['.PIVA.'\]/');
		$replacements[] = ($utente->getPartitaIva());
		$patterns[] = ('/\['.CF.'\]/');
		$replacements[] = ($utente->getCodiceFiscale());

		$patterns[] = ('/\['.NOME_BANCA.'\]/');
		$replacements[] = ($banca->getNomeBanca());
		$patterns[] = ('/\['.ABI.'\]/');
		$replacements[] = ($banca->getAbi());
		$patterns[] = ('/\['.CAB.'\]/');
		$replacements[] = ($banca->getCab());
		$patterns[] = ('/\['.CIN.'\]/');
		$replacements[] = ($banca->getCin());
		$patterns[] = ('/\['.NUM_CONTO.'\]/');
		$replacements[] = ($banca->getNumeroConto());
		$patterns[] = ('/\['.IBAN.'\]/');
		$replacements[] = ($banca->getIban());
				
		$patterns[] = ('/\['.PROFORMA_ART_21.'\]/');
		$replacements[] = ($this->getLabelProFormaArt21());
		$patterns[] = ('/\['.PROFORMA_PAGAMENTO.'\]/');
		$replacements[] = ($this->getLabelProFormaPagamento());

		$patterns[] = ('/\['.CLIENTE_INTESTAZIONE.'\]/');
		$replacements[] = ($cliente->toString());
		$patterns[] = ('/\['.CLIENTE_VIA.'\]/');
		$replacements[] = ($cliente->getVia());
		$patterns[] = ('/\['.CLIENTE_CAP.'\]/');
		$replacements[] = ($cliente->getCap());
		$patterns[] = ('/\['.CLIENTE_CITTA.'\]/');
		$replacements[] = ($cliente->getCitta());
		$patterns[] = ('/\['.CLIENTE_PROVINCIA.'\]/');
		$replacements[] = ($cliente->getProvincia());
		$patterns[] = ('/\['.CLIENTE_PIVA_OR_CF.'\]/');
		$replacements[] = ($cliente->getPivaOrCF());

		$patterns[] = ('/\['.NOTA_CREDITO_OR_FATTURA.'\]/');
		$replacements[] = ($this->getLabelNotaCreditoOrFattura());
		$patterns[] = ('/\['.PROFORMA_OR_NUM.'\]/');
		$replacements[] = ($this->getLabelProFormaOrNum());
		$patterns[] = ('/\['.FATTURA_DATA.'\]/');
		$replacements[] = ($this->fattura->getData('d/m/Y'));
		$patterns[] = ('/\['.FATTURA_PAGAMENTO.'\]/');
		$replacements[] = (is_object($this->fattura->getModoPagamento())?$this->fattura->getModoPagamento()->toString():'Nessuno');
		$patterns[] = ('/\['.FATTURA_IMPONIBILE.'\]/');
		$replacements[] = (($this->fattura->getIncludiTasse()=='s'?format_currency($this->fattura->getImponibileScorporato()).PDF_EURO_SIMBOL:format_currency($this->fattura->getImponibile()).PDF_EURO_SIMBOL));
		$patterns[] = ('/\['.FATTURA_VAL_SCONTO.'\]/');
		$replacements[] = ($this->fattura->getSconto());
		$patterns[] = ('/\['.FATTURA_SCONTO.'\]/');
		$replacements[] = (format_currency($this->getScontoTotale()).PDF_EURO_SIMBOL);
		$patterns[] = ('/\['.FATTURA_SPESE_ANTICIPATE.'\]/');
		$replacements[] = (format_currency($this->getSpeseAnticipate()).PDF_EURO_SIMBOL);
		$patterns[] = ('/\['.FATTURA_IMPONIBILE_IVA.'\]/');
		$patterns[] = ('/\['.FATTURA_IVA.'\]/');
		$patterns[] = ('/\['.FATTURA_TOTALE.'\]/');
		$patterns[] = ('/\['.FATTURA_NETTO_LIQUIDARE.'\]/');
		$patterns[] = ('/\['.FATTURA_RITENUTA_ACCONTO.'\]/');
		$replacements[] = (format_currency($this->fattura->getImponibileFineIva()).PDF_EURO_SIMBOL);
		$replacements[] = (format_currency($this->fattura->getIva()).PDF_EURO_SIMBOL);
		$replacements[] = (format_currency($this->fattura->getTotale()).PDF_EURO_SIMBOL);
		$replacements[] = (format_currency($this->fattura->getNettoDaLiquidare()).PDF_EURO_SIMBOL);
		$replacements[] = (format_currency($this->getRitenutaAcconto()).PDF_EURO_SIMBOL);

    $patterns[] = ('/\['.FATTURA_NOTA.'\]/');
		$replacements[] = ($this->fattura->getNote());

		$content = preg_replace($patterns,$replacements,$string);
		$dettagli_fattura = $this->parseFatturaDettagli($content);
		$tasse = $this->parseTasse($content);

		$content = preg_replace('/<FOREACHDETTAGLI>.*(<\\/FOREACHDETTAGLI>.?)/smU',$dettagli_fattura,$content);
		$content = preg_replace('/<FOREACHTASSE>.*(<\\/FOREACHTASSE>.?)/smU',$tasse,$content);
		return preg_replace('/\['.CSS.'\]/',$this->getCss(),$content);
	}

	private function parseFatturaDettagli($content){
		$re = "/<FOREACHDETTAGLI>.*(<\\/FOREACHDETTAGLI>.?)/smU";
		preg_match($re, $content, $aMatch);
		$content_dettagli = $aMatch[0];
		$content_dettagli = str_replace('<FOREACHDETTAGLI>','',$content_dettagli);
		$content_dettagli = str_replace('</FOREACHDETTAGLI>','',$content_dettagli);

		$new_content_dettagli = '';
		foreach($this->fattura->getDettagliFatturas() as $dettaglio){
			$patterns = array();
			$replacements = array();

			$patterns[] = ('/\['.DETTAGLIO_FATTURA_QTY.'\]/');
			$patterns[] = ('/\['.DETTAGLIO_FATTURA_DESCRIZIONE.'\]/');
			$patterns[] = ('/\['.DETTAGLIO_FATTURA_PREZZO_SINGOLO.'\]/');
			$patterns[] = ('/\['.DETTAGLIO_FATTURA_SCONTO.'\]/');
			$patterns[] = ('/\['.DETTAGLIO_FATTURA_PREZZO_TOTALE.'\]/');
			$patterns[] = ('/\['.DETTAGLIO_FATTURA_IVA.'\]/');
			$replacements[] = ($dettaglio->getQty());
			$replacements[] = ($dettaglio->getDescrizione());
			$replacements[] = ($dettaglio->getFattura()->getIncludiTasse() == 's'?format_currency(fattura::calcDettaglioScorporato($dettaglio->getPrezzo())). PDF_EURO_SIMBOL:format_currency($dettaglio->getPrezzo()).PDF_EURO_SIMBOL);
			$replacements[] = ($dettaglio->getSconto());
			$replacements[] = ($dettaglio->getFattura()->getIncludiTasse() == 's'?format_currency(fattura::calcDettaglioScorporato($dettaglio->getTotale())).PDF_EURO_SIMBOL:format_currency($dettaglio->getTotale()).PDF_EURO_SIMBOL);
			$replacements[] = ($dettaglio->getIva());

			$new_content_dettagli .= preg_replace($patterns,$replacements,$content_dettagli);
		}

		return $new_content_dettagli;

	}

	private function parseTasse($content){
		if($this->fattura->getCalcolaTasse() == SI){
			$re = "/<FOREACHTASSE>.*(<\\/FOREACHTASSE>.?)/smU";
			preg_match($re, $content, $aMatch);
			$content_tasse = $aMatch[0];
			$content_tasse = str_replace('<FOREACHTASSE>','',$content_tasse);
			$content_tasse = str_replace('</FOREACHTASSE>','',$content_tasse);

			$new_content_tasse = '';
			foreach($this->fattura->getTasseUlteriori() as $tassa_ulteriore){
				$patterns = array();
				$replacements = array();

				$patterns[] = ('/\['.TASSA_LABEL.'\]/');
				$patterns[] = ('/\['.TASSA_VALUE.'\]/');
				$replacements[] = ($tassa_ulteriore['nome']);
				$replacements[] = (format_currency($tassa_ulteriore['costo']).PDF_EURO_SIMBOL);

				$new_content_tasse .= preg_replace($patterns,$replacements,$content_tasse);
			}

			return $new_content_tasse;
		}

		return '';

	}

	public function ToString(){
		return $this->__toString();
	}

  public function __toString(){
		return $this->nome;
	}

	public function getViewHeader(){

		return $this->parser($this->template);
	}

	public function getViewFooter($id_banca,$id_cliente){
		return $this->parser($id_banca,$id_cliente,$this->footer);
	}

	private function getLabelProFormaArt21(){
		if($this->fattura->isProForma())
			return LABEL_PRO_FORMA_ART_21;
		else {
			$this->css .= '#proforma_art_21{display: none}';
			return '';
		}
	}

	private function getLabelProFormaPagamento(){
		if($this->fattura->isProForma())
			return LABEL_PRO_FORMA_PAGAMENTO;
		else {
			$this->css .= '#proforma_pagamento{display: none}';
			return '';
		}
	}

	private function getLabelNotaCreditoOrFattura(){
		return $this->fattura->getRitenutaAcconto() < 0 ? LABEL_NOTA_CREDITO.'&nbsp;':LABEL_FATTURA.'&nbsp;';
	}

	private function getLabelProFormaOrNum(){
		return $this->fattura->isProForma() ? LABEL_PROFORMA : LABEL_NUM_FATTURA.' '.$this->fattura->getNumFattura();
	}

	private function getScontoTotale(){
		if($this->fattura->getSconto() != 0){
			return $this->fattura->getScontoTotale();
		}
		else{
			$this->css .= '#sconto{display: none}';
			return '';
		}
	}

	private function getSpeseAnticipate(){
		if($this->fattura->getSpeseAnticipate() != 0){
			return $this->fattura->getSpeseAnticipate();
		}
		else{
			$this->css .= '#spese_anticipate{display: none}';
			return '';
		}
	}

	private function getRitenutaAcconto(){
		if(($this->fattura->getCliente()->getAzienda()==SI && $this->fattura->getCalcolaRitenutaAcconto() == 'a') || $this->fattura->getCalcolaRitenutaAcconto() == SI){
			$string = ($this->fattura->getTipoRitenuta()==CREDITO || $this->fattura->getRitenutaAcconto() < 0 ?'':'-');
			$string.= ($this->fattura->getRitenutaAcconto() < 0?-1*$fthis->attura->getRitenutaAcconto():$this->fattura->getRitenutaAcconto());
			return $string;
		}else{
			$this->css .= '#ritenuta_acconto{display: none}';
			return '';
		}
	}

} // TemaFattura
