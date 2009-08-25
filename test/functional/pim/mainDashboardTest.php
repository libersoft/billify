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
  checkResponseElement('h2', 3)->
  checkResponseElement('h2', 'Riepilogo', array('position' => 0))->
  checkResponseElement('h2', 'Fatture da Inviare', array('position' => 1))->
  checkResponseElement('h2', 'Fatture da Incassare', array('position' => 2))->
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

  checkResponseElement('p strong', 'Fatturato annuo:', array('position' => 0))->
  checkResponseElement('p', '/9.000,00/', array('position' => 0))->
  checkResponseElement('p', '/12.960,00/', array('position' => 0))->

  checkResponseElement('p strong', 'Fatturato annuo incassato:', array('position' => 1))->
  checkResponseElement('p', '/1.000,00/', array('position' => 1))->
  checkResponseElement('p', '/1.440,00/', array('position' => 1))->

  checkResponseElement('p strong', 'Fatture da incassare:', array('position' => 2))->
  checkResponseElement('p', '/22/', array('position' => 2))->

  checkResponseElement('p strong', 'Iva da pagare:', array('position' => 3))->
  checkResponseElement('p strong', 'Totale da incassare:', array('position' => 4  ))->
  checkResponseElement('p', '/8.000,00/', array('position' => 4))->
  checkResponseElement('p', '/11.520,00/', array('position' => 4))->
  checkResponseElement('p', '/2.160,00/', array('position' => 3))->
  checkResponseElement('p', '/1.920,00/', array('position' => 3))->
  checkResponseElement('p', '/240,00/', array('position' => 3))->

  checkResponseElement('body', '!/Ritenuta d\'acconto versata/')


;