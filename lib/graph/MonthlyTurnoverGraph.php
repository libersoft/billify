<?php

class MonthlyTurnoverGraph extends Graph
{
  private $criteria;
  private $cash_flow;
  private $current_year;

  public function __construct()
  {
    $this->criteria = new TurnoverCriteria();
    $this->cash_flow = new CashFlow();
    $this->setTitle('Fatturato Mensile');
    $this->current_year = date('Y');
  }
  
  public function build()
  {
    //$this->criteria->clear();
    $this->criteria->setLimit(3);
    $this->criteria->addDescendingOrderByColumn(VenditaPeer::DATA);
    $years = VenditaPeer::getYearInvoice($this->criteria);

    $years = $years ? array_reverse($years) : array();
    
    $months = array(
        "Gen",
        "Feb",
        "Mar",
        "Apr",
        "Mag",
        "Giu",
        "Lug",
        "Ago",
        "Set",
        "Ott",
        "Nov",
        "Dic"
    );

    $this->setXAxisValues($months);

    foreach($years as $year)
    {
      $serie = new GraphLineSerie();

      if ($year == $this->current_year)
      {
        $serie = new GraphBarSerie();
      }

      $serie->setName($year);

      foreach($months as $index => $month)
      {
        $month = $index + 1;
        $criteria = new TurnoverCriteria();
        $criteria->addDateRange($year, $month);
        $documents = VenditaPeer::doSelectJoinAllExceptModoPagamento($criteria);;

        $this->cash_flow->reset();
        $this->cash_flow->setWithTaxes(false);
        $this->cash_flow->addDocuments($documents);

        $serie->addData($this->cash_flow->getIncoming());
      }

      $this->addSerie($serie);
    }

  }
}
