<?php 


class VenditaPeer extends FatturaPeer
{
  public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
  {
    $criteria->add(VenditaPeer::CLASS_KEY, VenditaPeer::CLASSKEY_VENDITA);
    return parent::doCount($criteria, $distinct, $con);
  }

  public static function doSelect(Criteria $criteria, PropelPDO $con = null)
  {
    $criteria->add(VenditaPeer::CLASS_KEY, VenditaPeer::CLASSKEY_VENDITA);
    return parent::doSelect($criteria, $con);
  }

  public static function doSelectJoinAllExceptModoPagamento(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
  {
    $c->add(VenditaPeer::CLASS_KEY, VenditaPeer::CLASSKEY_VENDITA );
    $c->add(FatturaPeer::ID_UTENTE, FatturaPeer::$user_id);
    return parent::doSelectJoinAllExceptModoPagamento($c);
  }

  public static function doCountJoinAllExceptModoPagamento(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
  {
    $criteria->add(VenditaPeer::CLASS_KEY, VenditaPeer::CLASSKEY_VENDITA );
    $criteria->add(FatturaPeer::ID_UTENTE, FatturaPeer::$user_id);
    return parent::doCountJoinAllExceptModoPagamento($criteria, $distinct, $con);
  }
  
  public static function getYearInvoice(TurnoverCriteria $criteria)
  {
    
    $criteria->clearSelectColumns();
    $criteria->addSelectColumn('year('.VenditaPeer::DATA.') as year');
    $criteria->setDistinct();
    $rs = VenditaPeer::doSelectStmt($criteria);
    $results = $rs->fetchAll(PDO::FETCH_COLUMN);

    $years = array();
    foreach($results as $result)
    {
      $years[$result] = $result;
    }

    return $years;
  }

  public static function doSelectTurnover($year, $month = null, TurnoverCriteria $criteria)
  {
    $criteria->addDateRange($year, $month);
    return self::doSelectJoinAllExceptModoPagamento($criteria);
  }
}