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
  click('Clienti')->
  checkResponseElement('table', 1)->
  checkResponseElement('table tr', 11)->
  checkResponseElement('table tr th', 6)->
  checkResponseElement('table tr th', 'Ragione Sociale', array('position' => 0))->
  checkResponseElement('table tr th', 'Contatto', array('position' => 1))->
  checkResponseElement('table tr th', 'E-Mail', array('position' => 2))->
  checkResponseElement('table tr th', 'Telefono', array('position' => 3))->
  checkResponseElement('table tr th', 'Fax', array('position' => 4))->

  checkResponseElement('table tr td', '00 Azienda', array('position' => 0))->
  checkResponseElement('table tr td', '', array('position' => 1))->
  checkResponseElement('table tr td', 'azienda@example.it', array('position' => 2))->
  checkResponseElement('table tr td', '35989805', array('position' => 3))->
  checkResponseElement('table tr td', '36064127', array('position' => 4))->

  checkResponseElement('div.navigator', 1)->
  checkResponseElement('div.navigator a', '«', array('position' => 0))->
  checkResponseElement('div.navigator a', '<', array('position' => 1))->
  checkResponseElement('div.navigator', '/1/')->
  checkResponseElement('div.navigator a', '2', array('position' => 2))->
  checkResponseElement('div.navigator a', '>', array('position' => 3))->
  checkResponseElement('div.navigator a', '»', array('position' => 4))
;

$browser->
  get('/')->
  click('Crea Nuovo')->
  setField('contatto[ragione_sociale]', 'Gigi Lapislazulli')->
  setField('contatto[piva]', '1234')->
  setField('contatto[nazione]', 'Italia')->
  click('Salva')->

  followRedirect()->
  responseContains('Gigi Lapislazulli')->
  checkResponseElement('h2', 'Modifica cliente')
;
?>