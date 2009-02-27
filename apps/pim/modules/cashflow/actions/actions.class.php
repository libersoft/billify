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
    $c->addDescendingOrderByColumn(FatturaPeer::DATA);
    
    $fatture = FatturaPeer::doSelect($c);
    
    $this->cf = new CashFlow();
    
    foreach ($fatture as $index => $fattura) 
    {
      if($fattura instanceof Vendita ) 
      {
        $fattura->calcolaFattura();
        $this->cf->addIncoming(new CashFlowVenditaAdapter($fattura)); 
      }
      elseif($fattura instanceof Acquisto)
      {
        $this->cf->addOutcoming(new CashFlowAcquistoAdapter($fattura));
      }
      
    }
  }
}
