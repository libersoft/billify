<?php

class VenditaPager extends sfPropelPager
{
  private $vendita;
  private $filter;
  private $request;
  
  public function __construct(sfUser $user, $request)
  {
    $this->vendita = VenditaPeer::getInstance();;
    $this->filter = new VenditaFormFilter();
    $this->request = $request;

    parent::__construct('Vendita', $user->getSettings()->getNumFatture());

    $this->setPage($this->request->getParameter('page', 1));
    $this->setPeerMethod('doSelectJoinAllExceptModoPagamento');
    $this->setPeerCountMethod('doCountJoinAllExceptModoPagamento');
  }

  public function setCriteria($criteria)
  {
    $this->vendita->sortCriteria($criteria);
    parent::setCriteria($criteria);
  }

  public function filter()
  {
    $this->filter->bind($this->request->getParameter($this->filter->getName(), $this->filter->getDefaultFilter()));
    if($this->filter->isValid())
    {
      $this->setCriteria($this->filter->getCriteria());
    }
  }

  public function getFilter()
  {
    return $this->filter;
  }
}

