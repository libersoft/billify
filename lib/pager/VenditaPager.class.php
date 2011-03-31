<?php

class VenditaPager extends FatturaPager
{ 
  public function __construct(sfUser $user, $request)
  {
    $this->peer = VenditaPeer::getInstance();;
    $this->filter = new VenditaFormFilter();
    
    parent::__construct('Vendita', $user->getSettings()->getNumFatture(), $request);

    $this->setPeerMethod('doSelectJoinAllExceptModoPagamento');
    $this->setPeerCountMethod('doCountJoinAllExceptModoPagamento');
  }

  public function setCriteria($criteria)
  {
    $this->peer->sortCriteria($criteria);
    parent::setCriteria($criteria);
  }

}

