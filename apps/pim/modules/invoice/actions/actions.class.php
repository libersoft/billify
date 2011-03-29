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
    $criteria = new Criteria();

    $this->getUser()->setReferer('@invoice');

    $this->filter = new VenditaFormFilter();
    $this->filter->bind($request->getParameter($this->filter->getName(), $this->filter->getDefaultFilter()));
    if($this->filter->isValid())
    {
      $criteria= $this->filter->getCriteria();
    }

    VenditaPeer::getInstance()->sortCriteria($criteria);
    
    $this->pager = new sfPropelPager('Vendita', UtentePeer::getImpostazione()->getNumFatture());
    $this->pager->setCriteria($criteria);
    $this->pager->setPage($this->getRequestParameter('page',1));
    $this->pager->setPeerMethod('doSelectJoinAllExceptModoPagamento');
    $this->pager->setPeerCountMethod('doCountJoinAllExceptModoPagamento');
    $this->pager->init();

    $this->taxes = TassaPeer::doSelect(new Criteria());
    
    if(0 == $this->pager->count())
    {
      return 'NoResults';
    }
  }

  public function executeIndexPurchase(sfWebRequest $request)
  {
    $criteria = new Criteria();

    $this->getUser()->setReferer('@invoice_purchase');

    $this->filter = new AcquistoFormFilter();
    $this->filter->bind($request->getParameter($this->filter->getName(), $this->filter->getDefaultFilter()));
    if($this->filter->isValid())
    {
      $criteria= $this->filter->getCriteria();
    }

    $criteria->addAscendingOrderByColumn(FatturaPeer::DATA);
    
    $this->pager = new sfPropelPager('Acquisto', UtentePeer::getImpostazione()->getNumFatture());
    $this->pager->setCriteria($criteria);
    $this->pager->setPage($this->getRequestParameter('page', 1));
    $this->pager->init();
    
    if(0 == $this->pager->count())
    {
      return 'NoResults';
    }
  }

  public function executeBatch($request)
  {
    if($request->hasParameter('delete_button'))
    {
      $this->delete($request);
    }

    $this->redirect($request->getReferer($this->getUser()->getReferer('@invoices')));
  }

  public function executeEdit($request)
  {
    $factory = new FatturaFactoryForm();
    $this->form = $factory->build($request->getParameter('type'), FatturaPeer::retrieveByPk($request->getParameter('fattura[id]', $request->getParameter('id'))));

    if($request->isMethod('post'))
    {
      $invoice = $this->update($request);
      if($invoice)
      {
        $this->redirect('invoice/edit?id='.$invoice->getId());
      }
    }
  }

  public function executeCreate($request)
  {
    $this->forward('invoice', 'edit');
  }
}
