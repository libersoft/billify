<?php

class TurnoverGraph extends Graph
{
  private $criteria;
  private $cash_flow;

  public function __construct()
  {
    $this->criteria = new Criteria();
    $this->cash_flow = new CashFlow();
    $this->cash_flow->setWithTaxes(false);

    $this->setTitle('Fatturato Annuo');
  }
  
  public function build()
  {
    $this->criteria->clear();
    $this->criteria->setLimit(5);
    $this->criteria->addDescendingOrderByColumn(VenditaPeer::DATA);
    $years = VenditaPeer::getYearInvoice($this->criteria);

    $years = $years ? array_reverse($years) : array();
    
    $this->setXAxisValues($years);

    $serie = new GraphBarSerie();
    $serie->setName('Fatturato');

    foreach($years as $year)
    {
      $this->criteria->clear();
      $this->criteria->add(VenditaPeer::ANNO, $year);

      $this->cash_flow->reset();
      $this->cash_flow->addDocuments(VenditaPeer::doSelectTurnover($year));

      $serie->addData($this->cash_flow->getIncoming());
    }

    $this->addSerie($serie);
  }
}
