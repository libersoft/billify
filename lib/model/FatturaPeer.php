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
  
  public static function doSelectTurnoverCriteria($year = null, $month = null, Criteria $criteria = null)
  {
    if (null === $criteria)
    {
      $criteria = new criteria();
    }

    if ($year)
    {
      $days_in_month = 31;
      if ($month)
      {
        $days_in_month = date('t', strtotime($month.'/1/'.$year));
      }
      $cr1 = $criteria->getNewCriterion(FatturaPeer::DATA, date('Y-m-d', mktime(0, 0, 0,(!is_null($month) ? $month : 1), 1, $year)), Criteria::GREATER_EQUAL);
      $cr2 = $criteria->getNewCriterion(FatturaPeer::DATA, date('Y-m-d', mktime(0, 0, 0,(!is_null($month) ? $month : 12), $days_in_month, $year)), Criteria::LESS_EQUAL );
      $cr1->addAnd($cr2);
      $criteria->add($cr1);
    }
    
    $criteria->add(FatturaPeer::NUM_FATTURA, '0', Criteria::NOT_EQUAL);
    $criteria->addOr(FatturaPeer::NUM_FATTURA, null, Criteria::ISNULL);

    return $criteria;
  }

  public static function doSelectTurnover($year, $month = null, Criteria $criteria = null)
  {
    $criteria = self::doSelectTurnoverCriteria($year, $month, $criteria);
    return self::doSelectJoinAllExceptModoPagamento($criteria);
  }
  
  public static function doSelectForCashFlow($document_date = null, TurnoverCriteria $criteria)
  {
    if (!is_null($document_date) && $document_date['from']['day'] && $document_date['from']['month'] && $document_date['from']['year'])
    {
      $from = implode('/', array_reverse($document_date['from']));
      $to = implode('/', array_reverse($document_date['to']));
      $criteria->add(FatturaPeer::DATA_SCADENZA, $from, Criteria::GREATER_EQUAL);
      $criteria->addAnd(FatturaPeer::DATA_SCADENZA, $to, Criteria::LESS_EQUAL);
    }

    $criteria->addAscendingOrderByColumn(FatturaPeer::DATA_SCADENZA);
    $criteria = self::doSelectTurnoverCriteria(null, null, $criteria);
    
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
