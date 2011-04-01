<?php

class invoiceComponents extends paComponents
{
  public function executeMonitor($request)
  {
    $criteria = new Criteria;

    $filter = new VenditaFormFilter();
    $filter->bind($request->getParameter($filter->getName(), $filter->getDefaultFilter()));
    if($filter->isValid())
    {
      $criteria = $filter->getCriteria();
    }

    $this->cf = CashFlow::getInstance();
    $this->cf->setWithTaxes(false);
    $this->cf->addDocuments(FatturaPeer::doSelectJoinAllExceptModoPagamento($criteria));
  }
}
