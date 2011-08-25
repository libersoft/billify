<?php

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
abstract class Fattura extends BaseFattura
{
  const PAGATA = 'p';
  const NON_PAGATA = 'n';
  const RIFIUTATA = 'r';
  const INVIATA = 'i';

  protected $stato_string = array(
      self::NON_PAGATA => 'non inviata',
      self::PAGATA => 'pagata',
      self::RIFIUTATA => 'rifiutata',
      self::INVIATA => 'inviata'
  );

  protected $font_color_stato = array(
      self::NON_PAGATA => 'black',
      self::PAGATA => 'black',
      self::RIFIUTATA => 'black',
      self::INVIATA => 'white'
  );

  protected $color_stato = array(
      self::NON_PAGATA => 'yellow',
      self::PAGATA => 'green',
      self::RIFIUTATA => 'red',
      self::INVIATA => 'blue'
  );
  
  protected $imponibile = 0;
  protected $imponibile_scorporato = 0;
  protected $imponibile_fine_iva = 0;
  protected $sconto_totale = 0;
  protected $tasse_ulteriori = array();
  protected $tasse_ulteriori_array = array();
  protected $ritenuta_acconto = 0;
  protected $iva = 0;
  protected $totale = 0;
  protected $calcola = false;
  protected $tipo_ritenuta;
  protected $costo_tasse_ulteriori = 0;
  protected $id_tema_fattura = null; 

  private function calcScontoTotale()
  {
    $this->sconto_totale = (($this->imponibile / 100) * $this->getSconto());
  }

  private function calcIva()
  {
    $this->iva = $this->iva + ($this->spese_anticipate / 100 * $this->getVat());
  }

  private function calcTotale()
  {
    $this->totale = $this->imponibile_fine_iva + $this->iva;
  }

  private function calcTasseUlteriori()
  {
    $vat_tmp_array = $this->tasse_ulteriori_array;
    $all_vat = array();
    $tasse_ulteriori = array();
    foreach ($vat_tmp_array as $vat)
    {
      if ($this->getIncludiTasse() == 's')
      {
        $totale = ($this->imponibile - $this->sconto_totale + $this->spese_anticipate);
        $costo = $totale - ($totale / (1 + ($vat->getValore() / 100)));
      } else
      {
        $costo = (($this->imponibile - $this->sconto_totale + $this->spese_anticipate) / 100 * $vat->getValore());
      }

      $this->costo_tasse_ulteriori += $costo;
      $tasse_ulteriori[] = array('nome' => $vat->getNome(),
          'valore' => $vat->getValore(),
          'descrizione' => $vat->getDescrizione(),
          'costo' => $costo);
    }
    $this->tasse_ulteriori = $tasse_ulteriori;
  }

  private function calcRitenutaAcconto($ritenuta_acconto)
  {
    if ($ritenuta_acconto)
    {
      list($percentuale, $percentuale_totale) = explode('/', $ritenuta_acconto);
      if (($this->getCliente()->getAzienda() == 's' && $this->getCalcolaRitenutaAcconto() == 'a') || $this->getCalcolaRitenutaAcconto() == 's')
      {
        $this->ritenuta_acconto = (($this->imponibile_fine_iva / 100 * $percentuale) / 100 * $percentuale_totale);

        if($this->tipo_ritenuta == DEBITO)
        {
          $this->ritenuta_acconto = $this->ritenuta_acconto * -1;
        }
      }
    }
  }

  private function calcNettoDaLiquidare()
  {
    $this->netto_da_liquidare = $this->totale + $this->ritenuta_acconto;
  }

  private function calcImponibileFineIva()
  {
    if ($this->getIncludiTasse() == 's')
      $this->imponibile = $this->imponibile_scorporato;

    $imponibile = $this->imponibile - $this->sconto_totale;
    if (count($this->tasse_ulteriori) > 0)
      foreach ($this->tasse_ulteriori as $tassa_ulteriore)
      {
        $imponibile += $tassa_ulteriore['costo'];
      }

    $this->imponibile_fine_iva = $imponibile + $this->spese_anticipate;
  }

  private function calcImponibile()
  {
    $dettagli_fattura = $this->getDettagliFatturas();

    foreach ($dettagli_fattura as $dettaglio)
    {
      $det = $this->calcDettaglio($dettaglio);
      $this->imponibile += $det;
      $this->iva += $this->calcIvaDettaglio($det, $dettaglio->getIva());
    }
  }

  private function calcImponibileScorporato()
  {
    $dettagli_fattura = $this->getDettagliFatturas();
    $this->iva = 0;
    foreach ($dettagli_fattura as $dettaglio)
    {
      $det = $this->calcDettaglio($dettaglio, true);
      $this->imponibile_scorporato += $det;
      $this->iva += $this->calcIvaDettaglio($det, $dettaglio->getIva());
    }
  }

  private function calcDettaglio($dettaglio, $scorpora = false)
  {
    //$dettaglio = ($dettaglio->getPrezzo()*$dettaglio->getQty())-($this->calcSconto(($dettaglio->getPrezzo()*$dettaglio->getQty()),$dettaglio->getSconto()));
    $det = $dettaglio->getTotale();

    if ($scorpora && $this->getCalcolaTasse() == 's')
    {
      return $this->calcDettaglioScorporato($det, $this->getCalcolaTasse() == 's', $this->tasse_ulteriori_array);
    } else
    {
      return $det;
    }
  }

  private function calcIvaDettaglio($dettaglio, $iva)
  {
    if ($this->getCalcolaTasse() == 's' && count($this->tasse_ulteriori_array) > 0)
    {

      $vat_tmp_array = $this->tasse_ulteriori_array;
      $tassa = 0;
      foreach ($vat_tmp_array as $vat)
      {
        $tassa += $dettaglio / 100 * $vat->getValore();
      }

      return (($dettaglio) / 100 * $iva) + $tassa / 100 * $iva;
    } else
    {
      return (($dettaglio) / 100 * $iva);
    }
  }

