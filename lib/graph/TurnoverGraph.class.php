<?php

class TurnoverGraph extends Graph
{
  private $criteria;
  private $cash_flow;

  public function __construct()
  {
    $this->criteria = new TurnoverCriteria();
    $this->cash_flow = new CashFlow();

    $this->setTitle('Fatturato Annuo');
  }
  
  public function build()
  {
    $this->criteria->setLimit(5);
    $this->criteria->addDescendingOrderByColumn(FatturaPeer::DATA);
    $years = VenditaPeer::getYearInvoice($this->criteria);

    $years = $years ? array_reverse($years) : array();
    
    $this->setXAxisValues($years);

    foreach(array('incoming' => 'Entrate', 'outcoming' => 'Uscite') as $type => $name)
    {
      $serie = new GraphBarSerie();
      $serie->setName($name);

      foreach($years as $year)
      {
        if(!isset($this->documents[$year]))
        {
          $this->documents[$year] = FinancialDocumentPeer::doSelectTurnover($year, null, new TurnoverCriteria());
        }

        $this->criteria->clear();
        $this->criteria->add(FatturaPeer::ANNO, $year);

        $this->cash_flow->reset();
        $this->cash_flow->setWithTaxes(false);
        $this->cash_flow->addDocuments($this->documents[$year]);

        $method_name = 'get'.ucfirst($type);
        $serie->addData($this->cash_flow->$method_name());
      }

      $this->addSerie($serie);
    }
  }
}
