<?php

class ContactTurnoverGraph extends Graph
{
  private $criteria;
  private $cash_flow;
  private $current_year;
  private $documents;

  public function __construct($contact, $contact_total_incoming, $year = null)
  {
    $year = ($year)?$year:date('Y');
        
    $this->criteria = new FinancialDocumentCriteria();
    $this->cash_flow = new CashFlow();
    $this->setTitle('% Fatturato');
    
    $this->year = $year;
    $this->contact_incoming = $contact_total_incoming;
    $this->contact_name = $contact->getRagioneSociale();
    
    
  }
  
  public function build()
  {
    $serie = new GraphPieSerie();
    $serie->setName('% Fatturato');
     
    if(!isset($this->documents[$this->year]))
    {
      $this->criteria->clear();
      $this->criteria->addDateRange($this->year);
      $this->documents[$this->year] = FatturaPeer::doSelectJoinAllExceptModoPagamento($this->criteria);
    }

    $this->criteria->clear();
    $this->criteria->add(FatturaPeer::ANNO, $this->year);

    $this->cash_flow->reset();
    $this->cash_flow->setWithTaxes(false);
    $this->cash_flow->addDocuments($this->documents[$this->year]);

    $fatturato = $this->cash_flow->getIncoming();
    
    $data = array();   
    foreach(array('Altro fatturato' => $fatturato - $this->contact_incoming, $this->contact_name => $this->contact_incoming) as $name => $value)
    {
      if ($fatturato)
      {
        $percentage = 100 * $value / $fatturato; 
        $data[] = array('name' => $name .' ('.$percentage. '%)', 'y' => $value, 'sliced' => true);
      }
    }
    
    $serie->setData($data);
    $this->addSerie($serie);
  }
}
