<?php

class myUser extends sfBasicSecurityUser
{
  private $user;

  public function __toString()
  {
    return (string)$this->getUser();
  }

  public function getUser()
  {
    if (!$this->user)
    {
      $this->user = UtentePeer::retrieveByPk($this->getAttribute('id_utente'));
    }

    return $this->user;
  }

  public function getId() 
  {
    return $this->getAttribute('id_utente');
  }

  public function signin(Utente $utente)
  {
    $this->setAuthenticated(true);
    $this->setAttribute('id_utente', $utente->getId());
    $this->setAttribute('nome', $utente->getNome());
    $this->setAttribute('cognome', $utente->getCognome());
    $this->setAttribute('tipo_utente', $utente->getTipo());

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
    
    if (!$this->hasAttribute('impostazioni'))
    {
      $settings = ImpostazionePeer::retrieveByIdUtente($this->getId());
      $this->setAttribute('impostazioni', $settings);

      if (!$settings)
      {
        throw new Exception('User have invalid settings');
      }
    }
    
    return $this->getAttribute('impostazioni');
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