  static function calcDettaglioScorporato($dettaglio, $calcola_tasse = false, $tasse_ulteriori_array = array())
  {
    if ($calcola_tasse)
    {
      $scorporo = 0;
      $dettaglio_scorporato = 0;
      foreach ($tasse_ulteriori_array as $vat)
      {
        $dettaglio_scorporato = $dettaglio / (1 + ($vat->getValore() / 100));
        $scorporo += $dettaglio - $dettaglio_scorporato;
      }
      return $dettaglio_scorporato;
    } else
    {
      return $dettaglio;
    }
  }

  public function __toString()
  {
    return 'Fattura ' . ($this->isProForma() ? 'Pro-Forma' : 'n. ' . $this->getNumberDecorated());
  }

  public function getNumberDecorated()
  {
    return $this->num_fattura;
  }

  public function getShortName()
  {
    return ($this->isProForma() ? 'Pro-Forma' : $this->getNumberDecorated());
  }

  public function getDataPagamento($format = 'd M Y')
  {
    $data_pagamento = $this->getData();
    $data = date($format, strtotime($this->getData('Y-m-d') . ' +' . (is_object($this->getModoPagamento()) ? $this->getModoPagamento()->getNumGiorni() : 0) . ' days'));
    return strftime($data);
  }

  public function getTipoRitenuta()
  {
    return $this->tipo_ritenuta;
  }

  public function getTasseUlterioriArray()
  {
    return $this->tasse_ulteriori_array;
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
    if ($string)
    {

      if ($this->stato)
      {
        return $this->stato_string[$this->stato];
      }

      return $this->stato_string[self::NON_PAGATA];
    }

    return $this->stato;
  }

  public function getColorStato()
  {
    if ($this->stato)
    {
      return $this->color_stato[$this->stato];
    }

    return $this->color_stato[self::NON_PAGATA];
  }

  public function getFontColorStato()
  {
    if ($this->stato)
    {
      return $this->font_color_stato[$this->stato];
    }

    return $this->font_color_stato[self::NON_PAGATA];
  }

  public function getCliente($con = null)
  {
    return $this->getContatto($con);
  }

  public function getStatoString()
  {
    return $this->stato_string;
  }
  
  public function setRegolare()
  {
    $this->setNewNumFattura();
    $this->setData(date('y-m-d', time()));
  }

  public function setData($v)
  {
    parent::setData($v);
    $this->setAnno(date('Y', $this->getData('U')));
  }

  public function setSpeseAnticipate($v)
  {
    if ($this->spese_anticipate !== $v || $v === '0')
    {
      $this->spese_anticipate = str_replace(',', '.', $v);
      $this->modifiedColumns[] = FatturaPeer::SPESE_ANTICIPATE;
    }
  }

  public function setCliente($v)
  {
    $this->setContatto($v);
  }

  public function setDefaultForClient(Cliente $client)
  {
    $this->setIncludiTasse($client->getIncludiTasse());
    $this->setCalcolaTasse($client->getCalcolaTasse());
    $this->setCalcolaRitenutaAcconto($client->getCalcolaRitenutaAcconto());
    $this->setModoPagamentoId($client->getModoPagamentoId());
    $this->setClienteId($client->getId());
  }

  public function toString()
  {
    return $this->__toString();
  }

  public function isProForma()
  {
    if ($this->getNumFattura() == 0)
    {
      return true;
    }

    return false;
  }

  public function checkInRitardo()
  {
    return (strtotime($this->getDataPagamento()) < time() && $this->getStato() == self::INVIATA);
  }
  
  public function delete(PropelPDO $con = null)
  {
    $dettagli_fattura = $this->getDettagliFatturas();
    foreach ($dettagli_fattura as $dettaglio)
    {
      $dettaglio->delete();
    }
    parent::delete($con);
  }

  public function calcolaFattura($tasse_ulteriori = array(), $tipo_ritenuta = null, $ritenuta_acconto = null)
  {
    if (!$this->calcola)
    {
      $this->tasse_ulteriori_array = $tasse_ulteriori;
      $this->tipo_ritenuta = $tipo_ritenuta;

      $this->calcImponibile();

      if ($this->getIncludiTasse() == 's')
      {
        $this->calcImponibileScorporato();
      }

      $this->calcScontoTotale();

      if ($this->getCalcolaTasse() == 's')
      {
        $this->calcTasseUlteriori();
      }

      $this->calcImponibileFineIva();
      $this->calcRitenutaAcconto($ritenuta_acconto);
      $this->calcIva();
      $this->calcTotale();
      $this->calcNettoDaLiquidare();
      $this->calcola = true;
    }
  }

  public function getIdTemaFattura()
  {
    
    if (parent::getIdTemaFattura())
    {
      return parent::getIdTemaFattura();
    }
    
    if (!$this->getCliente())
    {
      return TemaFatturaPeer::doSelect(new Criteria());
    }
    
    if ($this->getCliente()->getTemaFattura())
    {
      return $this->getCliente()->getTemaFattura()->getId();
    }
    
    return null;

  }

  /**
   * Se la fattura è stata spedita allora non è più editabile
   * 
   * @return boolean
   */
  public function isEditable()
  {
    return !(in_array($this->getStato(), array(Vendita::INVIATA, Vendita::PAGATA, Vendita::RIFIUTATA)));
  }
  
  abstract public function addToCashFlow(CashFlow $cf);
}

function numFormat($number)
{
  return number_format($number, 2, ',', '.');
}
