<?php

class UtentePeer extends BaseUtentePeer
{

  public static function getUtenteCorrente()
  {
    $criteria = new Criteria();
    $criteria->add(UtentePeer::ID, sfContext::getInstance()->getUser()->getAttribute('id_utente'));
    $user = UtentePeer::doSelectOne($criteria);

    if (!$user)
    {
      throw new Exception('L\'utente corrente non è più valido');
    }

    return $user;
  }

  public static function retrieveByUsername($username)
  {
    $criteria = new Criteria();
    $criteria->add(UtentePeer::USERNAME, $username);

    return UtentePeer::doSelectOne($criteria);
  }
  
  /**
   *
   * @deprecated
   * @see myUser::getSettings()
   * 
   * @return type 
   */
  public static function getImpostazione()
  {
    if (!sfContext::getInstance()->getUser()->hasAttribute('impostazioni'))
    {
      $utente = UtentePeer::getUtenteCorrente();
      $impostazione = $utente->getImpostazione();
      sfContext::getInstance()->getUser()->setAttribute('impostazioni', $impostazione);
    }
    return sfContext::getInstance()->getUser()->getAttribute('impostazioni');
  }

  public static function getNumberUtente($tipo = Utente::DEMO)
  {
    $criteria = new Criteria();
    $criteria->add(UtentePeer::TIPO, $tipo);
    return UtentePeer::doCount($criteria);
  }

  public static function checkDemo()
  {
    if (sfContext::getInstance()->getUser()->getAttribute('tipo_utente') == Utente::DEMO)
      return true;
    else
      return false;
  }

  public static function countGiorniDemoRimasti()
  {
    $utente = UtentePeer::getUtenteCorrente();
    return $utente->getGiorniDemoRimasti();
  }

}

// UtentePeer
