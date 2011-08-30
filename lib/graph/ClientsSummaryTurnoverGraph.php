<?php

class ClientsSummaryTurnoverGraph extends Graph
{
  private $criteria;
  private $cash_flow;
  private $current_year;
  private $documents;

  public function __construct($supplier = false)
  {
    $this->criteria = new FinancialDocumentCriteria();
    $this->cash_flow = new CashFlow();
    $this->setTitle('% Fatturato');
    
    $this->supplier = $supplier;
    $this->year = date('Y');
    
    if ($this->supplier)
    {
      $this->contact = FornitorePeer::doSelect(new Criteria());  
    }
    else {
      $this->contact = ClientePeer::doSelect(new Criteria());  
    }
    
    
    if (!is_array($this->contact))
    {
       $this->contact = array($this->contact);
    }
    
    
  }
  
  public function build()
  {
    $serie = new GraphPieSerie();
  
     
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

    $method = 'getIncoming';
    $name = '% Fatturato';
       
    if ($this->supplier) 
    {
      $method = 'getOutcoming';
      $name = 'Uscite %';
    }
    
    $serie->setName($name);
    $fatturato = $this->cash_flow->$method();
    
    $data = array();   
    foreach($this->contact as $contact)
    {
      if ($fatturato)
      {
        $value = $contact->getTotaleFatture($this->year);
        $percentage = round (100 * $value / $fatturato, 2); 
        $data[] = array('name' => $contact->getRagioneSociale() .' ('.$percentage. '%)', 'y' => $value);
      }
    }
    
    $serie->setData($data);
    $this->addSerie($serie);
  }
}
