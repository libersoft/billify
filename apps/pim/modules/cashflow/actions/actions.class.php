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
    
    $this->cf = new CashFlow();
    $this->cf->addDocuments(FatturaPeer::doSelectForCashFlow($this->getUser()->getAttribute($this->filter->getName().'[document_date]')));
    
    $this->pager = new CashFlowPaginator($this->cf);
    $this->pager->setLimit('10');
    $this->pager->setPage($request->getParameter('page', 1));
    
    if ($request->getParameter('page') != 'all')
    {
      $this->cf = $this->pager;
    }
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

    /*if($request->hasParameter('type') && $request->getParameter('type') == 4)
    {
      print_r($document);
      var_dump($id);
      die('qui');
    }*/


    if($request->isMethod('post'))
    {
      $contact = $this->update($request);
      if($contact)
      {
        $this->redirect('cashflow/edit?id='.$contact->getId());
      }
    }
  }
}
