<?php

class CashFlowPaginator
{
  protected $limit;
  protected $page;
  protected $cashflow;
  protected $results;
  protected $count_pages;
  
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

  public function init()
  {
    if($this->page == 'all')
    {
      $this->limit = $this->getCountAllResults();
      $this->results = $this->cashflow->getRows();
      $this->count_pages = ceil($this->getCountAllResults() / $this->limit);
      return;
    }

    $this->count_pages = ceil($this->getCountAllResults() / $this->limit);

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

    $this->results = $results;
  }
  
  public function getResults()
  {
    return $this->results;
  }
  
  public function getCountPages()
  {
    return $this->count_pages;
  }
  
  public function getPage()
  {
    return $this->page;
  }
  
  public function __call($name, $parameters)
  {
    return call_user_func(array($this->cashflow, $name), $parameters);
  }

  public function haveToPaginate()
  {
    if ($this->getCountPages() == 1)
    {
      return false;
    }

    return true;
  }
}