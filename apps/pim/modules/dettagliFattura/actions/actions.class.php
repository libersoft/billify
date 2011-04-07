<?php

define('NUM_ITEM', UtentePeer::getImpostazione()->getRIgheDettagli());

class dettagliFatturaActions extends sfActions
{

  public function executeIndex()
  {
    return $this->forward('dettagliFattura', 'list');
  }

  public function executeList()
  {
    $this->dettagli_fatturas = DettagliFatturaPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    if ($this->getRequestParameter('fattura_id'))
    {
      $this->getUser()->setAttribute('conta_dettagli', 0);
      $this->getUser()->setAttribute('dettagli_in_modifica', array());
      $this->fattura = VenditaPeer::retrieveByPK($this->getRequestParameter('fattura_id'));
      $this->fattura->calcolaFattura(TassaPeer::doSelect(new Criteria()), UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $this->dettagli_fattura = $this->fattura->getDettagliFatturas();
      $this->viewSconto = $this->getViewSconto();
    } else
    {
      $this->forward404();
    }
  }

  public function getViewSconto()
  {
    $trovato = false;
    foreach ($this->dettagli_fattura as $dettaglio)
    {
      if ($dettaglio->getSconto() > 0)
        $trovato = true;
    }
    return $trovato;
  }

  public function executeEdit()
  {
    if ($this->getRequestParameter('fattura_id'))
    {
      $this->fattura_id = $this->getRequestParameter('fattura_id');
      $this->fattura = VenditaPeer::retrieveByPK($this->fattura_id);
      $this->fattura->calcolaFattura(TassaPeer::doSelect(new Criteria()), UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $this->dettagli_fatturas = $this->fattura->getDettagliFatturas();

      if (!is_array($this->getUser()->getAttribute('dettagli_in_modifica')))
        $this->getUSer()->setAttribute('dettagli_in_modifica', array());

      if ($this->getRequestParameter('id'))
      {
        $dettagli_in_modifica = $this->getUser()->getAttribute('dettagli_in_modifica', array());
        $dettagli_in_modifica[] = $this->getRequestParameter('id');
        $this->getUSer()->setAttribute('dettagli_in_modifica', $dettagli_in_modifica);
      } elseif ($this->getRequestParameter('delete') !== true)
      {
        $this->getUser()->setAttribute('conta_dettagli', ($this->getUser()->getAttribute('conta_dettagli', 0) + NUM_ITEM));
      }

      if (count($this->dettagli_fatturas) == 0 && $this->getUser()->getAttribute('conta_dettagli') == 0)
        $this->forward('dettagliFattura', 'show');
    }else
    {
      $this->forward404();
    }
  }

  public function executeUpdate()
  {

    $ids = $this->getRequestParameter('ids');
    $ids_new = $this->getRequestParameter('ids_new');

    if (count($ids) > 0)
    {
      $prezzo = $this->getRequestParameter('prezzo');
      $sconto = $this->getRequestParameter('sconto');
      $iva = $this->getRequestParameter('iva');
      $qty = $this->getRequestParameter('qty');
      $descrizione = $this->getRequestParameter('descrizione');
      for ($i = 0; $i < count($ids); $i++)
      {
        if ($descrizione[$i] != "")
        {
          $dettagli_fattura = DettagliFatturaPeer::retrieveByPk($ids[$i]);
          $this->forward404Unless($dettagli_fattura instanceof DettagliFattura);
          //$dettagli_fattura->setId($ids[$i]);
          $dettagli_fattura->setFatturaId($this->getRequestParameter('fattura_id'));
          $dettagli_fattura->setDescrizione($descrizione[$i]);
          $dettagli_fattura->setQty($qty[$i]);
          $dettagli_fattura->setSconto($sconto[$i]);
          $dettagli_fattura->setPrezzo(floatval(str_replace(',', '.', $prezzo[$i])));
          $dettagli_fattura->setIva($iva[$i]);
          $dettagli_fattura->save();
        }
      }
      $this->getUSer()->setAttribute('dettagli_in_modifica', array());
    }

    if (count($ids_new) > 0)
    {
      $prezzo_new = $this->getRequestParameter('prezzo_new');
      $sconto_new = $this->getRequestParameter('sconto_new');
      $qty_new = $this->getRequestParameter('qty_new');
      $iva_new = $this->getRequestParameter('iva_new');
      $descrizione_new = $this->getRequestParameter('descrizione_new');

      for ($i = 0; $i < count($ids_new); $i++)
      {
        if ($descrizione_new[$i] != "")
        {
          $dettagli_fattura = new DettagliFattura();
          //$dettagli_fattura->setId($ids_new[$i]);
          $dettagli_fattura->setFatturaId($this->getRequestParameter('fattura_id'));
          $dettagli_fattura->setDescrizione(($descrizione_new[$i]));
          $dettagli_fattura->setQty($qty_new[$i]);
          $dettagli_fattura->setSconto($sconto_new[$i]);
          $dettagli_fattura->setPrezzo($prezzo_new[$i]);
          $dettagli_fattura->setIva($iva_new[$i]);
          $dettagli_fattura->save();
        }
      }
      $this->getUser()->setAttribute('conta_dettagli', 0);
    }

    if ($this->getRequestParameter('insert_page') == 'yes')
    {
      $this->forward('dettagliFattura', 'edit');
    }

    $this->forward('dettagliFattura', 'show');
  }

  public function executeDelete()
  {

    if ($this->getRequestParameter('id'))
    {
      $dettagli_fattura = DettagliFatturaPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($dettagli_fattura instanceof DettagliFattura);
      $dettagli_in_modifica = $this->getUser()->getAttribute('dettagli_in_modifica');
      $key = array_search($this->getRequestParameter('id'), $dettagli_in_modifica);
      unset($dettagli_in_modifica[$key]);
      $this->getUser()->setAttribute('dettagli_in_modifca', $dettagli_in_modifica);
      $dettagli_fattura->delete();
    } else
    {
      $this->getUser()->setAttribute('conta_dettagli', ($this->getUser()->getAttribute('conta_dettagli') - 1));
    }

    $this->getRequest()->setParameter('fattura_id', $this->getRequestParameter('fattura_id'));
    $this->getRequest()->setParameter('delete', true);

    if ($this->getUser()->getAttribute('conta_dettagli') == 0 && count($this->getUser()->getAttribute('dettagli_in_modifica')) == 0)
    {
      $this->forward('dettagliFattura', 'show');
    } else
    {
      $this->forward('dettagliFattura', 'edit');
    }
  }

  private function getDettagliFatturaOrCreate($id = 'id')
  {
    if (!$this->getRequestParameter($id, 0))
    {
      $dettagli_fattura = new DettagliFattura();
    } else
    {
      $dettagli_fattura = DettagliFatturaPeer::retrieveByPk($this->getRequestParameter($id));
      $this->forward404Unless($dettagli_fattura instanceof DettagliFattura);
    }

    return $dettagli_fattura;
  }

  public function handleError()
  {
    $this->forward('dettagliFattura', 'edit');
  }

}