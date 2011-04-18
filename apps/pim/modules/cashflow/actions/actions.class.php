<?php

/**
 * cashflow actions.
 *
 * @package    sf_sandbox
 * @subpackage cashflow
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class cashflowActions extends sfActions
{

  private function update($request)
  {
    $this->form->bind($request->getParameter('fattura'));
    if ($this->form->isValid())
    {
      $document = $this->form->save();
      $document->setIdUtente($this->getUser()->getAttribute('id_utente'));
      $document->save();

      return $document;
    }

    return false;
  }

  private function filter($request)
  {
    $this->filter = new CashFlowFilter();

    if (!$this->getUser()->hasAttribute($this->filter->getName()))
    {
      $this->getUser()->setAttribute($this->filter->getName(), $this->filter->getDefaultFilter());
    }

    if ($request->hasParameter($this->filter->getName()))
    {
      $this->getUser()->setAttribute($this->filter->getName(), $request->getParameter($this->filter->getName()));
    }
    
    $this->filter->bind($this->getUser()->getAttribute($this->filter->getName()));
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex($request)
  {
    $this->filter($request);

    $this->pager = new CashFlowPager();

    $data_range = $this->getUser()->getAttribute($this->filter->getName().'[document_date]');

    $from = DateTime::createFromFormat('d/m/Y', $data_range['from']);
    $to = DateTime::createFromFormat('d/m/Y', $data_range['to']);

    if ($from && $to)
    {
      $this->pager->getCriteria()->addDateTimeRange($from, $to);
    }
    
    $this->pager->setLimit(sfConfig::get('app_cashflow_paginator_offset', 10));
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    
    if (!$this->pager->getCountAllResults())
    {
      return 'NoResults';
    }

    $this->cf = $this->pager;
  }

  public function executeCreate($request)
  {
    $this->forward('cashflow', 'edit');
  }

  public function executeEdit($request)
  {
    $id = null;

    if(!is_null($request->getParameter('id')))
    {
      $id = $request->getParameter('id');
    }

    if(!is_null($request->getParameter('fattura[id]')))
    {
      $id = $request->getParameter('fattura[id]');
    }

    $document = FatturaPeer::retrieveByPk($id);

    $factory = new FatturaFactoryForm();
    $this->form = $factory->build($request->getParameter('type'), $document);
    
    if($request->isMethod('post'))
    {
      $contact = $this->update($request);
      if($contact)
      {
        $this->getUser()->setFlash('notice', 'document updated successfully');
        $this->redirect('cashflow/edit?id='.$contact->getId());
      }
    }
  }

  public function executeRemove(sfWebRequest $request)
  {
    $this->forward404Unless($request->hasParameter('id'));

    $criteria = new Criteria();
    $criteria->add(FatturaPeer::CLASS_KEY, array(FatturaPeer::CLASSKEY_ENTRATA, FatturaPeer::CLASSKEY_USCITA), Criteria::IN);
    $criteria->add(FatturaPeer::ID, $request->getParameter('id'));
    $document = FatturaPeer::doSelectOne($criteria);

    $this->forward404Unless($document);

    $document->delete();

    $this->getUser()->setFlash('notice', 'Documento eliminato con successo');
    $this->redirect('@cashflow');
  }
}
