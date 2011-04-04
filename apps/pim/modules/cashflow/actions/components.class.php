<?php

class cashflowComponents extends paComponents
{
  public function executeMonitor($request, $callback = null)
  {
    $criteria = new Criteria;

    $filter = new FinancialDocumentFormFilter();
    $filter->bind($request->getParameter($filter->getName(), $filter->getDefaultFilter($this->from_date, $this->to_date)));
    if($filter->isValid())
    {
      $criteria = $filter->getCriteria();
    }

    $values = $filter->getValues();
    $this->from_date = $values['data']['from'];
    $this->to_date = $values['data']['to'];

    $this->cf = new CashFlow();
    $this->cf->setWithTaxes(false);
    $this->cf->addDocuments(FinancialDocumentPeer::doSelect($criteria));

    $this->cf_paid_document = new CashFlow();
    $this->cf_paid_document->setWithTaxes(false);
    $this->cf_paid_document->addDocuments(FinancialDocumentPeer::doSelectPaid($criteria));
  }
}
