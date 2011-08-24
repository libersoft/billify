<?php

class fatturaActions extends sfActions
{
  var $cliente = null;
  
  public function executeIndex()
  {
    $this->forward('invoice', 'indexSale');
  }

  public function executeList()
  {
    $this->forward('invoice', 'indexSale');
  }

  public function executeShow()
  {
    $this->getUser()->setAttribute('conta_dettagli', 0);
    $this->getUser()->setAttribute('dettagli_in_modifica', array());
    $this->getUser()->setAttribute('modifica_data', false);
    $this->getUser()->setAttribute('modifica_num_fattura', false);
    $this->fattura = VenditaPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($this->fattura instanceof Fattura);

    if ($this->fattura->getDataStato() == "" || is_null($this->fattura->getDataStato()))
      $this->fattura->setDataStato(date('m/d/y', time()));

    $this->dettagliFattura = $this->fattura->getDettagliFatturas();
    $this->fattura->calcolaFattura(TassaPeer::doSelect(new Criteria()), UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
    $this->viewSconto = $this->getViewSconto();
  }

  public function executeCreate()
  {
    if ($this->checkBloccoFattura())
    {
      return sfView::SUCCESS;
    }

    $this->fattura = FatturaPeer::getFatturaOrCreate(0, $this->cliente);
    
    $this->makeFattura();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
        
    $this->fattura = VenditaPeer::retrieveByPk($this->getRequestParameter('id'));
    
    $this->forward404Unless($this->fattura instanceof Fattura);
    $this->makeFattura();
  }

  public function validateUpdate()
  {
    return true;
  }
  
  public function executeUpdate()
  {
    $id = $this->getRequestParameter('id', 0);
    $fattura = FatturaPeer::getFatturaOrCreate($id, $this->cliente);
    return $this->updateFattura($fattura);
  }

  public function executeDelete($forward = true)
  {
    $fattura = VenditaPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($fattura instanceof Fattura);

    $fattura->delete();

    if ($this->getRequestParameter('cliente_id') && $forward)
    {
      return $this->redirect('@contact_show?id=' . $this->getRequestParameter('cliente_id'));
    }

    if ($forward)
    {
      return $this->redirect('@invoice');
    }
  }

  public function executeStato()
  {
    $id = $this->getRequestParameter('id', 0);
    $fattura = FatturaPeer::getFatturaOrCreate(0, $this->cliente);
    $fattura->setStato($this->getRequestParameter('stato', 'n'));

    if ($this->getRequestParameter('data_stato'))
    {
      list($d, $m, $y) = $this->getContext()->getI18N()->getDateForCulture($this->getRequestParameter('data_stato'), $this->getUser()->getCulture());
      $fattura->setDataStato("$y-$m-$d");
    }

    if ($fattura->isProForma() && $this->getRequestParameter('regolare') == 'y')
      $fattura->setRegolare();

    $fattura->save();

    $this->forward('fattura', 'show');
  }

  public function executeConsegnaCommercialista($forward=true)
  {
    $id = $this->getRequestParameter('id', 0);
    $fattura = FatturaPeer::getFatturaOrCreate($id, $this->cliente);
    $fattura->setCommercialista($fattura->getCommercialista() == 'n' ? 's' : 'n');
    $fattura->save();

    if ($forward)
    {
      $this->forward('fattura', $this->getRequestParameter('redirect', 'show'));
    }
  }

  public function executeCalcolaRitenuta()
  {
    $id = $this->getRequestParameter('id', 0);
    $fattura = FatturaPeer::getFatturaOrCreate($id, $this->cliente);
    
    if ($fattura->getCalcolaRitenutaAcconto() == 's')
      $fattura->setCalcolaRitenutaAcconto('n');
    elseif ($fattura->getCalcolaRitenutaAcconto() == 'n')
      $fattura->setCalcolaRitenutaAcconto('a');
    elseif ($fattura->getCalcolaRitenutaAcconto() == 'a')
      $fattura->setCalcolaRitenutaAcconto('s');

    $fattura->save();

    $this->forward('fattura', $this->getRequestParameter('redirect', 'show'));
  }

  public function executeIncludiTasse()
  {
    $id = $this->getRequestParameter('id', 0);
    $fattura = FatturaPeer::getFatturaOrCreate($id, $this->cliente);
    
    $fattura->setIncludiTasse($fattura->getIncludiTasse() == 'n' ? 's' : 'n');
    $fattura->save();

    $this->forward('fattura', $this->getRequestParameter('redirect', 'show'));
  }

  public function executeCalcolaTasse()
  {
    $id = $this->getRequestParameter('id', 0);
    $fattura = FatturaPeer::getFatturaOrCreate($id, $this->cliente);
    
    $fattura->setCalcolaTasse($fattura->getCalcolaTasse() == 'n' ? 's' : 'n');
    $fattura->save();

    $this->forward('fattura', $this->getRequestParameter('redirect', 'show'));
  }

  public function executeExport()
  {
    $id = $this->getRequestParameter('id', 0);
    $this->fattura = FatturaPeer::getFatturaOrCreate($id, $this->cliente);
    if ($this->fattura->getIdTemaFattura())
    {
      $this->fattura->calcolaFattura(TassaPeer::doSelect(new Criteria()), UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      return sfView::SUCCESS;
    }
    return sfView::ERROR;
  }

  public function executeCopia()
  {
    if ($this->checkBloccoFattura())
    {
      $this->setTemplate('blocco');
      return sfView::SUCCESS;
    }

    if ($this->getRequestParameter('id'))
    {
      $fattura = VenditaPeer::retrieveByPK($this->getRequestParameter('id'));
      $this->forward404Unless($fattura instanceof Fattura);

      $new_fattura = $fattura->copy(true);
      $new_fattura->setNewNumFattura();
      $new_fattura->setData(date('Y-m-d', time()));
      $new_fattura->setStato('n');
      $new_fattura->setIvaPagata('n');
      $new_fattura->setCommercialista('n');
      $new_fattura->setIvaDepositata('n');
      $new_fattura->save();
      $this->getRequest()->setParameter('id', $new_fattura->getID());

      if ($this->getRequestParameter('actions'))
      {
        $this->forward('fattura', $this->getRequestParameter('actions'));
      }
    }

    if ($_SERVER['HTTP_REFERER'] != '')
    {
      $referer = explode('/', str_replace('http://', '', $_SERVER['HTTP_REFERER']));
      if (in_array('cliente', $referer))
      {
        $this->redirect('@contact_show?id=' . $referer[4]);
      }
    }

    $this->redirect($this->getUser()->getReferer('@invoice'));
  }

  private function checkBloccoFattura()
  {
    return false;
  }

  private function makeFattura()
  {
    if ($this->getRequestParameter('id_cliente'))
    {
      $this->id_cliente = $this->getRequestParameter('id_cliente');
      $this->cliente = ClientePeer::retrieveByPK($this->id_cliente);
      $this->forward404Unless($this->cliente instanceof Cliente);

      if ($this->fattura->isNew() && UtentePeer::getImpostazione()->getBoolFatturaAutomatica())
      {
        $this->getRequest()->setParameter('cliente_id', $this->cliente->getID());
        $this->getRequest()->setParameter('modo_pagamento_id', $this->cliente->getModoPagamentoID());
        $this->getRequest()->setParameter('vat', '20');
        $this->getRequest()->setParameter('sconto', '0');
        $this->getRequest()->setParameter('spese_anticipate', '0');
        $this->getRequest()->setParameter('calcola_ritenuta_acconto', $this->cliente->getCalcolaRitenutaAcconto());
        $this->getRequest()->setParameter('includi_tasse', $this->cliente->getIncludiTasse());
        $this->getRequest()->setParameter('calcola_tasse', $this->cliente->getCalcolaTasse());
        $this->getRequest()->setParameter('data', date("d/m/Y", time()));
        $this->getRequest()->setParameter('num_fattura', $this->fattura->getNumFattura());
		$this->getRequest()->setParameter('id_tema_fattura', $this->fattura->getIdTemaFattura());
        $this->updateFattura($this->fattura);
      }
    }

    if ($this->getRequestParameter('modifica_data'))
    {
      $this->modifica_data = true;
      $this->getUser()->setAttribute('modifica_data', true);
    }

    if ($this->getRequestParameter('modifica_num_fattura'))
    {
      $this->modifica_num_fattura = true;
      $this->getUser()->setAttribute('modifica_num_fattura', true);
    }
  }

  private function updateFattura($fattura)
  {

    if ($this->checkBloccoFattura() && $fattura->isNew())
    {
      $this->setTemplate('blocco');
      return sfView::SUCCESS;
    }

    $i18n = new sfI18N($this->getContext()->getConfiguration());
    list($d, $m, $y) = $i18n->getDateForCulture($this->getRequestParameter('data'), $this->getUser()->getCulture());

    $fattura->setData("$y-$m-$d");

    if (date('y', strtotime($fattura->getData())) != date('y', mktime(0, 0, 0, $m, $d, $y)))
    {
      $fattura->setNewNumFattura();
    }
    else
    {
      $fattura->setNumFattura($this->getRequestParameter('num_fattura'));
    }

    if ($this->getRequestParameter('proforma') == 'y')
    {
      $fattura->setNumFattura(0);
    }

    if (!$fattura->isNew() && $fattura->isProForma() && $this->getRequestParameter('proforma') != 'y')
    {
      $fattura->setRegolare();
    }

    try
    {
      $fattura->setClienteId($this->getRequestParameter('cliente_id'));
      $fattura->setModoPagamentoId($this->getRequestParameter('modo_pagamento_id'));
      $fattura->setSconto($this->getRequestParameter('sconto'));
      $fattura->setVat($this->getRequestParameter('vat'));
      $fattura->setNote($this->getRequestParameter('note'));
      $fattura->setSpeseAnticipate($this->getRequestParameter('spese_anticipate'));
      $fattura->setCalcolaRitenutaAcconto($this->getRequestParameter('calcola_ritenuta_acconto'));
      $fattura->setIncludiTasse($this->getRequestParameter('includi_tasse'));
      $fattura->setCalcolaTasse($this->getRequestParameter('calcola_tasse'));
      $fattura->setIdUtente($this->getUser()->getAttribute('id_utente'));
      $fattura->save();
      
      $fattura->setIdTemaFattura($this->getRequestParameter('id_tema_fattura'));
      $fattura->save();
    }
    catch(Exception $e)
    {
      $this->fattura = $fattura;
      $this->error_message = $e->getMessage();
      $this->setTemplate('edit');
      return sfView::SUCCESS;
    }

    $this->getUser()->setAttribute('modifica_data', false);
    $this->getUser()->setAttribute('modifica_num_fattura', false);

    return $this->redirect('fattura/show?id=' . $fattura->getId());
  }

  private function getViewSconto()
  {
    $trovato = false;
    foreach ($this->dettagliFattura as $dettaglio)
    {
      if ($dettaglio->getSconto() > 0)
      {
        $trovato = true;
      }
    }
    return $trovato;
  }

  private function setRegolare()
  {
    $fattura->setNewNumfattura();
  }

  public function handleErrorUpdate()
  {
    $this->getRequest()->setParameter('id_cliente', $this->getRequestParameter('cliente_id'));

    if (!$this->getRequestParameter('id', 0))
    {
      $this->forward('fattura', 'create');
    }
    else
    {
      $this->forward('fattura', 'edit');
    }
  }

}
