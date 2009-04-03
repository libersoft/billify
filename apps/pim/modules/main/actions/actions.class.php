<?php

/**
 * main actions.
 *
 * @package    phpmyinvoice
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id$
 */
class mainActions extends sfActions
{
  
  public function executeIndex()
  {
    $this->getUser()->setCulture('it_IT');

    if(UtentePeer::getImpostazione()->getBoolRiepilogoHome()){
      $this->riepilogo();
    }
    else {
      return 'NoRiepilogo';
    }
  }

  public function executeRiepilogo()
  {
    $this->riepilogo();
    $this->setTemplate('index');

  }

  private function riepilogo()
  {
    $this->count_customer = $this->countCustomers();
    $this->count_year_invoice = $this->countYearInvoices();
    $this->getFatturatoAnnuo();
    $this->getFatturatoAnnuoIncassato();
    $this->getIvaDaPagare();
    $this->totaleDaIncassare();
    $this->fattureDaInviare();
    $this->ivaDepositata();
  }

  private function countCustomers()
  {
    return ClientePeer::doCount(new Criteria);
  }

  private function countYearInvoices()
  {
    return VenditaPeer::doCount($this->getYearCriteria());
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

  private function getYearCriteria()
  {
    $criteria = new criteria();
    $cr1 = $criteria->getNewCriterion(FatturaPeer::DATA,date('Y-m-d',mktime(0,0,0,1,1,date('Y',time()))),Criteria::GREATER_EQUAL);
    $cr2 = $criteria->getNewCriterion(FatturaPeer::DATA,date('Y-m-d',mktime(0,0,0,12,31,date('Y',time()))),Criteria::LESS_EQUAL );
    $cr1->addAnd($cr2);
    $criteria->add($cr1);
    return $criteria;
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
    $criteria->add(FatturaPeer::STATO, 'n' );
    $criteria->addAscendingOrderByColumn(FatturaPeer::NUM_FATTURA);

    /*$pager = new sfPropelPager('Vendita', 10000);
    $pager->setCriteria($criteria);
    $pager->setPage($this->getRequestParameter('page', 1));
    $pager->setPeerMethod('doSelectJoinAllExceptModoPagamento');
    $pager->setPeerCountMethod('doCountJoinAllExceptModoPagamento');
    $pager->init();*/
   
    $this->fatture_da_inviare = VenditaPeer::doSelectJoinAllExceptModoPagamento($criteria);
  }

  public function totaleDaIncassare()
  {
    $criteria = new Criteria();
    $criteria->add(FatturaPeer::STATO,'i');
    $criteria->addAscendingOrderByColumn(FatturaPeer::NUM_FATTURA);

    $pager = new sfPropelPager('Vendita', 10000);
    $pager->setCriteria($criteria);
    $pager->setPage($this->getRequestParameter('page',1));
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

  public function executeTime(){

  }

  public function executeError404(){

  }

  public function executeChiSiamo(){

  }

  public function executeTerminiServizio(){

  }

  public function executePrivacyPolicy(){

  }

  public function executeContatti(){

  }

  public function executeUpdateProfile(){
    if($this->hasRequestParameter('noview')){
      $this->getResponse()->setCookie('updateProfile', 'noview');
      return $this->redirect($this->getRequestParameter('referrer'));
    }
    return sfView::NONE;
  }
}
?>
