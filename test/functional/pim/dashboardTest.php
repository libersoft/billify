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
  checkResponseElement('table.fatture tr', 28)->
  checkResponseElement('table.fatture th', 14)->
  checkResponseElement('table.fatture th', 'N.', array('position' => 0))->
  checkResponseElement('table.fatture th', 'Ragione sociale', array('position' => 1))->
  checkResponseElement('table.fatture th', 'Data', array('position' => 2))->
  checkResponseElement('table.fatture th', 'Totale', array('position' => 3))->
  checkResponseElement('table.fatture th', 'Stato', array('position' => 4))->
  checkResponseElement('table.fatture th', 'Ritardo', array('position' => 5))->
  checkResponseElement('table.fatture th', 'Pdf', array('position' => 6))->

  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 0))->
  checkResponseElement('table.fatture td', '01 Azienda', array('position' => 1))->
  checkResponseElement('table.fatture td', date('d/m/y', strtotime('+1 day')), array('position' => 2))->
  checkResponseElement('table.fatture td', '/1.000,00/', array('position' => 3))->
  checkResponseElement('table.fatture td', '/1.440,00/', array('position' => 3))->
  checkResponseElement('table.fatture td', 'non inviata', array('position' => 4))->
  checkResponseElement('table.fatture td', 'no', array('position' => 5))->

// Sorting test
  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 0))->
  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 7))->
  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 14))->
  checkResponseElement('table.fatture td', '1', array('position' => 21))->
  checkResponseElement('table.fatture td', '2', array('position' => 28))->

  checkResponseElement('body', '!/Ritenuta d\'acconto versata/')
;