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
  checkResponseElement('table.fatture tr', 41)->
  checkResponseElement('table.fatture th', 16)->
  checkResponseElement('table.fatture th', 'n.', array('position' => 0))->
  checkResponseElement('table.fatture th', 'ragione sociale', array('position' => 1))->
  checkResponseElement('table.fatture th', 'data', array('position' => 2))->
  checkResponseElement('table.fatture th', 'imponibile', array('position' => 3))->
  checkResponseElement('table.fatture th', 'totale', array('position' => 4))->
  checkResponseElement('table.fatture th', 'stato', array('position' => 5))->
  checkResponseElement('table.fatture th', 'ritardo', array('position' => 6))->
  checkResponseElement('table.fatture th', 'pdf', array('position' => 7))->

  checkResponseElement('.invoice-pro-forma', '/Pro-Forma/', array('position' => 0))->
  checkResponseElement('.invoice-pro-forma', 5)->
        
  checkResponseElement('.invoice-1 td', '01 Azienda', array('position' => 1))->
  checkResponseElement('.invoice-1 td', '/1.000,00/', array('position' => 3))->

  checkResponseElement('.invoice-9', 2)->
  checkResponseElement('.invoice-9 td', '01/01/'.date('Y', strtotime('-10 year')), array('position' => 2))->
  checkResponseElement('.invoice-5', 2)->
  checkResponseElement('.invoice-5 td', '01/01/'.date('Y', strtotime('-6 year')), array('position' => 2))->
  
  checkResponseElement('.invoice-7', 2)->
  checkResponseElement('.invoice-7 td', date('d/m/Y', strtotime('+7 days')), array('position' => 10))->
        
  checkResponseElement('.invoice-pro-forma td', '/1.000,00/', array('position' => 11))->
  checkResponseElement('.invoice-pro-forma td', '/1.440,00/', array('position' => 12))->
  checkResponseElement('.invoice-pro-forma td', 'non inviata', array('position' => 13))->
  checkResponseElement('.invoice-pro-forma td', 'no', array('position' => 14))->

// Sorting test
  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 0))->
  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 8))->
  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 16))->
  checkResponseElement('table.fatture td', '/Pro-Forma/', array('position' => 24))->
  checkResponseElement('table.fatture td', '1', array('position' => 32))->
  checkResponseElement('table.fatture td', '2', array('position' => 40))->

  checkResponseElement('body', '!/Ritenuta d\'acconto versata/')
;