<?php
/*
 * This file is part of the phpAccount software.
 * (c) 2009 Francesco (cphp) Trucchia <ft@ideato.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class to adapt purchase invoice bahaviour to cash flow behaviour
 * 
 * @author Francescp (cphp) Trucchia <ft@ideato.it>
 * @version  $version$
 * @package cashflow
 *
 */
Class CashFlowExitAdapter extends CashFlowPurchaseAdapter implements ICashFlowAdapter 
{
  
  /**
   * Return purchase inovice description
   *
   * @return string
   */
  public function getDescription() 
  {
    return $this->document->getDescrizione();
  }
  
  /**
   * Return purchase invoice contact
   *
   * @return string
   */
  public function getContact()
  {
    return $this->document->getContattoString();
  }
  
  /**
   * Return purchase invoice taxes
   *
   * @return integer
   */
  public function getTaxes() 
  {
    return $this->document->getImposte();
  }
  
  /**
   * Return purchase invoice contact url
   *
   * @return string
   */
  public function getContactUrl()
  {
    return '#';
  }
  
  /**
   * Return document url
   *
   * @return string
   */
  public function getDocumentUrl()
  {
    return 'cashflow/edit?id='.$this->document->getId();
  }
  
  /**
   * Retrieve purchase invoice payment date
   *
   */
  public function getPaymentDate($format = 'Y/m/d') 
  {
    return $this->document->getDataScadenza($format);
  }
}