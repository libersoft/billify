<?php

/**
 * contatto actions.
 *
 * @package    sf_sandbox
 * @subpackage contatto
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class contactActions extends sfActions
{
  private function update($request)
  {
    $this->form->bind($request->getParameter('contatto'));
    if ($this->form->isValid()) {
      $contact = $this->form->save();
      $contact->setIdUtente($this->getUser()->getAttribute('id_utente'));
      $contact->save();

      return $contact;
    }

    return false;

  }

  public function executeIndex($request)
  {
    $criteria = new Criteria();
    $criteria->add(ContattoPeer::CLASS_KEY, $request->getParameter('type', ContattoPeer::CLASSKEY_CLIENTE));
    $criteria->addAscendingOrderByColumn(ContattoPeer::RAGIONE_SOCIALE );

    $this->pager = new sfPropelPager('Contatto', UtentePeer::getImpostazione()->getNumClienti());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->setCriteria($criteria);
    $this->pager->init();

    if(!$this->pager->getNbResults())
    {
      return 'NoResults';
    }

  }

  public function executeShow($request)
  {
    $this->contact = ContattoPeer::retrieveByPK($request->getParameter('id'));

    $this->criteria = new Criteria();
    $invoice_repository = VenditaPeer::getInstance();
    $invoice_repository->filterByYearCriteria($request->getParameter('year', date('Y')), $this->criteria);
    $invoice_repository->sortCriteria($this->criteria);
    $this->totale = 0;
  }

  public function executeEdit($request)
  {
    $factory = new ContactFactoryForm();
    $this->form = $factory->build($request->getParameter('contatto[class_key]', $request->getParameter('type')), ContattoPeer::retrieveByPk($request->getParameter('contatto[id]', $request->getParameter('id'))));

    if($request->isMethod('post')) {
      $contact = $this->update($request);
      if($contact) {
        $this->redirect('@contact_show?id='.$contact->getId());
      }
    }
  }

  public function executeCreate($request)
  {
    $this->forward('contact', 'edit');
  }

  public function executeDelete($request)
  {
   $this->forward404Unless($contact = ContattoPeer::retrieveByPK($request->getParameter('id')));

   $contact->delete();

   $this->redirect('contact/index?type='.$contact->getClassKey());
  }
}
