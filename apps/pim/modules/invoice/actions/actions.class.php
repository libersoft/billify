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
    $criteria = new Criteria();
    $criteria->add(FatturaPeer::CLASS_KEY, $request->getParameter('type', FatturaPeer::CLASSKEY_ACQUISTO));
    $criteria->add(FatturaPeer::ID_UTENTE, $this->getUser()->getAttribute('id_utente'));
    $criteria->addAscendingOrderByColumn(FatturaPeer::DATA );

    $this->invoices = FatturaPeer::doSelect($criteria);

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
      $contact = $this->update($request);
      if($contact)
      {
        $this->redirect('invoice/edit?id='.$contact->getId());
      }
    }
  }

  public function executeCreate($request)
  {
    $this->forward('invoice', 'edit');
  }
}
