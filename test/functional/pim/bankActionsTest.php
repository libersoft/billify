<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  login()->
  info('1. bank list')->
  click('impostazioni')->
  click('lista conti bancari')->

  with('request')->begin()->
    isParameter('module', 'bank')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'lista conti bancari')->
    checkElement('#breadcrumps ul li', 3)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Banche/', array('position' => 2))->
    checkElement('table', 1)->
    checkElement('table th', 4)->
    checkElement('table th', 'banca', array('position' => 0))->
    checkElement('table th', 'n. conto', array('position' => 1))->
    checkElement('table th', 'iban', array('position' => 2))->
    checkElement('table th', '', array('position' => 3))->
    checkElement('table td', 'Credito di PIM', array('position' => 0))->
    checkElement('table td a[title="Credito di PIM"]', 1)->
    checkElement('table td', '4752', array('position' => 1))->
    checkElement('table td', 'IT00 O011 7777 9999 0000 0001 111', array('position' => 2))->
    checkElement('table td img[alt="delete"]')->
  end()->

  info('2. delete bank')->
  click('delete')->

  with('request')->begin()->
    isParameter('module', 'bank')->
    isParameter('action', 'delete')->
  end()->
  followRedirect()->
  isForwardedTo('bank', 'index')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('table', 0)->
    checkElement('#col-left p', 'Nessuna banca disponibile, inserisci i dati della tua banca.')->
    checkElement('#col-left p a[title="create"]', 'inserisci i dati della tua banca')->
  end()->

  info('3. new bank')->
  get('bank/new')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('#breadcrumps ul li', 4)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Banche/', array('position' => 2))->
    checkElement('#breadcrumps ul li', '/Nuova banca/', array('position' => 3))->
    checkElement('h2', 'nuovo conto bancario')->
    checkElement('table.edit', 1)->
    checkElement('table th', 'Nome banca', array('position' => 0))->
    checkElement('table th', 'Abi', array('position' => 1))->
    checkElement('table th', 'Cab', array('position' => 2))->
    checkElement('table th', 'Cin', array('position' => 3))->
    checkElement('table th', 'Iban', array('position' => 4))->
    checkElement('table th', 'Numero conto', array('position' => 5))->
  end()->

  setField('banca[nome_banca]', 'Banca del tempo')->
  setField('banca[abi]', '1234')->
  setField('banca[cab]', '0034')->
  setField('banca[cin]', 'U')->
  setField('banca[iban]', 'IT 0034 90234 789')->
  setField('banca[numero_conto]', '98765400')->
  click('Salva')->

  followRedirect();

$browser->test()->todo('test bank validation');
  
$browser->
  click('Annulla')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('td:matches("Banca del tempo")')->
    checkElement('td:matches("IT 0034 90234 789")')->
    checkElement('td:matches("98765400")')->
  end()->

  info('4. edit bank')->
  click('Banca del tempo')->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', 'modifica conto bancario')->
    checkElement('#breadcrumps ul li', 4)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Banche/', array('position' => 2))->
    checkElement('#breadcrumps ul li', '/Modifica Banca del tempo/', array('position' => 3))->
  end()->
  setField('banca[nome_banca]', 'Banca del tempo2')->
  click('Salva')->
  followRedirect()->
  click('Annulla')->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('td:matches("Banca del tempo2")')->
  end();

$browser->click('esci');
$browser->
  login('freelance', 'freelance')->
  click('impostazioni')->
  click('lista conti bancari')->
  with('response')->begin()->
    checkElement('#col-left p', '/Nessuna banca disponibile/')->
  end();
