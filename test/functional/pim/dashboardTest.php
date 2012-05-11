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
  with('response')->
  begin()->
  checkElement('h2', 2)->
  checkElement('h2', 'fatture da inviare', array('position' => 0))->
  checkElement('h2', 'fatture da incassare', array('position' => 1))->
  checkElement('table.fatture', 2)->
  checkElement('table.fatture tr', 41)->
  checkElement('table.fatture th', 16)->
  checkElement('table.fatture th', 'n.', array('position' => 0))->
  checkElement('table.fatture th', 'ragione sociale', array('position' => 1))->
  checkElement('table.fatture th', 'data', array('position' => 2))->
  checkElement('table.fatture th', 'imponibile', array('position' => 3))->
  checkElement('table.fatture th', 'totale', array('position' => 4))->
  checkElement('table.fatture th', 'stato', array('position' => 5))->
  checkElement('table.fatture th', 'ritardo', array('position' => 6))->
  checkElement('table.fatture th', 'pdf', array('position' => 7))->

  checkElement('.invoice-pro-forma', '/Pro-Forma/', array('position' => 0))->
  checkElement('.invoice-pro-forma', 5)->
        
  checkElement('.invoice-1 td', '01 Azienda', array('position' => 1))->
  checkElement('.invoice-1 td', '/1.000,00/', array('position' => 3))->

  checkElement('.invoice-9', 2)->
  checkElement('.invoice-9 td', '01/01/'.date('Y', strtotime('-10 year')), array('position' => 2))->
  checkElement('.invoice-5', 2)->
  checkElement('.invoice-5 td', '01/01/'.date('Y', strtotime('-6 year')), array('position' => 2))->
  
  checkElement('.invoice-7', 2)->
  checkElement('.invoice-7 td', date('d/m/Y', strtotime('+7 days',  strtotime('first day of this month'))), array('position' => 10))->
        
  checkElement('.invoice-pro-forma td', '/1.000,00/', array('position' => 11))->
  checkElement('.invoice-pro-forma td', '/1.440,00/', array('position' => 12))->
  checkElement('.invoice-pro-forma td', 'non inviata', array('position' => 13))->
  checkElement('.invoice-pro-forma td', 'no', array('position' => 14))->

// Sorting test
  checkElement('table.fatture td', '/Pro-Forma/', array('position' => 0))->
  checkElement('table.fatture td', '/Pro-Forma/', array('position' => 8))->
  checkElement('table.fatture td', '/Pro-Forma/', array('position' => 16))->
  checkElement('table.fatture td', '/Pro-Forma/', array('position' => 24))->
  checkElement('table.fatture td', '1', array('position' => 32))->
  checkElement('table.fatture td', '2', array('position' => 40))->

  checkElement('body', '!/Ritenuta d\'acconto versata/')
;
