<?php

  // include base peer class
  require_once 'lib/model/om/BaseFatturaPeer.php';

  // include object class
  include_once 'lib/model/Fattura.php';


/**
 * Skeleton subclass for performing query and update operations on the 'fattura' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */
class FatturaPeer extends BaseFatturaPeer {

	const NUM_BLOCCO_FATTURE = 10;

	public static function doSelectRS(Criteria $criteria, $conn = null)
	{
		if(sfConfig::get('sf_app')!='backend')
			$criteria->add(FatturaPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));

		return parent::doSelectRS($criteria);
	}

	/**
	 * Selects a collection of Fattura objects pre-filled with all related objects except ModoPagamento.
	 *
	 * @return array Array of Fattura objects.
	 * @throws PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectJoinAllExceptModoPagamento(Criteria $c, $con = null)
	{
		$c->add(FatturaPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
		return parent::doSelectJoinAllExceptModoPagamento($c);
	}

	public static function doCountJoinAllExceptModoPagamento(Criteria $c, $distinct = false, $con = null)
	{
		$c->add(FatturaPeer::ID_UTENTE ,sfContext::getInstance()->getUser()->getAttribute('id_utente'));
		return parent::doCountJoinAllExceptModoPagamento($c,$distinct,$con);
	}

	public static function countFattureDaFare(){
		$anno = date('Y',time());
		$criteria = new Criteria();
		$criteria->add(FatturaPeer::DATA ,date('y-m-d',mktime(0,0,0,1,1,$anno)),Criteria::GREATER_EQUAL);
		$criteria->addAnd(FatturaPeer::DATA ,date('y-m-d',mktime(0,0,0,12,31,$anno)),Criteria::LESS_EQUAL);
		$num_fatture = FatturaPeer::doCount($criteria);

		return FatturaPeer::NUM_BLOCCO_FATTURE - $num_fatture;
	}

	public static function getYearInvoice(){
	  $criteria = new Criteria();
		$criteria->clearSelectColumns();
		$criteria->addSelectColumn('year('.FatturaPeer::DATA.')');
		//$criteria->add(FatturaPeer::CLIENTE_ID, $this->cliente->getID());
		$criteria->setDistinct();
		$rs = FatturaPeer::doSelectRS($criteria);
		$anni = array();
		while($rs->next())
		$anni[$rs->get(1)] = $rs->get(1);
		return $anni;
	}

	public static function getFatturato($anno, $mese = null){
	  $criteria = new criteria();
    $cr1 = $criteria->getNewCriterion(FatturaPeer::DATA,date('Y-m-d',mktime(0,0,0,(!is_null($mese)?$mese:1),1, $anno)),Criteria::GREATER_EQUAL);
    $cr2 = $criteria->getNewCriterion(FatturaPeer::DATA,date('Y-m-d',mktime(0,0,0,(!is_null($mese)?$mese:12),31, $anno)),Criteria::LESS_EQUAL );
    $cr1->addAnd($cr2);
    $criteria->add($cr1);
	  $cr1 = $criteria->getNewCriterion(FatturaPeer::STATO , 'i');
	  $cr2 = $criteria->getNewCriterion(FatturaPeer::STATO, 'p');
	  $cr1->addOr($cr2);
	  $criteria->add($cr1);
	  $fatture = FatturaPeer::doSelect($criteria);
	  $fatturato_annuo = 0;
	  $fatturato_annuo_netto = 0;
	  $inps = 0;
	  $ritenuta_acconto = 0;

	  foreach ($fatture as $fattura)
	  {
	    $fattura->calcolaFattura();
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

} // FatturaPeer
