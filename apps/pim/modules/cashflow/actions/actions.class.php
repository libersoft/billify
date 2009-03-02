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
    if ($this->form->isValid()) {
      $document = $this->form->save();
      $document->setIdUtente($this->getUser()->getAttribute('id_utente'));
      $document->save();
      
      return $document;
    }

    return false;
  }
  
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex($request) 
  {
    $c = new Criteria();
    
    $c = new Criteria();
    $c->addAscendingOrderByColumn(FatturaPeer::DATA);
    
    $documents = FatturaPeer::doSelect($c);
    
    $this->cf = new CashFlow();
    
    foreach ($documents as $index => $document) 
    {
      if($document instanceof Vendita ) 
      {
        $document->calcolaFattura();
        $cash_flow_vendita = new CashFlowSalesAdapter($document);
        $this->cf->addIncoming($cash_flow_vendita); 
      }
      elseif($document instanceof Acquisto)
      {
        $cash_flow_acquisto = new CashFlowPurchaseAdapter($document);
        $this->cf->addOutcoming($cash_flow_acquisto);
      }
      elseif($document instanceof Entrata)
      {
        $cash_flow_entrance = new CashFlowEntranceAdapter($document);
        $this->cf->addIncoming($cash_flow_entrance); 
      }
      
    }
  }
  
  public function executeCreate($request)
  {
    $this->forward('cashflow', 'edit');
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
        $this->redirect('cashflow/edit?id='.$contact->getId());
      }
    }
  }
}
