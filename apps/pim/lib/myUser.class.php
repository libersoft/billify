<?php

class myUser extends sfBasicSecurityUser
{
  public function getId() 
  {
    return $this->getAttribute('id_utente');
  }

  public function signin(Utente $utente)
  {
    $this->setAuthenticated(true);
    $this->setAttribute('id_utente',$utente->getId());
    $this->setAttribute('nome',$utente->getNome());
    $this->setAttribute('cognome',$utente->getCognome());
    $this->setAttribute('tipo_utente',$utente->getTipo());

    FatturaPeer::$user_id = $utente->getId();

    if($utente->getUsername() == 'admin'){
      $this->addCredential('admin');
    }

    $this->addCredential('attivo');
    
    $utente->setLastlogin(time());
    $utente->save();

    return true;
  }

  public function getSettings()
  {
    return UtentePeer::getImpostazione();
  }

  public function setReferer($referer)
  {
    $this->setAttribute('referer', $referer);
  }

  public function getReferer($default)
  {
    return $this->hasAttribute('referer') ? $this->getAttribute('referer') : $default;
  }
}