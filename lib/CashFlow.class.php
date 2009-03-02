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
  protected $rows = array();
  
  /**
   * Make sum of all row total value
   *
   * @param array $rows
   * @return integer
   */
  private function sum($rows) 
  {
    $balance = 0;
    
    foreach ($rows as $row) 
    {
      $balance += $row->getTotal();
    }
    
    return $balance;
  }
  
  /**
   * Add a purchase document instance of ICashFlowAdapter 
   *
   * @param ICashFlowAdapter $row
   */
  public function addOutcoming(ICashFlowAdapter $row) 
  {
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
      $this->incoming[] = $row;
      $this->rows[] = $row;
  }
  
  /**
   * Get balance of all row added to cash flow
   *
   * @return integer
   */
  public function getBalance() 
  {
    return $this->getIncoming() - $this->getOutcoming();
  }
  
  /**
   * Get incoming of all row added to cash flow
   *
   * @return integer
   */
  public function getIncoming() 
  {
    return $this->sum($this->incoming);
  }
  
  /**
   * Get outcoming of all row added to cash flow
   *
   * @return integer
   */
  public function getOutcoming() 
  {
    return $this->sum($this->outcoming);
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
}