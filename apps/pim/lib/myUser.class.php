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

    if($utente->getUsername() == 'admin'){
      $this->addCredential('admin');
    }

    $this->addCredential('attivo');
    
    $utente->setLastlogin(time());
    $utente->save();

    return true;
  }
}

?>