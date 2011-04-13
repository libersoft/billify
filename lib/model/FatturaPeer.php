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

  public static function doSelectJoinAllExceptModoPagamento(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
  {
    $criteria->add(FatturaPeer::ID_UTENTE, self::$user_id);
    return parent::doSelectJoinAllExceptModoPagamento($criteria, $con, $join_behavior);
  }
  
  public static function doSelectTurnover($year, $month = null, TurnoverCriteria $criteria)
  {
    $criteria->addDateRange($year, $month);
    
    return self::doSelectJoinAllExceptModoPagamento($criteria);
  }
  
  public static function doSelectForCashFlow($document_date = null, CashFlowCriteria $criteria)
  {
    $criteria->addDateRangeForCashFlow($document_date);
    
    return self::doSelectJoinAllExceptModoPagamento($criteria);
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

  public static function retrieveUserId()
  {
    return FatturaPeer::$user_id;
  }

}
