<?php

class VenditaPager extends FatturaPager
{ 
  public function __construct(sfUser $user, $request)
  {
    $this->filter = new VenditaFormFilter();
    
    parent::__construct('Vendita', $user->getSettings()->getNumFatture(), $request);

    $this->setPeerMethod('doSelectJoinAllExceptModoPagamento');
    $this->setPeerCountMethod('doCountJoinAllExceptModoPagamento');
  }

  public function setCriteria($criteria)
  {
    $criteria->addAsColumn('integer_num_fattura', 'CONVERT('.FatturaPeer::NUM_FATTURA.', signed)');
    $criteria->addDescendingOrderByColumn('integer_num_fattura');
    //$criteria->addAscendingOrderByColumn('integer_num_fattura');
    parent::setCriteria($criteria);
  }

}

