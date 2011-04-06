<?php

class FatturaPeer extends BaseFatturaPeer
{

  static $instance;
  static $user_id;

  public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
  {
    $criteria->add(FatturaPeer::ID_UTENTE, self::$user_id);
    return parent::doSelectStmt($criteria, $con);
  }

  public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
  {
    $criteria->add(FatturaPeer::ID_UTENTE, self::$user_id);
    return parent::doCount($criteria, $distinct, $con);
  }

  public static function doSelectForCashFlow($document_date = null)
  {
    $criteria = new Criteria();

    if (!is_null($document_date))
    {
      $from = implode('/', array_reverse($document_date['from']));
      $to = implode('/', array_reverse($document_date['to']));
      $criteria->add(FatturaPeer::DATA_SCADENZA, $from, Criteria::GREATER_EQUAL);
      $criteria->addAnd(FatturaPeer::DATA_SCADENZA, $to, Criteria::LESS_EQUAL);
    }

    $criteria->addAscendingOrderByColumn(FatturaPeer::DATA_SCADENZA);
    return FatturaPeer::doSelect($criteria);
  }

  public static function doSelectPaid(Criteria $criteria = null)
  {
    if (null === $criteria)
    {
      $criteria = new Criteria();
    }

    $criteria->add(FatturaPeer::STATO, Fattura::PAGATA);

    return self::doSelect($criteria);
  }

}
