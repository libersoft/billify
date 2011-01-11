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
  get('/statistiche/fatturatoannuo')->

  checkResponseElement('chart_type', 'column')->
  checkResponseElement('row', 5)->
  checkResponseElement('row string', date('Y'), array('position' => 1))->
  checkResponseElement('row string', date('Y', strtotime('-1 year')), array('position' => 2))
  

;