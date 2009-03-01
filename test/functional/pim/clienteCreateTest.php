<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$data = new sfPropelData();
$data->loadData(sfConfig::get('sf_test_dir').'/fixtures/fixtures.yml');
 
$browser = new sfTestBrowser();
$browser->initialize();

$browser->
  get('/')->
  setField('login', 'user')->
  setField('password', 'user')->
  click('Entra')->
  followRedirect()->
  click('Crea Nuovo')->
  setField('contatto[ragione_sociale]', 'Gigi Lapislazulli')->
  setField('contatto[piva]', '1234')->
  setField('contatto[nazione]', 'Italia')->
  click('Salva')->
  
  followRedirect()->
  responseContains('Gigi Lapislazulli')->
  checkResponseElement('h2', 'Modifica cliente')
;
  
  