<?php
/*
 * This file is part of the phpAccount software.
 * (c) 2009 Francesco (cphp) Trucchia <ft@ideato.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Cash flow model
 *
 * @author Francescp (cphp) Trucchia <ft@ideato.it>
 * @version  $version$
 * @package cashflow
 *
 */
Class CashFlow
{
  protected $incoming = array();
  protected $outcoming = array();
  protected $incoming_taxes = array();
  protected $outcoming_taxes = array();
  protected $balances = array();
  protected $rows = array();
  protected $with_taxes = true;


  private static $instance;

  private function __construct()
  {

  }

  /**
   * Singleton implementation
   * 
   * @return CashFlow
   */
  public static function getInstance()
  {
    if(!self::$instance)
    {
      self::$instance = new self;
    }

    return self::$instance;
  }

  public function reset()
  {
    $this->incoming = array();
    $this->outcoming = array();
    $this->rows = array();
    $this->with_taxes = true;
    $this->resetBalances();
  }

  public function resetBalances()
  {
    $this->balances = array();
  }

  /**
   * Make sum of all row total value
   *
   * @param array $rows
   * @return integer
   */
  private function sum($name, $rows, $method = 'getTotal')
  {
    if (!isset($this->balances[$name]))
    {
      $balance = 0;

      foreach ($rows as $row)
      {
        $balance += call_user_func(array($row, $method));
      }

      $this->balances[$name] = $balance;
    }

    return $this->balances[$name];
  }

  /**
   * Add a purchase document instance of ICashFlowAdapter
   *
   * @param ICashFlowAdapter $row
   */
  public function addOutcoming(ICashFlowAdapter $row)
  {
    $this->resetBalances();
    $row->setWithTaxes($this->with_taxes);
    $this->outcoming[] = $row;
    $this->rows[] = $row;
  }

  /**
   * Add a sales document instance of ICashFlowAdapter
   *
   * @param ICashFlowAdapter $row
   */
  public function addIncoming(ICashFlowAdapter $row)
  {
    $this->resetBalances();
    $row->setWithTaxes($this->with_taxes);
    $this->incoming[] = $row;
    $this->rows[] = $row;
  }

  /**
   * Get balance for all row added to cash flow
   *
   * @return integer
   */
  public function getBalance()
  {
    return $this->getIncoming() - $this->getOutcoming();
  }

  /**
   * Get balance of taxes for all rows added to cash flow
   *
   * @return integer
   */
  public function getBalanceTaxes()
  {
    return $this->getOutcomingTaxes() - $this->getIncomingTaxes();
  }

  /**
   * Get incoming for all row added to cash flow
   *
   * @return integer
   */
  public function getIncoming()
  {
    return $this->sum('incoming_total', $this->incoming);
  }

  /**
   * Get incoming tasex for all row added to cash flow
   *
   * @return integer
   */
  public function getIncomingTaxes()
  {
    return $this->sum('incoming_taxes', $this->incoming, 'getTaxes');
  }

  /**
   * Get outcoming for all row added to cash flow
   *
   * @return integer
   */
  public function getOutcoming()
  {
    return $this->sum('outcoming_total', $this->outcoming);
  }

  /**
   * Get outcoming taxes for all row added to cash flow
   * 
   * @return integer
   */
  public function getOutcomingTaxes()
  {
    return $this->sum('outcoming_taxes', $this->outcoming, 'getTaxes');
  }

  /**
   * Get all rows added to cash flow
   *
   * @return integer
   */
  public function getRows()
  {
    return $this->rows;
  }

  public function addDocuments($documents)
  {
    foreach ($documents as $index => $document)
    {
      $document->addToCashFlow($this);
    }
  }
  
  public function getResults()
  {
    return $this->getRows();
  }

  public function setWithTaxes($value)
  {
    $this->with_taxes = $value;
  }
}