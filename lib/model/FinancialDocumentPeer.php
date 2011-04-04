<?php

class FinancialDocumentPeer extends FatturaPeer
{
  public static function doSelect(Criteria $criteria, PropelPDO $con = null)
  {
    $criteria->add(FatturaPeer::NUM_FATTURA, 0, Criteria::NOT_EQUAL);
    return parent::doSelect($criteria, $con);
  }
}
