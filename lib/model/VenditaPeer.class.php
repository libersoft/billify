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
      $instance = new self;
    }
    return $instance;
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

  public static function countFattureDaFare()
  {
    $anno = date('Y',time());
    $criteria = new Criteria();
    $criteria->add(VenditaPeer::DATA, date('y-m-d',mktime(0,0,0,1,1,$anno)), Criteria::GREATER_EQUAL);
    $criteria->addAnd(VenditaPeer::DATA, date('y-m-d',mktime(0,0,0,12,31,$anno)), Criteria::LESS_EQUAL);
    $num_fatture = VenditaPeer::doCount($criteria);

    return VenditaPeer::NUM_BLOCCO_FATTURE - $num_fatture;
  }

  public static function getYearInvoice()
  {
    $criteria = new Criteria();
    $criteria->clearSelectColumns();
    $criteria->addSelectColumn('year('.VenditaPeer::DATA.') as year');
    //$criteria->add(VenditaPeer::CLIENTE_ID, $this->cliente->getID());
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
    $criteria = new Criteria();
    $criteria->add(VenditaPeer::DATA,date('Y-m-d',mktime(0, 0, 0, (!is_null($mese)?$mese:1), 1, $anno)), Criteria::GREATER_EQUAL);
    $criteria->add(VenditaPeer::DATA,date('Y-m-d',mktime(0, 0, 0, (!is_null($mese)?$mese:12), 31, $anno)), Criteria::LESS_EQUAL );
    $criteria->add(VenditaPeer::STATO, array('i', 'p', 'n'), Criteria::IN);
    $criteria->add(VenditaPeer::NUM_FATTURA, 0, Criteria::NOT_EQUAL);
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

  public function fattureDaIncassare()
  {
    $criteria = new Criteria();
    $this->sortByDateAndInvoiceNumber($criteria);
    $criteria->add(FatturaPeer::STATO,'i');

    $pager = new sfPropelPager('Vendita', 10000);
    $pager->setCriteria($criteria);
    $pager->setPage(1);
    $pager->setPeerMethod('doSelectJoinAllExceptModoPagamento');
    $pager->setPeerCountMethod('doCountJoinAllExceptModoPagamento');
    $pager->init();
    $this->fatture_da_incassare = $pager;

    $this->conta_fatture_da_incassare = VenditaPeer::doCount($criteria);
    $this->totale_da_incassare = 0;
    $this->totale_da_incassare_netto = 0;
    $tasse = TassaPeer::doSelect(new Criteria());

    foreach ($this->fatture_da_incassare->getResults() as $fattura)
    {
      $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $this->totale_da_incassare = $this->totale_da_incassare + $fattura->getNettoDaLiquidare();
      $this->totale_da_incassare_netto = $this->totale_da_incassare_netto + $fattura->getImponibile() - $fattura->getRitenutaAcconto();
    }

  }

  public function getFatturatoAnnuo()
  {
    $criteria = $this->getYearCriteria();
    $cr1 = $criteria->getNewCriterion(FatturaPeer::STATO , 'i');
    $cr2 = $criteria->getNewCriterion(FatturaPeer::STATO, 'p');
    $cr1->addOr($cr2);
    $criteria->add($cr1);
    $fatture = VenditaPeer::doSelect($criteria);
    $this->fatturato_annuo = 0;
    $this->fatturato_annuo_netto = 0;
    $this->inps = 0;
    $this->ritenuta_acconto = 0;
    $tasse = TassaPeer::doSelect(new Criteria());

    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $this->fatturato_annuo = $this->fatturato_annuo + $fattura->getNettoDaLiquidare();
      $this->fatturato_annuo_netto = $this->fatturato_annuo_netto + $fattura->getImponibile();

      $previdenza = 0;
      $tasse_previdenza = $fattura->getTasseUlteriori();
      foreach ($tasse_previdenza as $tassa) {
        $previdenza += $tassa['costo'];
      }
      $this->inps = $this->inps + $previdenza;
      $this->ritenuta_acconto += $fattura->getRitenutaAcconto();
    }
  }

  private function getYearCriteria()
  {
    $criteria = new Criteria();
    $cr1 = $criteria->getNewCriterion(FatturaPeer::DATA,date('Y-m-d',mktime(0,0,0,1,1,date('Y',time()))),Criteria::GREATER_EQUAL);
    $cr2 = $criteria->getNewCriterion(FatturaPeer::DATA,date('Y-m-d',mktime(0,0,0,12,31,date('Y',time()))),Criteria::LESS_EQUAL );
    $cr1->addAnd($cr2);
    $criteria->add($cr1);
    return $criteria;
  }

  public function getFatturatoAnnuoIncassato()
  {
    $criteria = $this->getYearCriteria();
    $criteria->add(FatturaPeer::STATO, 'p');
    $fatture = VenditaPeer::doSelect($criteria);
    $this->fatturato_annuo_incassato = 0;
    $this->fatturato_annuo_netto_incassato = 0;
    $tasse = TassaPeer::doSelect(new Criteria());

    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $this->fatturato_annuo_incassato = $this->fatturato_annuo_incassato + $fattura->getNettoDaLiquidare();
      $this->fatturato_annuo_netto_incassato = $this->fatturato_annuo_netto_incassato + $fattura->getImponibile() - $fattura->getRitenutaAcconto();
    }

  }

  private function getFatturatoTotale()
  {
    $criteria = new criteria();
    $cr1 = $criteria->getNewCriterion(FatturaPeer::STATO , 'i');
    $cr2 = $criteria->getNewCriterion(FatturaPeer::STATO, 'p');
    $cr1->addOr($cr2);
    $fatture = VenditaPeer::doSelect($criteria);
    $this->fatturato_totale = 0;
    $this->fatturato_totale_netto = 0;

    $tasse = TassaPeer::doSelect(new Criteria());

    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $this->fatturato_totale = $this->fatturato_totale + $fattura->getNettoDaLiquidare();
      $this->fatturato_totale_netto = $this->fatturato_totale_netto + $fattura->getImponibile() - $fattura->getRitenutaAcconto();
    }
  }

  private function getFatturatoTotaleIncassato()
  {
    $criteria = new criteria();
    $criteria->add(FatturaPeer::STATO, 'p');
    $fatture = VenditaPeer::doSelect($criteria);
    $this->fatturato_totale_incassato = 0;
    $this->fatturato_totale_netto_incassato = 0;

    $tasse = TassaPeer::doSelect(new Criteria());

    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $this->fatturato_totale_incassato = $this->fatturato_totale_incassato + $fattura->getNettoDaLiquidare();
      $this->fatturato_totale_netto_incassato = $this->fatturato_totale_netto_incassato + $fattura->getImponibile() - $fattura->getRitenutaAcconto();
    }
  }

  public function getIvaDaPagare()
  {
    $criteria = $this->getYearCriteria();
    $criteria->add(FatturaPeer::IVA_PAGATA,'n');
    $cr1 = $criteria->getNewCriterion(FatturaPeer::STATO , 'i');
    $cr2 = $criteria->getNewCriterion(FatturaPeer::STATO, 'p');
    $cr1->addOr($cr2);
    $criteria->add($cr1);
    $criteria->add(FatturaPeer::NUM_FATTURA,0,'>');
    $fatture = VenditaPeer::doSelect($criteria);
    $this->iva = 0;
    $tasse = TassaPeer::doSelect(new Criteria());

    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $this->iva = $this->iva + $fattura->getIva();
    }

    $criteria = $this->getYearCriteria();
    $criteria->add(FatturaPeer::STATO,'i');
    $criteria->add(FatturaPeer::NUM_FATTURA,0,'>');
    $fatture = VenditaPeer::doSelect($criteria);
    $this->iva_a_debito = 0;
    $tasse = TassaPeer::doSelect(new Criteria());

    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $this->iva_a_debito = $this->iva_a_debito + $fattura->getIva();
    }
  }

  public function fattureDaInviare()
  {
    $criteria = new Criteria();
    $this->sortByDateAndInvoiceNumber($criteria);
    $criteria->add(FatturaPeer::STATO, 'n' );

    $this->fatture_da_inviare = VenditaPeer::doSelectJoinAllExceptModoPagamento($criteria);
  }

  public function ivaDepositata()
  {
    $criteria = $this->getYearCriteria();
    $criteria->add(FatturaPeer::IVA_DEPOSITATA ,'s');
    $criteria->add(FatturaPeer::IVA_PAGATA ,'n');
    $criteria->add(FatturaPeer::STATO , Fattura::PAGATA);
    $fatture = VenditaPeer::doSelect($criteria);
    $this->iva_depositata = 0;
    $tasse = TassaPeer::doSelect(new Criteria());

    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $this->iva_depositata = $this->iva_depositata + $fattura->getIva();
    }

    $criteria = $this->getYearCriteria();
    $criteria->add(FatturaPeer::IVA_DEPOSITATA ,'n');
    $criteria->add(FatturaPeer::STATO , Fattura::PAGATA);
    $fatture = VenditaPeer::doSelect($criteria);
    $this->iva_da_depositare = 0;
    $tasse = TassaPeer::doSelect(new Criteria());

    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $this->iva_da_depositare = $this->iva_da_depositare + $fattura->getIva();
    }
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