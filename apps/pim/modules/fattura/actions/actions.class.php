<?php

class fatturaActions extends sfActions
{

  private function update($request)
  {
    $this->form->bind($request->getParameter('fattura'));
    if ($this->form->isValid()) 
    {
      $fattura = $this->form->save();
      //gestione proforma
      $i18n = new sfI18N($this->getContext()->getConfiguration());
      list($d, $m, $y) = $i18n->getDateForCulture($request->getPostParameter('fattura[data]'), $this->getUser()->getCulture());

      if (date('y', strtotime($fattura->getData())) != date('y', mktime(0, 0, 0, $m, $d, $y)))
      {
        $fattura->setNewNumFattura();
      }
      else
      {
        $fattura->setNumFattura($request->getPostParameter('fattura[num_fattura]'));
      }
      
      if ($request->getPostParameter('fattura[pro_forma]') == 's')
      {
        $fattura->setNumFattura(0);
      }

      if (!$this->form->isNew() && $fattura->isProForma() && $request->getPostParameter('fattura[pro_forma]') != 's')
      {
        $fattura->setRegolare();
      }
      
      $fattura->setIdUtente($this->getUser()->getAttribute('id_utente'));
      $fattura->save();
      return $fattura;
    }
    return false;
  }
  
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

  public function executeEdit($request)
  {
    $fatturaId = $request->getPostParameter('fattura[id]', $request->getParameter('id'));
    $fatturaCliente = $request->getParameter('id_cliente');
    $cliente = ContattoPeer::retrieveByPK($fatturaCliente);
    $fattura = FatturaPeer::getFatturaOrCreate($fatturaId, $cliente);
    
    $this->form = new VenditaForm($fattura);
    
    if($fattura->isProForma() && !$this->form->isNew())
    {
      $this->form->setDefault('pro_forma', 's');
    }
    else
    {
      $this->form->setDefault('pro_forma', 'n');
    }
        
    list($y, $m, $d) = explode('-', $fattura->getData());
    $this->form->setDefault('data', $d.'/'.$m.'/'.$y);
        
    //fattura by cliente
    if($cliente)
    {
      //fattura automatica
      if ($this->form->isNew() && $this->getUser()->getSettings()->getBoolFatturaAutomatica()) //UtentePeer::getImpostazione()->getBoolFatturaAutomatica())
      {
        $this->getRequest()->setParameter('cliente_id', $cliente->getID());
        $this->getRequest()->setParameter('modo_pagamento_id', $cliente->getModoPagamentoID());
        $this->getRequest()->setParameter('vat', '20');
        $this->getRequest()->setParameter('sconto', '0');
        $this->getRequest()->setParameter('spese_anticipate', '0');
        $this->getRequest()->setParameter('calcola_ritenuta_acconto', $cliente->getCalcolaRitenutaAcconto());
        $this->getRequest()->setParameter('includi_tasse', $cliente->getIncludiTasse());
        $this->getRequest()->setParameter('calcola_tasse', $cliente->getCalcolaTasse());
        $this->getRequest()->setParameter('data', date("d/m/Y", time()));
        $this->getRequest()->setParameter('num_fattura', $fattura->getNumFattura());
        $this->getRequest()->setParameter('id_tema_fattura', $fattura->getIdTemaFattura());
      }
    
      if ($this->getRequestParameter('modifica_data'))
      {
        $this->getUser()->setAttribute('modifica_data', true);
      }

      if ($this->getRequestParameter('modifica_num_fattura'))
      {
        $this->getUser()->setAttribute('modifica_num_fattura', true);
      }
    }
        
    if($request->isMethod('post')) 
    {
      $fattura = $this->update($request);
      if($fattura) 
      {
        $this->getUser()->setAttribute('modifica_data', false);
        $this->getUser()->setAttribute('modifica_num_fattura', false);
        $this->redirect('fattura/show?id=' . $fattura->getId());
      }
    }
  }

  public function executeCreate($request)
  {
    $this->forward('fattura', 'edit');
  }
  
  public function executeDelete($forward = true)
  {
    $fattura = VenditaPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($fattura instanceof Fattura);
    $this->redirectUnless($fattura->isEditable(), 'fattura/show?id='.$fattura->getId());
    
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

  public function executeStato($request)
  {
    $id = $this->getRequestParameter('id', 0);
    $fattura = FatturaPeer::getFatturaOrCreate($id, $this->cliente);
    $fattura->setStato($request->getParameter('stato', 'n'));

    if ($request->getParameter('data_stato'))
    {
      list($d, $m, $y) = $this->getContext()->getI18N()->getDateForCulture($request->getParameter('data_stato'), $this->getUser()->getCulture());
      $fattura->setDataStato("$y-$m-$d");
    }

    if ($fattura->isProForma() && $request->getParameter('regolare') == 'y')
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
}
