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
  checkResponseElement('h2', 2)->
  checkResponseElement('h2', 'fatture da inviare', array('position' => 0))->
  checkResponseElement('h2', 'fatture da incassare', array('position' => 1))->
  checkResponseElement('table.fatture', 2)->
  checkResponseElement('table.fatture tr', 25)->
  checkResponseElement('table.fatture th', 14)->
  checkResponseElement('table.fatture th', 'N.', array('position' => 0))->
  checkResponseElement('table.fatture th', 'Ragione sociale', array('position' => 1))->
  checkResponseElement('table.fatture th', 'Data', array('position' => 2))->
  checkResponseElement('table.fatture th', 'Totale', array('position' => 3))->
  checkResponseElement('table.fatture th', 'Stato', array('position' => 4))->
  checkResponseElement('table.fatture th', 'Ritardo', array('position' => 5))->
  checkResponseElement('table.fatture th', 'Pdf', array('position' => 6))->

  checkResponseElement('table.fatture td', '1', array('position' => 0))->
  checkResponseElement('table.fatture td', '01 Azienda', array('position' => 1))->
  checkResponseElement('table.fatture td', date('d/m/y', strtotime('+1 day')), array('position' => 2))->
  checkResponseElement('table.fatture td', '/1.000,00/', array('position' => 3))->
  checkResponseElement('table.fatture td', '/1.440,00/', array('position' => 3))->
  checkResponseElement('table.fatture td', 'non inviata', array('position' => 4))->
  checkResponseElement('table.fatture td', 'no', array('position' => 5))->

  checkResponseElement('ul#resume li strong', 'fatturato annuo:', array('position' => 0))->
  checkResponseElement('ul#resume li', '/9.000,00/', array('position' => 0))->
  checkResponseElement('ul#resume li', '/12.960,00/', array('position' => 0))->

  checkResponseElement('ul#resume li strong', 'fatturato annuo incassato:', array('position' => 1))->
  checkResponseElement('ul#resume li', '/1.000,00/', array('position' => 1))->
  checkResponseElement('ul#resume li', '/1.440,00/', array('position' => 1))->

  checkResponseElement('ul#resume li strong', 'fatture da incassare:', array('position' => 2))->
  checkResponseElement('ul#resume li', '/22/', array('position' => 2))->

  checkResponseElement('ul#resume li strong', 'iva da pagare:', array('position' => 3))->
  checkResponseElement('ul#resume li strong', 'totale da incassare:', array('position' => 4  ))->
  checkResponseElement('ul#resume li', '/8.000,00/', array('position' => 4))->
  checkResponseElement('ul#resume li', '/11.520,00/', array('position' => 4))->
  checkResponseElement('ul#resume li', '/2.160,00/', array('position' => 3))->
  checkResponseElement('ul#resume li', '/1.920,00/', array('position' => 3))->
  checkResponseElement('ul#resume li', '/240,00/', array('position' => 3))->

  checkResponseElement('body', '!/Ritenuta d\'acconto versata/')


;