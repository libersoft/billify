<?php

class FatturaPager extends sfPropelPager
{
  protected $filter;
  protected $request;

  public function  __construct($class, $maxPerPage, $request)
  {
    $this->request = $request;
    
    parent::__construct($class, $maxPerPage);

    $this->setPage($this->request->getParameter('page', 1));
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

