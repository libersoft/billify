<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new paTestFunctional(new sfBrowser());
$browser->loadData(sfConfig::get('sf_test_dir').'/fixtures/fixtures.yml');

$browser->
  login()->
  info('1. sale invoices list')->
  click('Vendita')->

  with('response')->begin()->
    checkElement('table', 2)->
    checkElement('table.fatture th', 9)->
    checkElement('table.fatture th', 'N.', array('position' => 1))->
    checkElement('table.fatture th', 'Ragione sociale', array('position' => 2))->
    checkElement('table.fatture th', 'Data', array('position' => 3))->
    checkElement('table.fatture th', 'Totale', array('position' => 4))->
    checkElement('table.fatture th', 'Stato', array('position' => 5))->
    checkElement('table.fatture th', 'Ritardo', array('position' => 6))->
    checkElement('table.fatture tr', 20)->
    checkElement('table.fatture td:contains("1")')->
    checkElement('table.fatture td:contains("2")')->
  end();

$browser->test()->todo('Test sale invoices filters');
$browser->test()->todo('Test invoices order');
$browser->test()->todo('Test taxes payment');
$browser->test()->todo('Test invoice copy');
$browser->test()->todo('Test invoice download');

$browser->click('1')->
  with('request')->begin()->
    isParameter('module', 'fattura')->
    isParameter('action', 'show')->
  end()->
  back()->
  click('01 Azienda')->
  with('request')->begin()->
    isParameter('module', 'contact')->
    isParameter('action', 'edit')->
  end()->

  info('2. sale invoice create')->
  get('fattura/create')->
  with('request')->begin()->
    isParameter('module', 'fattura')->
    isParameter('action', 'create')->
  end()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('#bread-crumps ul li', 4)->
    checkElement('#bread-crumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#bread-crumps ul li', '/Home/', array('position' => 1))->
    checkElement('#bread-crumps ul li', '/Fatture/', array('position' => 2))->
    checkElement('#bread-crumps ul li', '/Nuova/', array('position' => 3))->
    checkElement('h2', '/Nuova Fattura/')->
    checkElement('fieldset legend', 'Dati Fattura')->
    checkElement('table.fattura', 1)->
    checkElement('table th', 'Pro forma:', array('position' => 0))->
    checkElement('table th', 'Num fattura:', array('position' => 1))->
    checkElement('table th', 'Cliente:', array('position' => 2))->
    checkElement('table th', 'Data:', array('position' => 3))->
    checkElement('table th', 'Modo pagamento:', array('position' => 4))->
    checkElement('table th', 'Sconto:', array('position' => 5))->
    checkElement('table th', 'Iva:', array('position' => 6))->
    checkElement('table th', 'Spese anticipate:', array('position' => 7))->
    checkElement('table th', 'Calcola ritenuta:', array('position' => 8))->
    checkElement('table th', 'Calcola tasse:', array('position' => 9))->
    checkElement('table th', 'Scorpora tasse:', array('position' => 10))->
    checkElement('#cliente_id option', 20)->
    checkElement('#modo_pagamento_id option', 2)->
    checkElement('#modo_pagamento_id option', 'Rimessa diretta', array('position' => 0))->
    checkElement('#modo_pagamento_id option', '10 Giorni', array('position' => 1))->
    checkElement('#vat option', 1)->
    checkElement('#vat option', '20%')->
  end()->
  click('Salva e vai ai dettagli')->
  with('request')->begin()->
    isParameter('module', 'fattura')->
    isParameter('action', 'update')->
  end()->
  followRedirect()->
  with('request')->begin()->
    isParameter('module', 'fattura')->
    isParameter('action', 'show')->
  end()->
  with('response')->begin()->
    contains('Fattura n. 101 del '.date('d/m/y'))->
  end();

$browser->test()->todo('test invoice details');
$browser->test()->todo('test invoice calculation');

?>