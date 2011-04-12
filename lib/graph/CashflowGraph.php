<?php

class CashflowGraph extends Graph
{
  private $criteria;
  private $cash_flow;
  private $current_year;
  private $documents;

  public function __construct()
  {
    $this->criteria = new Criteria();
    $this->cash_flow = new CashFlow();
    $this->setTitle('Cashflow Mensile');
    $this->current_year = date('Y');
  }
  
  public function build()
  {

    $months = array("", "Gen", "Feb", "Mar", "Apr", "Mag", "Giu", "Lug", "Ago", "Set", "Ott", "Nov", "Dic");

    $this->setXAxisValues($months);
    
    foreach(array('incoming' => 'Entrate', 'outcoming' => 'Uscite') as $type => $name)
    {
      $serie = new GraphBarSerie();

      $serie->setName($name.' '.$this->current_year);

      foreach($months as $index => $month)
      {
        if (!isset($this->documents[$month]))
        {
          $this->documents[$month] = FinancialDocumentPeer::doSelectTurnover($this->current_year, $index);
        }
        
        $this->cash_flow->reset();
        $this->cash_flow->addDocuments($this->documents[$month]);

        $method_name = 'get'.ucfirst($type);
        $serie->addData($this->cash_flow->$method_name());
      }

      $this->addSerie($serie);
    }
  }

}
