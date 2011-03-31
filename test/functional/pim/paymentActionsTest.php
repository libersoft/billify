<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData(sfConfig::get('sf_test_dir').'/fixtures/fixtures.yml');

$browser->
  login()->
  info('1. payment list')->
  click('impostazioni')->
  click('lista tipologie di pagamento')->

  with('request')->begin()->
    isParameter('module', 'payment')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Tipologie di pagamento')->
    checkElement('#breadcrumps ul li', 3)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Tipologie di pagamento/', array('position' => 2))->
    checkElement('table', 1)->
    checkElement('table th', 3)->
    checkElement('table th', 'Num giorni', array('position' => 0))->
    checkElement('table th', 'Descrizione', array('position' => 1))->
    checkElement('table th', '', array('position' => 3))->
    checkElement('table td', '0', array('position' => 0))->
    checkElement('table td a', 4)->
    checkElement('table td', 'Rimessa diretta', array('position' => 1))->
    checkElement('table td img')->
  end()->

  info('2. delete payment')->
  click('delete')->

  with('request')->begin()->
    isParameter('module', 'payment')->
    isParameter('action', 'delete')->
  end()->
  followRedirect()->
  isForwardedTo('payment', 'index')->
  click('delete')->
  followRedirect()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('table', 0)->
    checkElement('#cols2 p', 'Nessuna tipologia di pagamento disponibile, inserisci un nuovo tipo.')->
    checkElement('#cols2 p a[title="create"]', 'inserisci un nuovo tipo')->
  end()->

  info('4. new payment')->
  click('nuova tipologia di pagamento')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('#breadcrumps ul li', 4)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Tipologie di pagamento/', array('position' => 2))->
    checkElement('#breadcrumps ul li', '/Nuova tipologia/', array('position' => 3))->
    checkElement('h2', 'Nuova tipologia di pagamento')->
    checkElement('table.banca', 1)->
    checkElement('table th', 'Num giorni', array('position' => 0))->
    checkElement('table th', 'Descrizione', array('position' => 1))->
  end()->

  setField('modo_pagamento[num_giorni]', '90')->
  setField('modo_pagamento[descrizione]', '90gg')->
  click('Salva')->

  followRedirect();

$browser->test()->todo('test payment validation');
  /*with('form')->begin()->

  end()->*/
$browser->
  click('Annulla')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('td:contains("90")')->
    checkElement('td:contains("90gg")')->
  end()->

  info('4. edit payment')->
  click('90')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Modifica tipologia di pagamento')->
    checkElement('#breadcrumps ul li', 4)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Tipologie di pagamento/', array('position' => 2))->
    checkElement('#breadcrumps ul li', '/Modifica 90gg/', array('position' => 3))->
  end()->
  setField('modo_pagamento[descrizione]', '90ggg')->
  click('Salva')->
  followRedirect()->
  click('Annulla')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('td:contains("90ggg")')->
  end();
;
