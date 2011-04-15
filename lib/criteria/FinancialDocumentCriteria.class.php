<?php

class FinancialDocumentCriteria extends TurnoverCriteria
{
  protected function initDefaults()
  {
    parent::initDefaults();
    $this->add(FatturaPeer::CLASS_KEY, array(FatturaPeer::CLASSKEY_ACQUISTO, FatturaPeer::CLASSKEY_VENDITA), Criteria::IN);
  }
}
