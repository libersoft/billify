<?php
include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData(sfConfig::get('sf_test_dir').'/fixtures/cashflow.yml');

$browser->
  get('/')->
  setField('login', 'user')->
  setField('password', 'user')->
  click('Entra')->
  followRedirect()->
  click('cash flow')->
  setField('cash_flow_filters[document_date][from]', '')->
  setField('cash_flow_filters[document_date][to]', '')->
  click('Filtra')->

  checkResponseElement('h2', '/Cash Flow/')->
  checkResponseElement('table', 2)->
  checkResponseElement('table th', 9)->
  checkResponseElement('table th', 'Data', array('position' => 0))->
  checkResponseElement('table th', 'Contatto', array('position' => 1))->
  checkResponseElement('table th', 'Descrizione', array('position' => 2))->
  checkResponseElement('table th', 'Entrate', array('position' => 3))->
  checkResponseElement('table th', 'Uscite', array('position' => 4))->
  checkResponseElement('table th', 'Pagata', array('position' => 5))->
  checkResponseElement('table tr', 6)->
        
  checkResponseElement('table td', date('Y-m-d', strtotime('+8 days')), array('position' => 0))->
  checkResponseElement('table td', 'Cliente', array('position' => 1))->
  checkResponseElement('table td a', 'Cliente', array('position' => 0))->
  checkResponseElement('table td', 'Fattura n. 1 del '.date('d/m/Y', strtotime('-2 days')), array('position' => 2))->
  checkResponseElement('table td a', 'Fattura n. 1 del '.date('d/m/Y', strtotime('-2 days')), array('position' => 1))->
  checkResponseElement('table td', format_currency('1200', 'EUR'), array('position' => 3))->
  checkResponseElement('table td', '', array('position' => 4))->
  checkResponseElement('table td', 'No', array('position' => 5))->
  checkResponseElement('table td[style="background-color: yellow; font-weight: bold;"]', 'No')->

  checkResponseElement('table td', date('Y-m-d', strtotime('+29 days')), array('position' => 6))->
  checkResponseElement('table td', 'Fornitore', array('position' => 7))->
  checkResponseElement('table td a', 'Fornitore', array('position' => 2))->
  checkResponseElement('table td', 'Fattura n. 10/1 del '.date('d/m/Y', strtotime('-1 days')), array('position' => 8))->
  checkResponseElement('table td a', 'Fattura n. 10/1 del '.date('d/m/Y', strtotime('-1 days')), array('position' => 3))->
  checkResponseElement('table td', '', array('position' => 9))->
  checkResponseElement('table td', format_currency('750', 'EUR'), array('position' => 10))->
  checkResponseElement('table td', 'Si', array('position' => 11))->
  checkResponseElement('table td[style="background-color: green; font-weight: bold;"]', 'Si')->

  checkResponseElement('table.banca', 1)->
  checkResponseElement('table.banca th', 3)->
  checkResponseElement('table.banca th', 'Totale Entrate:', array('position' => 0))->
  checkResponseElement('table.banca th', 'Totale Uscite:', array('position' => 1))->
  checkResponseElement('table.banca th', 'Totale:', array('position' => 2))->
  checkResponseElement('table.banca td', format_currency('1200', 'EUR'), array('position' => 0))->
  checkResponseElement('table.banca td', format_currency('750', 'EUR'), array('position' => 1))->
  checkResponseElement('table.banca td', format_currency('450', 'EUR'), array('position' => 2));

$browser->
  info('Filtro data cashflow')->
  with('response')->begin()->
    checkElement('label[for="cash_flow_filters_document_date"]', 'Data documento')->
    checkElement('input[name="cash_flow_filters[document_date][from]"]')->
    checkElement('input[name="cash_flow_filters[document_date][to]"]')->
  end()->
  setField('cash_flow_filters[document_date][from]', date('d/m/Y', strtotime('+29 days')))->
  setField('cash_flow_filters[document_date][to]', date('d/m/Y', strtotime('+29 days')))->

  click('Filtra')->
  with('request')->begin()->
    isParameter('cash_flow_filters[document_date][to]', date('d/m/Y', strtotime('+29 days')))->
  end()->
  with('response')->begin()->
    checkElement('table tr', 5)->
    checkElement('table td', date('Y-m-d', strtotime('+29 days')), array('position' => 0))->
  end()
;

$browser->click('esci');
$browser->
  login('freelance', 'freelance')->
  click('cash flow')->
  with('response')->begin()->
    checkElement('#col-left p', '/Nessuna entrata nel cash flow./')->
  end()->
  click('esci');
