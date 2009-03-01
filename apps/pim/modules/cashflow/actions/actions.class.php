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
    
    $invoices = FatturaPeer::doSelect($c);
    
    $this->cf = new CashFlow();
    
    foreach ($invoices as $index => $invoice) 
    {
      if($invoice instanceof Vendita ) 
      {
        $invoice->calcolaFattura();
        $cash_flow_vendita = new CashFlowSalesAdapter($invoice);
        $this->cf->addIncoming($cash_flow_vendita); 
      }
      elseif($invoice instanceof Acquisto)
      {
        $cash_flow_acquisto = new CashFlowPurchaseAdapter($invoice);
        $this->cf->addOutcoming($cash_flow_acquisto);
      }
      
    }
  }
}
