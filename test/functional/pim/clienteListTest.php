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
  checkResponseElement('ul#lista')->
  checkResponseElement('ul#lista li', 10)->
  checkResponseElement('ul#lista li', '/00 Azienda/', array('position' => 0))->
  checkResponseElement('ul#lista li', '/01 Azienda/', array('position' => 1))->
  checkResponseElement('ul#lista li', '/3.000,00/', array('position' => 1))->
  checkResponseElement('ul#lista li', '/02 Azienda/', array('position' => 2))->
  checkResponseElement('ul#lista li', '/03 Azienda/', array('position' => 3))->
  checkResponseElement('div.navigator', 1)->
  checkResponseElement('div.navigator a', '«', array('position' => 0))->
  checkResponseElement('div.navigator a', '<', array('position' => 1))->
  checkResponseElement('div.navigator', '/1/')->
  checkResponseElement('div.navigator a', '2', array('position' => 2))->
  checkResponseElement('div.navigator a', '>', array('position' => 3))->
  checkResponseElement('div.navigator a', '»', array('position' => 4))->
  
  get('cliente/search', array('page' => 2))->
  checkResponseElement('ul#lista li', 10)->
  checkResponseElement('ul#lista li', '/10 Azienda/', array('position' => 0))->
  
  get('cliente/search', array('page' => 1))->
  checkResponseElement('ul#lista li', 10)->
  checkResponseElement('ul#lista li', '/00 Azienda/', array('position' => 0))
  
;