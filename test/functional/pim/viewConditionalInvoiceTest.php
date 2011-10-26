<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  get('/')->
  setField('login', 'user')->
  setField('password', 'user')->
  click('Entra')->
  followRedirect()->

  click('lista clienti')->
  click('01 Azienda')->
  click('Pro-Forma')->

  with('request')->begin()->
    isParameter('action', 'show')->
    isParameter('module', 'fattura')->
  end()->

  click('lista fornitori')->
  click('01 Fornitore')->
  click('10/3')->

  with('request')->begin()->
	isParameter('action', 'edit')->
    isParameter('module', 'invoice')->
  end()

;  

