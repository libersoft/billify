<?php

/**
 * bug actions.
 *
 * @package    sf_sandbox
 * @subpackage bug
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class bugActions extends autobugActions
{
  protected function updatebugFromRequest()
  {
    
    $this->bug->setPriorita($this->getRequestParameter('priorita'));
    $this->bug->setModulo($this->getRequestParameter('modulo'));
    $this->bug->setStato($this->getRequestParameter('stato'));
 
    parent::updatebugFromRequest();
  }
}