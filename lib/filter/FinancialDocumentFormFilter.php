<?php

class FinancialDocumentFormFilter extends FatturaFormFilter
{
  public function getRoute()
  {
    return;
  }

  protected function getNewCriteria()
  {
    return new FinancialDocumentCriteria();
  }
}
