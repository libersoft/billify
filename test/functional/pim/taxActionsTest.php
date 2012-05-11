<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  login()->
  info('1. tax list')->
  click('impostazioni')->
  click('lista tasse')->

  with('request')->begin()->
    isParameter('module', 'tax')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Lista tasse')->
    checkElement('#breadcrumps ul li', 3)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Tasse/', array('position' => 2))->
    checkElement('table', 1)->
    checkElement('table th', 3)->
    checkElement('table th', 'nome', array('position' => 0))->
    checkElement('table th', 'valore', array('position' => 1))->
    checkElement('table td a[title="tassa"]')->
    checkElement('table td', 'tassa', array('position' => 0))->
    checkElement('table td', '20', array('position' => 1))->
    checkElement('table td img[alt="delete"]')->
  end()->

  info('2. delete tax')->
  click('delete')->

  with('request')->begin()->
    isParameter('module', 'tax')->
    isParameter('action', 'delete')->
  end()->
  followRedirect()->
  isForwardedTo('tax', 'index')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('table', 0)->
    checkElement('#cols2 p', 'Nessuna tassa disponibile, crea la tua tassa.')->
    checkElement('#cols2 p a[title="create"]', 'crea la tua tassa')->
  end()->

  info('3. new tax')->
  get('tax/new')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Nuova tassa')->
    checkElement('#breadcrumps ul li', 4)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Tasse/', array('position' => 2))->
    checkElement('#breadcrumps ul li', '/Nuova tassa/', array('position' => 3))->
    checkElement('table.banca', 1)->
    checkElement('table th', 'Nome', array('position' => 0))->
    checkElement('table th', 'Valore', array('position' => 1))->
    checkElement('table th', 'Descrizione', array('position' => 2))->
  end()->

  setField('tassa[nome]', 'Tassa 2')->
  setField('tassa[valore]', '20')->
  setField('tassa[descrizione]', 'Descrizione della tassa 2')->
  click('Salva')->

  followRedirect();

$browser->test()->todo('test tax validation');
  /*with('form')->begin()->

  end()->*/
$browser->
  click('Annulla')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('td:matches("Tassa 2")')->
    checkElement('td:matches("20")')->
  end()->

  info('4. edit tax')->
  click('Tassa 2')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Modifica tassa')->
    checkElement('#breadcrumps ul li', 4)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Tasse/', array('position' => 2))->
    checkElement('#breadcrumps ul li', '/Modifica Tassa 2/', array('position' => 3))->
  end()->
  setField('tassa[nome]', 'Tassa 3')->
  click('Salva')->
  followRedirect()->
  click('Annulla')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('td:matches("Tassa 3")')->
  end();
