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
    if ($this->form->isValid()) {
      $invoice = $this->form->save();
      $invoice->setIdUtente($this->getUser()->getAttribute('id_utente'));
      $invoice->save();

      return $invoice;
    }

    return false;

  }

  private function delete($request) {
    FatturaPeer::doDelete($request->getParameter('delete'));
  }

  public function executeIndex($request)
  {
    $acquisto_peer = new AcquistoPeer($this->getUser());
    $this->invoices = $acquisto_peer->doSelect();

    if(!count($this->invoices))
    {
      return 'NoResults';
    }
  }

  public function executeBatch($request)
  {
    if($request->hasParameter('delete_button')) {
      $this->delete($request);
    }

    $this->redirect('invoice/index');
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
