<?php

/**
 * Subclass for representing a row from the 'contatto' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Contatto extends BaseContatto
{
  const ATTIVO = 'a';
  const NON_ATTIVO = 'n';

  public function __toString() {
    return $this->ragione_sociale;
  }

  public function hasCompleteInfo()
  {
      return (bool)($this->getVia() && $this->getCap() && $this->getCitta() && $this->getProvincia());
  }
}
