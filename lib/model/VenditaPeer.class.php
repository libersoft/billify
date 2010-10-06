<?php 


class VenditaPeer extends FatturaPeer
{
  public static function doSelect(Criteria $criteria, PropelPDO $con = null)
  {
    return VenditaPeer::populateObjects(VenditaPeer::doSelectRS($criteria, $con));
  }

  public static function doSelectRS(Criteria $criteria, $conn = null)
  {
    $criteria->add(VenditaPeer::CLASS_KEY, VenditaPeer::CLASSKEY_VENDITA );
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
    $criteria = new criteria();
    $cr1 = $criteria->getNewCriterion(VenditaPeer::DATA,date('Y-m-d',mktime(0,0,0,(!is_null($mese)?$mese:1),1, $anno)),Criteria::GREATER_EQUAL);
    $cr2 = $criteria->getNewCriterion(VenditaPeer::DATA,date('Y-m-d',mktime(0,0,0,(!is_null($mese)?$mese:12),31, $anno)),Criteria::LESS_EQUAL );
    $cr1->addAnd($cr2);
    $criteria->add($cr1);
    $cr1 = $criteria->getNewCriterion(VenditaPeer::STATO , 'i');
    $cr2 = $criteria->getNewCriterion(VenditaPeer::STATO, 'p');
    $cr1->addOr($cr2);
    $criteria->add($cr1);
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
      $previdenza += $tassa['costo'];
      $inps = $inps + $previdenza;
      $ritenuta_acconto += $fattura->getRitenutaAcconto();
    }

    return array($fatturato_annuo, $fatturato_annuo_netto, $ritenuta_acconto, $inps);
  }

  public static function doSelectJoinAllExceptModoPagamento(Criteria $c, $con = null, $join_behavior = Criteria::LEFT_JOIN)
  {
    $c->add(VenditaPeer::CLASS_KEY, VenditaPeer::CLASSKEY_VENDITA );
    $c->add(FatturaPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
    return parent::doSelectJoinAllExceptModoPagamento($c);
  }

  public static function doCountJoinAllExceptModoPagamento(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
  {
    $criteria->add(VenditaPeer::CLASS_KEY, VenditaPeer::CLASSKEY_VENDITA );
    $criteria->add(FatturaPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
    return parent::doCountJoinAllExceptModoPagamento($criteria, $distinct, $con);
  }
}