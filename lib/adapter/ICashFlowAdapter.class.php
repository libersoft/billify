<?php
/*
 * This file is part of the phpAccount software.
 * (c) 2009 Francesco (cphp) Trucchia <ft@ideato.it>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Cash flow interface
 *
 * @author Francescp (cphp) Trucchia <ft@ideato.it>
 * @version  $version$
 * @package cashflow
 * 
 */
Interface  ICashFlowAdapter {
  public function getDate();
  public function getDescription();
  public function getTaxable();
  public function getTaxes();
  public function getContact();
  public function getContactUrl();
  public function getDocumentUrl();
  public function getColorStato();
  public function getPaymentDate();
  public function isPaid();
}
?>