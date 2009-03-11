<?php

class myUser extends sfBasicSecurityUser
{
  public function getId() 
  {
    return $this->getAttribute('id_utente');
  }
}

?>