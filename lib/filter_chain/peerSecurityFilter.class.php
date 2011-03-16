<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author cirpo
 */
class peerSecurityFilter extends sfFilter
{
 
  public function execute($filterChain)
  {
    FatturaPeer::$user_id = $this->getContext()->getUser()->getAttribute('id_utente');
    
    $filterChain->execute();
  }

}