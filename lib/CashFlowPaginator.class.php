<?php

class CashFlowPaginator
{
  protected $limit;
  protected $page;
  protected $cashflow;
  
  public function __construct(CashFlow $cashflow)
  {
    $this->cashflow = $cashflow;
  }
  
  public function setLimit($limit)
  {
    $this->limit = $limit;
  }
  
  public function setPage($page)
  {
    $this->page = $page;
  }
  
  public function getCountAllResults()
  {
    return count($this->cashflow->getRows());
  }
  
  public function getResults()
  {
    $results = array();
    $all_results = $this->cashflow->getRows();
    $first = ($this->page-1)*$this->limit;
    
    for($i = $first, $y = 0; $i <  ($first + $this->limit); $i++, $y++)
    {
      if (!isset($all_results[$i]))
      {
        break;
      }
      $results[$y] = $all_results[$i];
    }
    
    return $results;
  }
  
  public function getCountPages()
  {
    return ceil($this->getCountAllResults() / $this->limit);
  }
  
  public function getPage()
  {
    return $this->page;
  }
  
  public function __call($name, $parameters)
  {
    return call_user_func(array($this->cashflow, $name), $parameters);
  }
}