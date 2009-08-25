<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new paTestFunctional(new sfBrowser());
$browser->loadData(sfConfig::get('sf_test_dir').'/fixtures/fixtures.yml');

$browser->
  login()->
  info('1. invoice themes list')->
  click('Temi Fattura')->

  with('request')->begin()->
    isParameter('module', 'temafattura')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Temi Fattura')->
    checkElement('#bread-crumps ul li', 3)->
    checkElement('#bread-crumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#bread-crumps ul li', '/Home/', array('position' => 1))->
    checkElement('#bread-crumps ul li', '/Temi Fattura/', array('position' => 2))->
    checkElement('table.fatture', 1)->
    checkElement('table th', 2)->
    checkElement('table th', 'Nome', array('position' => 0))->
    checkElement('table td', 'ideato srl', array('position' => 0))->
    checkElement('table td img[alt="delete"]')->
  end()->

  info('2. delete invoice theme')->
  click('delete')->

  with('request')->begin()->
    isParameter('module', 'temafattura')->
    isParameter('action', 'delete')->
  end()->
  followRedirect()->
  isForwardedTo('temafattura', 'list')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('table', 0)->
    checkElement('#content p', 'Nessun tema disponibile, crea il tuo tema fattura.')->
    checkElement('#content p a', 'crea il tuo tema fattura')->
  end()->

  info('3. new invoice theme')->
  click('crea il tuo tema fattura')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('#bread-crumps ul li', 4)->
    checkElement('#bread-crumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#bread-crumps ul li', '/Home/', array('position' => 1))->
    checkElement('#bread-crumps ul li', '/Temi Fattura/', array('position' => 2))->
    checkElement('#bread-crumps ul li', '/Nuovo tema Fattura/', array('position' => 3))->
    checkElement('h2', '/Nuovo Tema/')->
    checkElement('#edit-options ul li', '/Nome Tema/')->
    checkElement('#edit-options ul li', '/Modello Fattura/', array('position' => 1))->
    checkElement('#edit-options ul li', '/Stile Fattura/', array('position' => 2))->
    checkElement('#nome table.banca', 1)->
    checkElement('#nome table th', 'Nome*:', array('position' => 0))->
    checkElement('#nome table th', 'Logo Ditta:', array('position' => 1))->
    checkElement('#header table.banca', 1)->
    checkElement('#header table th', 'Modello Fattura*:', array('position' => 0))->
    checkElement('#css table.banca', 1)->
    checkElement('#css table th', 'Stile Fattura*:', array('position' => 0))->
  end()->

  setField('nome', 'tema test')->
  click('Salva')->

  followRedirect();

$browser->test()->todo('test bank validation');
  /*with('form')->begin()->

  end()->*/

$browser->click('Temi Fattura')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('td:contains("tema test")')->
  end()->

  info('4. edit bank')->
  click('tema test')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', '/Modifica Tema/')->
    checkElement('#bread-crumps ul li', 4)->
    checkElement('#bread-crumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#bread-crumps ul li', '/Home/', array('position' => 1))->
    checkElement('#bread-crumps ul li', '/Temi Fattura/', array('position' => 2))->
    checkElement('#bread-crumps ul li', '/Modifica tema test/', array('position' => 3))->
  end()->
  setField('nome', 'tema test 2')->
  click('Salva')->
  followRedirect()->

  click('Temi Fattura')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('td:contains("tema test 2")')->
  end();

;