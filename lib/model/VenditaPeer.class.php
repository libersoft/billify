<?php 


class VenditaPeer extends FatturaPeer
{
  /**
   * Returns instance of VenditaPeer
   * 
   * @return VenditaPeer
   */
  public static function getInstance()
  {
    if (!self::$instance)
    {
      self::$instance = new self;
    }
    return self::$instance;
  }

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
  
  public static function getYearInvoice(Criteria $criteria = null)
  {
    if (null === $criteria)
    {
      $criteria = new Criteria();
    }
    
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

  public static function doSelectTurnover($year, $month = null, Criteria $criteria = null)
  {
    $criteria = parent::doSelectTurnoverCriteria($year, $month, $criteria);
    return VenditaPeer::doSelectJoinAllExceptModoPagamento($criteria);
  }

  public function fattureDaIncassare()
  {
    $criteria = new Criteria();
    $this->sortByDateAndInvoiceNumber($criteria);
    $criteria->add(FatturaPeer::STATO,'i');

    $this->fatture_da_incassare = VenditaPeer::doSelectJoinAllExceptModoPagamento($criteria);;
  }

  public function fattureDaInviare()
  {
    $criteria = new Criteria();
    $this->sortByDateAndInvoiceNumber($criteria);
    $criteria->add(FatturaPeer::STATO, 'n' );

    $this->fatture_da_inviare = VenditaPeer::doSelectJoinAllExceptModoPagamento($criteria);
  }

  public function sortByDateAndInvoiceNumber(Criteria $criteria)
  {
    $criteria->addAsColumn('integer_num_fattura', 'CONVERT('.FatturaPeer::NUM_FATTURA.', signed)');
    $criteria->addAscendingOrderByColumn('YEAR(data)');
    $criteria->addAscendingOrderByColumn('integer_num_fattura');
  }

  public function sortCriteria(Criteria $criteria)
  {
    $criteria->addAsColumn('integer_num_fattura', 'CONVERT('.FatturaPeer::NUM_FATTURA.', signed)');
    $criteria->addAscendingOrderByColumn('integer_num_fattura');
  }

  public function filterByYearCriteria($year, Criteria $criteria)
  {
    if ($year != 'all')
    {
      $criteria->addAnd(FatturaPeer::DATA, date('Y-m-d', mktime(0, 0, 0, 1, 1, $year)), Criteria::GREATER_EQUAL);
      $criteria->addAnd(FatturaPeer::DATA, date('Y-m-d', mktime(0, 0, 0, 12, 31, $year)), Criteria::LESS_EQUAL);
    }
    
  }
}