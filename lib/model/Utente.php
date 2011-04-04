<?php

require_once 'lib/model/om/BaseUtente.php';

/**
 * Skeleton subclass for representing a row from the 'utente' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */
class Utente extends BaseUtente
{
  const DEMO = 'demo';
  const BASE = 'base';
  const PRO = 'pro';
  const GIORNI = 30;

  public function __toString()
  {
    return $this->getUsername();
  }

  /**
   * Set the value of [password] column.
   * 
   * @param string $v new value
   * @return void
   */
  public function setPassword($v)
  {

    if ($this->password !== $v || $v === '')
    {
      $this->password = md5($v);
      $this->modifiedColumns[] = UtentePeer::PASSWORD;
    }
  }

// setPassword()

  public static function generatePassword($length = 8)
  {
    // start with a blank password
    $password = "";

    // define possible characters
    $possible = "0123456789bcdfghjkmnpqrstvwxyz-!?";

    // set up a counter
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length)
    {

      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);

      // we don't want this character if it's already in the password
      if (!strstr($password, $char))
      {
        $password .= $char;
        $i++;
      }
    }

    // done!
    return $password;
  }

  public function checkRinnovo()
  {
    $oggi = time();
    list($mese, $giorno, $anno) = explode('-', $this->getDataRinnovo());
    $data_rinnovo = mktime(0, 0, 0, $mese + 1, $giorno, $anno);
    if ($oggi >= $data_rinnovo)
    {
      return true;
    }
    return false;
  }

  public function rinnova()
  {
    $this->setDataRinnovo(date('y-m-d', time()));
  }

  public function getNbClienti()
  {
    return count($this->getClientes());
  }

  public function getNbFatture()
  {
    return count($this->getFatturas());
  }

  public function getInvito()
  {
    if (!is_null($this->getIdInvitationCode()))
    {
      return 'Si';
    } else
    {
      return 'No';
    }
  }

  public function getScontoLabel()
  {
    if ($this->getSconto() == 1)
    {
      return 'Si';
    } else
    {
      return 'No';
    }
  }

  public function getFatturato()
  {
    use_helper('Number');

    $criteria = new Criteria();
    $fatture = $this->getFatturas($criteria);

    $fatturato = 0;
    $tasse = TassaPeer::doSelect(new Criteria());

    foreach ($fatture as $fattura)
    {
      $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
      $fatturato = $fatturato + $fattura->getNettoDaLiquidare();
    }

    return format_currency($fatturato, '&euro;');
  }

  public function getGiorniDemoRimasti()
  {
    if ($this->getTipo() == Utente::DEMO)
    {
      $oggi = mktime(0, 0, 0, date('m', time()), date('d', time()), date('y', time()));
      list($mese, $giorno, $anno) = explode('/', $this->getDataAttivazione());
      $data_rinnovo = mktime(0, 0, 0, $mese, $giorno + Utente::GIORNI, $anno);
      $giorni = ($data_rinnovo - $oggi) / 3600 / 24;
      if ($giorni < 0)
        return 0;
      else
        return $giorni;
    }else
      return 1;
  }

  public function checkDemo()
  {
    if ($this->getGiorniDemoRimasti() <= 0)
      return true;
    else
      return false;
  }

  public function getDataScadenza()
  {
    list($mese, $giorno, $anno) = explode('/', $this->getDataRinnovo());
    $data_scadenza = mktime(0, 0, 0, $mese + 1, $giorno, $anno);
    return date('d/m/y', $data_scadenza);
  }

}

// Utente
