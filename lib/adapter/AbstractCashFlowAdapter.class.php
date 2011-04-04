<?php
/*
 * This file is part of the phpAccount software.
 * (c) 2009 Francesco (cphp) Trucchia <ft@ideato.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Abstract cash flow adapter
 *
 * @author Francescp (cphp) Trucchia <ft@ideato.it>
 * @version  $version$
 * @package cashflow
 */
abstract class AbstractCashFlowAdapter
{
  
  protected $with_taxes = true;
  protected $document;
  
  public function __construct($document) 
  {
    $this->document = $document;
  }
  
  /**
   * Calculate the document total
   *
   * @return integer
   */
  public function getTotal() 
  {
    return $this->getTaxable() + ($this->with_taxes ? $this->getTaxes() : 0);  
  }

  /**
   * Set if we have to calculate cashflow with taxes
   *
   * @param boolean $value
   */
  public function setWithTaxes($value)
  {
    $this->with_taxes = $value;
  }
  
}