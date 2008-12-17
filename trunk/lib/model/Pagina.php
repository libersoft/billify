<?php

require_once 'lib/model/om/BasePagina.php';


/**
 * Skeleton subclass for representing a row from the 'pagina' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package model
 */	
class Pagina extends BasePagina {
  
  public function getStrippedTitle()
  {
  	$result = strtolower($this->getTitolo());

  	// strip all non word chars
  	$result = preg_replace('/\W/', ' ', $result);

  	// replace all white space sections with a dash
  	$result = preg_replace('/\ +/', '-', $result);

  	// trim dashes
  	$result = preg_replace('/\-$/', '', $result);
  	$result = preg_replace('/^\-/', '', $result);

  	return $result;
  }
} // Pagina
