<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  login()->
  info('1. taxes codes list')->
  click('impostazioni')->
  click('lista codici iva')->

  with('request')->begin()->
    isParameter('module', 'taxescode')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Lista codici iva')->
    checkElement('#breadcrumps ul li', 3)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Codici iva/', array('position' => 2))->
    checkElement('table', 1)->
    checkElement('table th', 4)->
    checkElement('table th', 'nome', array('position' => 0))->
    checkElement('table th', 'valore', array('position' => 1))->
    checkElement('table th', 'descrizione', array('position' => 2))->
    checkElement('table td a[title="codice iva"]')->
    checkElement('table td', '20%', array('position' => 0))->
    checkElement('table td', '20', array('position' => 1))->
    checkElement('table td', 'Iva al 20%', array('position' => 2))->
    checkElement('table td img[alt="delete"]')->
  end()->

  info('2. delete taxes code')->
  click('delete')->

  with('request')->begin()->
    isParameter('module', 'taxescode')->
    isParameter('action', 'delete')->
  end()->
  followRedirect()->
  isForwardedTo('taxescode', 'index')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('table', 0)->
    checkElement('#cols2 p', 'Nessun codice iva disponibile, crea un nuovo codice iva.')->
    checkElement('#cols2 p a[title="create"]', 'crea un nuovo codice iva')->
  end()->

  info('3. new tax code')->
  click('nuovo codice iva')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Nuovo codice iva')->
    checkElement('#breadcrumps ul li', 4)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Codici iva/', array('position' => 2))->
    checkElement('#breadcrumps ul li', '/Nuovo codice iva/', array('position' => 3))->
    checkElement('table', 1)->
    checkElement('table th', 'Nome', array('position' => 0))->
    checkElement('table th', 'Valore', array('position' => 1))->
    checkElement('table th', 'Descrizione', array('position' => 2))->
  end()->

  setField('codice_iva[nome]', '20%')->
  setField('codice_iva[valore]', '20')->
  setField('codice_iva[descrizione]', 'Iva al 20%')->
  click('Salva')->

  followRedirect();

$browser->test()->todo('test tax validation');

$browser->
  click('Annulla')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('td:contains("20%")')->
    checkElement('td:contains("20")')->
    checkElement('td:contains("Iva al 20%")')->
  end()->

  info('4. edit tax code')->
  click('20%')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'Modifica codice iva')->
    checkElement('#breadcrumps ul li', 4)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Codici iva/', array('position' => 2))->
    checkElement('#breadcrumps ul li', '/Modifica 20%/', array('position' => 3))->
  end()->
  setField('codice_iva[nome]', '25%')->
  setField('codice_iva[valore]', '25')->
  click('Salva')->
  followRedirect()->
  click('Annulla')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('td:contains("25%")')->
    checkElement('td:contains("25")')->
  end();