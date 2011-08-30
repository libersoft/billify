<?php

/**
 * invoice actions.
 *
 * @package    sf_sandbox
 * @subpackage invoice
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class invoiceActions extends sfActions
{

  private function update($request)
  {
    $this->form->bind($request->getParameter('fattura'));
   
    if ($this->form->isValid())
    {
      $invoice = $this->form->save();
      $invoice->setIdUtente($this->getUser()->getAttribute('id_utente'));
      $invoice->save();

      return $invoice;
    }
    
    return false;
  }

  private function delete($request)
  {
    FatturaPeer::doDelete($request->getParameter('delete'));
  }
  
  public function executeIndexSale(sfWebRequest $request)
  {
    $this->getUser()->setReferer('@invoice');

    $this->pager = new VenditaPager($this->getUser(), $request);
    $this->pager->filter();
    $this->pager->init();

    $this->taxes = TassaPeer::doSelect(new Criteria());
    
    return (!$this->pager->count()) ? 'NoResults' : sfView::SUCCESS;
  }

  public function executeIndexPurchase(sfWebRequest $request)
  {
    $this->getUser()->setReferer('@invoice_purchase');

    $this->pager = new AcquistoPager($this->getUser(), $request);
    $this->pager->filter();
    $this->pager->init();

    return (!$this->pager->count()) ? 'NoResults' : sfView::SUCCESS;
  }

  public function executeBatch($request)
  {
    if($request->hasParameter('delete_button'))
    {
      $this->delete($request);
    }

    $this->redirect($request->getReferer($this->getUser()->getReferer('@invoices')));
  }
  
  public function executeDelete($request)
  {    
    $this->forward404Unless(FatturaPeer::doDelete($request->getParameter('id')), 'non trovo la fattura da cancellare');
    
    $this->redirect('@invoice_purchase');
            
  }

  public function executeEdit($request)
  {
    $factory = new FatturaFactoryForm();
    $this->form = $factory->build($request->getParameter('type'), FatturaPeer::retrieveByPk($request->getParameter('fattura[id]', $request->getParameter('id'))));
    unset($this->form['id_tema_fattura']);
    
    if ($request->getParameter('fornitore', null))
    {
      $this->form->setDefault('cliente_id', $request->getParameter('fornitore'));
    }
    
    if($request->isMethod('post'))
    {
      $invoice = $this->update($request);
      if($invoice)
      {
        $this->getUser()->setFlash('notice', 'invoice updated successfully');
        $this->redirect('contact/show?id='.$invoice->getClienteId());
      }
    }
  }

  public function executeCreate($request)
  {
    $this->forward('invoice', 'edit');
  }
}
