<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  login()->
  info('Open a sent invoce and check if is editable')->
  click('fatture')->
  click('4')->
  with('response')->begin()->
    checkElement('.title h2', '/Fattura n. 4/')->
    checkElement('#col-right ul li', '/inviata/', array('position' => 0))->
    checkElement('img.delete', 0)->
    checkElement('.dettagli_fattura tr', 2)->
    checkElement('.dettagli_add', 0)->
  end()->        
  click('modifica')->
  followRedirect()->
  with('request')->begin()->
    isParameter('action', 'show')->
    isParameter('module', 'fattura')->
  end()->        
  click('elimina')->
  followRedirect()->
  with('request')->begin()->
    isParameter('action', 'show')->
    isParameter('module', 'fattura')->
  end()
;