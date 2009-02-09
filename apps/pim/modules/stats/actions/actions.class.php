<?php

/**
 * stats actions.
 *
 * @package    phpmyinvoice
 * @subpackage stats
 * @author     Your name here
 * @version    SVN: $Id$
 */

require_once('propel/util/Criteria.php');

class statsActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->getFatturato();
  }

  public function getFatturato(){
    $this->criteria = new criteria();

    if($this->hasRequestParameter('year') && $this->getRequestParameter('year') != "")
    $this->getYearCriteria(intval($this->getRequestParameter('year',date('Y',time()))));

    if($this->hasRequestParameter('month') && $this->getRequestParameter('month') != "")
    $this->getYearCriteria(intval($this->getRequestParameter('year',date('Y',time()))),intval($this->getRequestParameter('month',1)),intval($this->getRequestParameter('month',12)));

    if($this->hasRequestParameter('cliente') && $this->getRequestParameter('cliente') != "")
    $this->criteria->add(FatturaPeer::CLIENTE_ID , $this->getRequestParameter('cliente'));


    $cr1 = $this->criteria->getNewCriterion(FatturaPeer::STATO , Fattura::INVIATA );
    $cr2 = $this->criteria->getNewCriterion(FatturaPeer::STATO, Fattura::PAGATA);
    $cr1->addOr($cr2);
    $this->criteria->add($cr1);
    $fatture = VenditaPeer::doSelect($this->criteria);
    $this->fatturato = 0;
    $this->fatturato_netto = 0;

    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura();
      $this->fatturato = $this->fatturato + $fattura->getNettoDaLiquidare();
      $this->fatturato_netto = $this->fatturato_netto + $fattura->getImponibileFineIva() - $fattura->getRitenutaAcconto();
    }
  }

  public function getFatturatoYear(){

  }

  private function getYearCriteria($year = 2006, $month_start = 1, $month_end = 12)
  {
    $this->year = $year;
    if($month_start == $month_end)
    $this->month = $month_start;

    $cr1 = $this->criteria->getNewCriterion(FatturaPeer::DATA,date('Y-m-d',mktime(0,0,0,$month_start,1,$year)),Criteria::GREATER_EQUAL);
    $cr2 = $this->criteria->getNewCriterion(FatturaPeer::DATA,date('Y-m-d',mktime(0,0,0,$month_end,date('t',mktime(0,0,0,$month_end,1,$year)),$year)),Criteria::LESS_EQUAL );
    $cr1->addAnd($cr2);
    $this->criteria->add($cr1);
  }

  /**
   * Executes source action
   *
   */
  public function executeFatturatoannuo()
  {
    $sfSwfChart = new sfSwfChart();

    $chart = $this->getChartOption();

    $chart['chart_data'][0] = array_merge(array(""), VenditaPeer::getYearInvoice());
    $chart['chart_data'][1][0] = "Lordo";
    $chart['chart_data'][2][0] = "Netto";
    $chart['chart_data'][3][0] = "Ritenuta d'acconto";
    $chart['chart_data'][4][0] = "Previdenza sociale";

    for ( $row = 1; $row < 5; $row++ ) {
      for ( $col = 1; $col < count($chart['chart_data'][0]); $col++ ) {
        $info_fatturato = VenditaPeer::getFatturato($chart['chart_data'][0][$col]);
        $chart['chart_data'][ $row ][ $col ] = $info_fatturato[$row-1];
      }
    }

    $xml = $sfSwfChart->convertArray($chart);

    $this->setLayout(false);
    $this->getContext()->getResponse()->setContent($xml);

    return sfView::NONE;
  }

  public function executeFatturatomensile(){
    $sfSwfChart = new sfSwfChart();

    $chart = $this->getChartOption();

    $chart [ 'chart_value' ] = array (  'prefix'         =>  "",
                                    'suffix'         =>  "€",
                                    'decimals'       =>  2,
                                    'decimal_char'   =>  ".",
                                    'separator'      =>  "",
                                    'position'       =>  "cursor",
                                    'hide_zero'      =>  true,
                                    'as_percentage'  =>  true,
                                    'font'           =>  "Arial",
                                    'bold'           =>  false,
                                    'size'           =>  11,
                                    'color'          =>  "000",
                                    'alpha'          =>  90
                                  );

    $chart['chart_data'][0] = array("", "Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dic");
    $chart['chart_data'][1][0] = "Lordo";
    $chart['chart_data'][2][0] = "Netto";

    for ( $row = 1; $row < count($chart['chart_data']); $row++ ) {
      for ( $col = 1; $col < count($chart['chart_data'][0]); $col++ ) {
        $info_fatturato = VenditaPeer::getFatturato($this->getRequestParameter('year', date('Y', time())), $col);
        $chart['chart_data'][ $row ][ $col ] = $info_fatturato[$row-1];
      }
    }

    $xml = $sfSwfChart->convertArray($chart);

    $this->setLayout(false);
    $this->getContext()->getResponse()->setContent($xml);
    return sfView::NONE;
  }

  private function getChartOption(){
    $chart['chart_type'] = 'column';
    $chart['chart_border'] = array('top_thickness' => 0, 'bottom_thickness' => 1, 'left_thickness' => 1, 'right_thickness' => 1);

    $chart [ 'chart_value' ] = array (  'prefix'         =>  "",
                                    'suffix'         =>  "€",
                                    'decimals'       =>  2,
                                    'decimal_char'   =>  ".",
                                    'separator'      =>  "",
                                    'position'       =>  "cursor",
                                    'hide_zero'      =>  false,
                                    'as_percentage'  =>  true,
                                    'font'           =>  "Arial",
                                    'bold'           =>  true,
                                    'size'           =>  11,
                                    'color'          =>  "000",
                                    'alpha'          =>  90
                                  );
    return $chart;
  }
}

?>
