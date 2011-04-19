<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

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
  checkResponseElement('table.fatture tr', 40)->
  checkResponseElement('table.fatture th', 16)->
  checkResponseElement('table.fatture th', 'n.', array('position' => 0))->
  checkResponseElement('table.fatture th', 'ragione sociale', array('position' => 1))->
  checkResponseElement('table.fatture th', 'data', array('position' => 2))->
  checkResponseElement('table.fatture th', 'imponibile', array('position' => 3))->
  checkResponseElement('table.fatture th', 'totale', array('position' => 4))->
  checkResponseElement('table.fatture th', 'stato', array('position' => 5))->
  checkResponseElement('table.fatture th', 'ritardo', array('position' => 6))->
  checkResponseElement('table.fatture th', 'pdf', array('position' => 7))->

  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 0))->
  checkResponseElement('table.fatture td', '01 Azienda', array('position' => 1))->
  checkResponseElement('table.fatture td', '/1.000,00/', array('position' => 3))->

  checkResponseElement('table.fatture td', '9', array('position' => 56))->
  checkResponseElement('table.fatture td', '01/01/'.date('Y', strtotime('-10 year')), array('position' => 58))->
  checkResponseElement('table.fatture td', '5', array('position' => 88))->
  checkResponseElement('table.fatture td', '01/01/'.date('Y', strtotime('-6 year')), array('position' => 90))->
  
  checkResponseElement('table.fatture td', '7', array('position' => 152))->
  checkResponseElement('table.fatture td', date('d/m/Y', strtotime('+7 days')), array('position' => 154))->
  
  checkResponseElement('table.fatture td', '/1.000,00/', array('position' => 3))->
  checkResponseElement('table.fatture td', '/1.440,00/', array('position' => 4))->
  checkResponseElement('table.fatture td', 'non inviata', array('position' => 5))->
  checkResponseElement('table.fatture td', 'no', array('position' => 6))->

// Sorting test
  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 0))->
  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 8))->
  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 16))->
  checkResponseElement('table.fatture td', '1', array('position' => 24))->
  checkResponseElement('table.fatture td', '2', array('position' => 32))->

  checkResponseElement('body', '!/Ritenuta d\'acconto versata/')
;