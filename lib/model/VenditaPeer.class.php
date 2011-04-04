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
  
  public static function doSelect(Criteria $criteria, PropelPDO $con = null)
  {
    return VenditaPeer::populateObjects(VenditaPeer::doSelectRS($criteria, $con));
  }

  public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
  {
    $criteria->add(VenditaPeer::CLASS_KEY, VenditaPeer::CLASSKEY_VENDITA);
    return parent::doCount($criteria, $distinct, $con);
  }
  
  public static function doSelectRS(Criteria $criteria, $conn = null)
  {
    $criteria->add(VenditaPeer::CLASS_KEY, VenditaPeer::CLASSKEY_VENDITA);
    return parent::doSelectRS($criteria);
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
  
  public static function getYearInvoice()
  {
    $criteria = new Criteria();
    $criteria->clearSelectColumns();
    $criteria->addSelectColumn('year('.VenditaPeer::DATA.') as year');
    $criteria->setDistinct();
    $criteria->addDescendingOrderByColumn(VenditaPeer::DATA);
    $rs = VenditaPeer::doSelectRS($criteria);
    $results = $rs->fetchAll(PDO::FETCH_COLUMN);

    $anni = array();
    foreach($results as $result)
    {
      $anni[$result] = $result;
    }

    return $anni;
  }

  public static function getFatturato($anno, $mese = null)
  {
    $criteria = new criteria();
    $cr1 = $criteria->getNewCriterion(VenditaPeer::DATA,date('Y-m-d',mktime(0,0,0,(!is_null($mese)?$mese:1),1, $anno)),Criteria::GREATER_EQUAL);
    $cr2 = $criteria->getNewCriterion(VenditaPeer::DATA,date('Y-m-d',mktime(0,0,0,(!is_null($mese)?$mese:12),31, $anno)),Criteria::LESS_EQUAL );
    $cr1->addAnd($cr2);
    $criteria->add($cr1);
    $criteria->add(VenditaPeer::STATO, array('i', 'p', 'n'), Criteria::IN);
    $criteria->add(FatturaPeer::NUM_FATTURA, 0, Criteria::NOT_EQUAL);

    $fatture = VenditaPeer::doSelect($criteria);

    $fatturato_annuo = 0;
    $fatturato_annuo_netto = 0;
    $inps = 0;
    $ritenuta_acconto = 0;
    $tasse = TassaPeer::doSelect(new Criteria());

    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $fatturato_annuo = $fatturato_annuo + $fattura->getNettoDaLiquidare();
      $fatturato_annuo_netto = $fatturato_annuo_netto + $fattura->getImponibile() - $fattura->getRitenutaAcconto();

      $previdenza = 0;
      $tasse_previdenza = $fattura->getTasseUlteriori();
      foreach ($tasse_previdenza as $tassa)
      {
        $previdenza += $tassa['costo'];
      }
      $inps = $inps + $previdenza;
      $ritenuta_acconto += $fattura->getRitenutaAcconto();
    }

    return array($fatturato_annuo, $fatturato_annuo_netto, $ritenuta_acconto, $inps);
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