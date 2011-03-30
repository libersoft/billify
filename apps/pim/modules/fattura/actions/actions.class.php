<?php

include_once('propel/util/Criteria.php');

/**
 * fattura actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage fattura
 * @author     Your name here
 * @version    SVN: $Id$
 */
class fatturaActions extends sfActions
{

  public function executeShow ()
  {
    $this->getUser()->setAttribute('conta_dettagli',0);
    $this->getUser()->setAttribute('dettagli_in_modifica',array());
    $this->getUser()->setAttribute('modifica_data',false);
    $this->getUser()->setAttribute('modifica_num_fattura',false);
    $this->fattura = VenditaPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($this->fattura instanceof Fattura);

    if($this->fattura->getDataStato() == "" || is_null($this->fattura->getDataStato()))
    $this->fattura->setDataStato(date('m/d/y',time()));

    $this->dettagliFattura = $this->fattura->getDettagliFatturas();
    $this->fattura->calcolaFattura(TassaPeer::doSelect(new Criteria()), UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
    $this->viewSconto = $this->getViewSconto();
  }

  public function executeCreate ()
  {
    if($this->checkBloccoFattura())
    {
      return sfView::SUCCESS;
    }

    $this->fattura = new Fattura();
    $this->fattura->setData(time());
    $this->fattura->setNewNumFattura();
    if($this->id_cliente)
    {
      $this->fattura->setModoPagamentoId($this->cliente->getModoPagamentoID());
    }

    $this->makeFattura();

    $this->setTemplate('edit');
  }

  public function executeEdit ()
  {
    $this->fattura = VenditaPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->fattura instanceof Fattura);
    $this->makeFattura();
  }

  public function executeUpdate ()
  {
    $fattura = $this->getFatturaOrCreate();
    return $this->updateFattura($fattura);
  }

  public function executeDelete ($forward = true)
  {
    $fattura = VenditaPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($fattura instanceof Fattura);

    $fattura->delete();

    if($this->getRequestParameter('cliente_id') && $forward)
    {
      return $this->redirect('cliente/show?id='.$this->getRequestParameter('cliente_id'));
    }

    if($forward)
    {
      return $this->redirect('@invoice');
    }
  }

  public function executeStato()
  {
    $fattura = $this->getFatturaOrCreate();
    $fattura->setStato($this->getRequestParameter('stato','n'));

    if($this->getRequestParameter('data_stato'))
    {
      list($d, $m, $y) = $this->getContext()->getI18N()->getDateForCulture($this->getRequestParameter('data_stato'), $this->getUser()->getCulture());
      $fattura->setDataStato("$y-$m-$d");
    }

    if($fattura->isProForma() && $this->getRequestParameter('regolare')=='y')
    $fattura->setRegolare();

    $fattura->save();

    $this->forward('fattura','show');
  }

  public function executePagaiva()
  {
    $this->setFilter();
    $this->getTrimestre();

    $criteria = new criteria();
    $criteria->add(FatturaPeer::IVA_PAGATA,'n');
    $criteria->add(FatturaPeer::NUM_FATTURA,0,'>');
    $criteria->add(FatturaPeer::DATA ,date('y-m-d',mktime(0,0,0,$this->inizio_mese,1,$this->anno)),Criteria::GREATER_EQUAL);
    $criteria->addAnd(FatturaPeer::DATA ,date('y-m-d',mktime(0,0,0,$this->fine_mese,$this->fine_giorno,$this->anno)),Criteria::LESS_EQUAL);

    $fatturas = VenditaPeer::doSelect($criteria);

    foreach ($fatturas as $fattura)
    {
      $fattura->setIvaPagata('s');
      $fattura->save();
    }

    $this->forward('fattura','listAgain');
  }

  public function executeDepositaIva($forward=true)
  {
    $fattura = $this->getFatturaOrCreate();
    $fattura->setIvaDepositata($fattura->getIvaDepositata()=='n'?'s':'n');
    $fattura->save();

    if($forward)
    {
      $this->forward('fattura',$this->getRequestParameter('redirect','show'));
    }
  }

  public function executeConsegnaCommercialista($forward=true)
  {
    $fattura = $this->getFatturaOrCreate();
    $fattura->setCommercialista($fattura->getCommercialista()=='n'?'s':'n');
    $fattura->save();

    if($forward)
    {
      $this->forward('fattura',$this->getRequestParameter('redirect','show'));
    }
  }

