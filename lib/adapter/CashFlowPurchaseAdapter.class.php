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
Class CashFlowPurchaseAdapter extends AbstractCashFlowAdapter implements ICashFlowAdapter 
{
  
  /**
   * Return purchase invoice date
   *
   * @return string
   */
  public function getDate($format = 'Y-m-d')
  {
    return $this->document->getData($format);
  }
  
  /**
   * Return purchase inovice description
   *
   * @return string
   */
  public function getDescription() 
  {
    return $this->document->__toString();
  }
  
  /**
   * Return purchase invoice taxable
   *
   * @return integer
   */
  public function getTaxable() 
  {
    return $this->document->getImponibile();
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
   * Return purchase invoice contact
   *
   * @return string
   */
  public function getContact()
  {
    return $this->document->getCliente()->__toString();
  }
  
  /**
   * Return purchase invoice contact url
   *
   * @return string
   */
  public function getContactUrl()
  {
    return 'contact/edit?id='.$this->document->getClienteId();
  }
  
  /**
   * Check if document is paid
   *
   * @return booleand
   */
  public function isPaid() 
  {
    return $this->document->getStato() == Fattura::PAGATA ? true : false;
  }
  
  /**
   * Return document url
   *
   * @return string
   */
  public function getDocumentUrl()
  {
    return 'invoice/edit?id='.$this->document->getId();
  }
  
  /**
   * Retrieve document color state;
   *
   * @return string
   */
  public function getColorStato()
  {
    return $this->document->getColorStato();
  }
  
  /**
   * Retrieve purchase invoice payment date
   *
   */
  public function getPaymentDate($format = 'Y/m/d') 
  {
    return $this->document->getDataPagamento($format);
  }
}