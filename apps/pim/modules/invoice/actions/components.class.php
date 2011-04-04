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

    $values = $filter->getValues();
    $this->from_date = $values['data']['from'];
    $this->to_date = $values['data']['to'];

    $this->cf = CashFlow::getInstance();
    $this->cf->setWithTaxes(false);
    $this->cf->addDocuments(FatturaPeer::doSelectJoinAllExceptModoPagamento($criteria));
  }
}
