<?php

class CategorySummaryTurnoverGraph extends Graph
{
  private $criteria;
  private $cash_flow;
  private $current_year;
  private $documents;

  public function __construct($supplier = false)
  {
    $this->criteria = new FinancialDocumentCriteria();
    $this->cash_flow = new CashFlow();
    
    
    $this->supplier = $supplier;
    $this->year = date('Y');
    
    if ($this->supplier)
    {
      $this->title = 'Ripartizione Spesa % per categoria '.$this->year;
    }
    else
    {
      $this->title = 'Ripartizione Fatturato % per categoria '.$this->year;
    }
    
    $this->category = CategoriaPeer::doSelect(new Criteria());
    
    $this->setTitle($this->title);
    
    if (!is_array($this->category))
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
       
    if ($this->supplier) 
    {
      $method = 'getOutcoming';
    }
    
    $serie->setName($this->title);
    $fatturato = $this->cash_flow->$method();
    
    $data = array();   
    foreach($this->category as $category)
    {
      if ($fatturato)
      {
        $value = $category->getTotaleFatture($this->year);
        
        if ($value > 0)
        {  
          $percentage = round (100 * $value / $fatturato, 2); 
          $data[] = array('name' => $category->getNome() . ' ('.$percentage. '%)', 'y' => $value);
        }
      }
    }
    
    $serie->setData($data);
    $this->addSerie($serie);
  }
}