  public function executeCalcolaRitenuta()
  {
    $fattura = $this->getFatturaOrCreate();
    if($fattura->getCalcolaRitenutaAcconto()=='s')
      $fattura->setCalcolaRitenutaAcconto('n');
    elseif($fattura->getCalcolaRitenutaAcconto()=='n')
      $fattura->setCalcolaRitenutaAcconto('a');
    elseif($fattura->getCalcolaRitenutaAcconto()=='a')
      $fattura->setCalcolaRitenutaAcconto('s');

    $fattura->save();

    $this->forward('fattura',$this->getRequestParameter('redirect','show'));
  }

  public function executeIncludiTasse()
  {
    $fattura = $this->getFatturaOrCreate();
    $fattura->setIncludiTasse($fattura->getIncludiTasse()=='n'?'s':'n');
    $fattura->save();

    $this->forward('fattura',$this->getRequestParameter('redirect','show'));
  }

  public function executeCalcolaTasse()
  {
    $fattura = $this->getFatturaOrCreate();
    $fattura->setCalcolaTasse($fattura->getCalcolaTasse()=='n'?'s':'n');
    $fattura->save();

    $this->forward('fattura',$this->getRequestParameter('redirect','show'));
  }

  public function executeExport()
  {
    $this->fattura = $this->getFatturaOrCreate();
    if($this->fattura->getCliente()->getIdTemaFattura())
    {
      $this->fattura->calcolaFattura(TassaPeer::doSelect(new Criteria()), UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      return sfView::SUCCESS;
    }
    return sfView::ERROR;
  }

  public function executeActions()
  {
    if(count($this->getRequestParameter('ids'))>0)
    {
      switch($this->getRequestParameter('todo'))
      {
        case 'c':
          foreach ($this->getRequestParameter('ids') as $id){
                  $this->getRequest()->setParameter('id',$id);
                  $this->executeConsegnaCommercialista(false);
          }
          break;
        case 'i':
          foreach ($this->getRequestParameter('ids') as $id){
                  $this->getRequest()->setParameter('id',$id);
                  $this->executeDepositaIva(false);
          }
          break;
        case 'd':
          foreach ($this->getRequestParameter('ids') as $id){
                  $this->getRequest()->setParameter('id',$id);
                  $this->executeDelete(false);
          }
          break;
      }
    }
    $this->forward('fattura','listAgain');
  }

  public function executeCopia()
  {
    if($this->checkBloccoFattura())
    {
      $this->setTemplate('blocco');
      return sfView::SUCCESS;
    }

    if($this->getRequestParameter('id'))
    {
      $fattura = VenditaPeer::retrieveByPK($this->getRequestParameter('id'));
      $this->forward404Unless($fattura instanceof Fattura);

      $new_fattura = $fattura->copy(true);
      $new_fattura->setNewNumFattura();
      $new_fattura->setData(date('Y-m-d',time()));
      $new_fattura->setStato('n');
      $new_fattura->setIvaPagata('n');
      $new_fattura->setCommercialista('n');
      $new_fattura->setIvaDepositata('n');
      $new_fattura->save();
      $this->getRequest()->setParameter('id',$new_fattura->getID());

      if($this->getRequestParameter('actions'))
      {
        $this->forward('fattura',$this->getRequestParameter('actions'));
      }
    }

    if($_SERVER['HTTP_REFERER'] != '')
    {
      $referer = explode('/',str_replace('http://','',$_SERVER['HTTP_REFERER']));
      if(in_array('cliente',$referer))
      {
        $this->redirect('cliente/show?id='.$referer[4]);
      }

    }

    $this->redirect($this->getUser()->getReferer('@invoice'));
  }

  public function executeAddTag()
  {
    if($this->hasRequestParameter('id_fattura')){
    $tags = explode(' ',$this->getRequestParameter('new_tag'));
    $tags = array_reverse($tags);
    foreach($tags as $tag){
            $tag_fattura = new TagsFattura();
            $tag_fattura->setIdFattura($this->getRequestParameter('id_fattura'));
            $tag_fattura->setIdUtente($this->getUser()->getAttribute('id_utente'));
            $tag_fattura->setTag($tag);
            $tag_fattura->setData(date('y-m-d',time()));

            try{
                    $tag_fattura->save();
            }catch (Exception $e){
                    $this->getRequest()->setError('tag','Il tag esiste gi&agrave;');
            }
    }
            $this->fattura = VenditaPeer::retrieveByPK($this->getRequestParameter('id_fattura'));
    }
  }

  public function executeDeleteTag()
  {
    if($this->hasRequestParameter('id_tag'))
    {
      TagsFatturaPeer::doDelete($this->getRequestParameter('id_tag'));
      $this->fattura = VenditaPeer::retrieveByPK($this->getRequestParameter('id_fattura'));
      $this->setTemplate('addTag');
    }
  }

  public function executeTagAutocomplete()
  {
    $this->tags = TagsFatturaPeer::getTagsForUserLike($this->getUser()->getAttribute('id_utente'), $this->getRequestParameter('new_tag'), 10);
  }

  public function executeTags()
  {
    $this->tags = TagsFatturaPeer::getPopularTags(0);
  }

  private function setFilter()
  {
    if($this->getRequestParameter('anno'))
    {
      $this->anno = $this->getRequestParameter('anno');
      $this->getUser()->setAttribute('anno',$this->anno);
    }
    else
    {
      if($this->getUser()->hasAttribute('anno'))
      {
        $this->anno = $this->getUser()->getAttribute('anno');
      }
      else
      {
        $this->anno = date('Y',time());
      }
    }

    if($this->getRequestParameter('stato'))
    {
      $this->stato = $this->getRequestParameter('stato');
      $this->getUser()->setAttribute('stato',$this->stato);
    }
    else
    {
      if($this->getUser()->hasAttribute('stato'))
      {
        $this->stato = $this->getUser()->getAttribute('stato');
      }
      else
      {
        $this->stato = 'all';
      }
    }

    if($this->getRequestParameter('trimestre'))
    {
      $this->trimestre = $this->getRequestParameter('trimestre');
      $this->getUser()->setAttribute('trimestre',$this->trimestre);
    }
    else
    {
      if($this->getUser()->hasAttribute('trimestre'))
      {
        $this->trimestre = $this->getUser()->getAttribute('trimestre');
      }
      else
      {
        $this->trimestre = 'all';
      }
    }

    if($this->getRequestParameter('tipo'))
    {
      $this->tipo = $this->getRequestParameter('tipo');
      $this->getUser()->setAttribute('tipo',$this->tipo);
    }
    else
    {
      if($this->getUser()->hasAttribute('tipo'))
      {
        $this->tipo = $this->getUser()->getAttribute('tipo');
      }
      else
      {
        $this->tipo = 'all';
      }
    }

    if($this->getRequest()->hasParameter('cliente'))
    {
      $this->cliente = $this->getRequestParameter('cliente');
      $this->getUser()->setAttribute('cliente',$this->cliente);
    }
    else
    {
      if($this->getUser()->hasAttribute('cliente'))
      {
        $this->cliente = $this->getUser()->getAttribute('cliente');
      }
      else
      {
        $this->cliente = '';
      }
    }
  }

  private function getTrimestre()
  {
    switch ($this->trimestre) {
      case 'all':
        $this->inizio_mese = 1;
        $this->fine_mese = 12;
        $this->fine_giorno = 31;
        break;
      case 1:
        $this->inizio_mese = 1;
        $this->fine_mese = 3;
        $this->fine_giorno = 31;
        break;
      case 2:
        $this->inizio_mese = 4;
        $this->fine_mese = 6;
        $this->fine_giorno = 30;
        break;
      case 3:
        $this->inizio_mese = 7;
        $this->fine_mese = 9;
        $this->fine_giorno = 30;
        break;
      case 4:
        $this->inizio_mese = 10;
        $this->fine_mese = 12;
        $this->fine_giorno = 31;
        break;
      default:
        $this->inizio_mese = 1;
        $this->fine_mese = 12;
        $this->fine_giorno = 31;
        break;
    }
  }

  private function checkBloccoFattura()
  {
    return false;
  }

  private function makeFattura()
  {
    if($this->getRequestParameter('id_cliente'))
    {
      $this->id_cliente = $this->getRequestParameter('id_cliente');
      $this->cliente = ClientePeer::retrieveByPK($this->getRequestParameter('id_cliente'));
      $this->forward404Unless($this->cliente instanceof Cliente);

      if($this->fattura->isNew() && UtentePeer::getImpostazione()->getBoolFatturaAutomatica())
      {
        $this->getRequest()->setParameter('cliente_id',$this->cliente->getID());
        $this->getRequest()->setParameter('modo_pagamento_id',$this->cliente->getModoPagamentoID());
        $this->getRequest()->setParameter('vat','20');
        $this->getRequest()->setParameter('sconto','0');
        $this->getRequest()->setParameter('spese_anticipate','0');
        $this->getRequest()->setParameter('calcola_ritenuta_acconto',$this->cliente->getCalcolaRitenutaAcconto());
        $this->getRequest()->setParameter('includi_tasse',$this->cliente->getIncludiTasse());
        $this->getRequest()->setParameter('calcola_tasse',$this->cliente->getCalcolaTasse());
        $this->getRequest()->setParameter('data',date("d/m/Y",time()));
        $this->getRequest()->setParameter('num_fattura',$this->fattura->getNumFattura());
        $this->updateFattura($this->fattura);
      }
    }

    if($this->getRequestParameter('modifica_data'))
    {
      $this->modifica_data = true;
      $this->getUser()->setAttribute('modifica_data',true);
    }

    if($this->getRequestParameter('modifica_num_fattura'))
    {
      $this->modifica_num_fattura = true;
      $this->getUser()->setAttribute('modifica_num_fattura',true);
    }
  }

  private function updateFattura($fattura)
  {

    if($this->checkBloccoFattura() && $fattura->isNew())
    {
            $this->setTemplate('blocco');
            return sfView::SUCCESS;
    }

    $i18n = new sfI18N($this->getContext()->getConfiguration());
    list($d, $m, $y) = $i18n->getDateForCulture($this->getRequestParameter('data'), $this->getUser()->getCulture());

    $fattura->setData("$y-$m-$d");

    if(date('y', strtotime($fattura->getData())) != date('y', mktime(0, 0, 0, $m, $d, $y)))
    {
            $fattura->setNewNumFattura();
    }
    else
    {
            $fattura->setNumFattura($this->getRequestParameter('num_fattura'));
    }

    if($this->getRequestParameter('proforma') == 'y')
    {
            $fattura->setNumFattura(0);
    }

    if(!$fattura->isNew() && $fattura->isProForma() && $this->getRequestParameter('proforma') != 'y')
    {
            $fattura->setRegolare();
    }

    if($this->checkFatturaExist($fattura))
    {
      return sfView::ERROR;
    }

    //$fattura->setId($this->getRequestParameter('id'));
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

    $this->getUser()->setAttribute('modifica_data',false);
    $this->getUser()->setAttribute('modifica_num_fattura',false);

    return $this->redirect('fattura/show?id='.$fattura->getId());

  }

  private function checkFatturaExist($fattura)
  {
    $id = $fattura->getNumFattura();
    $anno = $fattura->getData('Y');
    $this->fattura = $fattura;

    $criteria = new Criteria();
    $criteria->add(FatturaPeer::NUM_FATTURA, $fattura->getNumFattura());
    $fatture = VenditaPeer::doSelect($criteria);
    $trovato = false;
    foreach($fatture as $fattura_find)
    {
      if($fattura_find->getNumFattura() != '0' && $fattura_find->getData('Y') == $anno && $fattura_find->getID() != $fattura->getID())
      {
        $trovato = true;
        break;
      }
    }
    return $trovato;
  }

  private function getFatturaOrCreate ($id = 'id')
  {
    if (!$this->getRequestParameter($id, 0))
    {
      $fattura = new Fattura();
      $fattura->setData(time());
      $fattura->setNewNumFattura();
      if($this->id_cliente)
      {
        $fattura->setModoPagamentoId($this->cliente->getModoPagamentoID());
      }
    }
    else
    {
      $fattura = VenditaPeer::retrieveByPk($this->getRequestParameter($id));
      $this->forward404Unless($fattura instanceof Fattura);
    }

    return $fattura;
  }

  public function getViewSconto()
  {
    $trovato = false;
    foreach( $this->dettagliFattura as $dettaglio )
    {
      if($dettaglio->getSconto() > 0)
      {
        $trovato = true;
      }
    }
    return $trovato;
  }

  public function setProForma()
  {
    if($this->getRequestParameter('id'))
    {
      $fattura = $this->getFatturaOrCreate();
      $fattura->setNumFattura(0);
      $fattura->save();
    }
    else
    {
      $this->forward404();
    }
  }

  public function setRegolare()
  {
    $fattura->setNewNumfattura();
  }

  public function handleErrorUpdate()
  {
    $this->getRequest()->setParameter('id_cliente',$this->getRequestParameter('cliente_id'));

    if(!$this->getRequestParameter('id',0))
    {
      $this->forward('fattura','create');
    }
    else
    {
      $this->forward('fattura','edit');
    }
  }
  
}
