<?php
include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$data = new sfPropelData();
$data->loadData(sfConfig::get('sf_test_dir').'/fixtures/cashflow.yml');

$browser = new sfTestBrowser();
$browser->initialize();

$browser->
  get('/')->
  setField('login', 'user')->
  setField('password', 'user')->
  click('Entra')->
  followRedirect()->
  click('cash flow')->
  checkResponseElement('h2', 'Cash Flow')->
  checkResponseElement('table.fatture', 1)->
  checkResponseElement('table.fatture th', 6)->
  checkResponseElement('table.fatture th', 'Data', array('position' => 0))->
  checkResponseElement('table.fatture th', 'Contatto', array('position' => 1))->
  checkResponseElement('table.fatture th', 'Descrizione', array('position' => 2))->
  checkResponseElement('table.fatture th', 'Entrate', array('position' => 3))->
  checkResponseElement('table.fatture th', 'Uscite', array('position' => 4))->
  checkResponseElement('table.fatture th', 'Pagata', array('position' => 5))->
  checkResponseElement('table.fatture tr', 3)->

  checkResponseElement('table.fatture td', date('Y-m-d', strtotime('+8 days')), array('position' => 0))->
  checkResponseElement('table.fatture td', 'Cliente', array('position' => 1))->
  checkResponseElement('table.fatture td a', 'Cliente', array('position' => 0))->
  checkResponseElement('table.fatture td', 'Fattura n. 1 del '.date('d/m/Y', strtotime('-2 days')), array('position' => 2))->
  checkResponseElement('table.fatture td a', 'Fattura n. 1 del '.date('d/m/Y', strtotime('-2 days')), array('position' => 1))->
  checkResponseElement('table.fatture td', '€ 1.200,00', array('position' => 3))->
  checkResponseElement('table.fatture td', '', array('position' => 4))->
  checkResponseElement('table.fatture td', 'No', array('position' => 5))->
  checkResponseElement('table.fatture td[style="background-color: yellow; font-weight: bold;"]', 'No')->

  checkResponseElement('table.fatture td', date('Y-m-d', strtotime('+29 days')), array('position' => 6))->
  checkResponseElement('table.fatture td', 'Fornitore', array('position' => 7))->
  checkResponseElement('table.fatture td a', 'Fornitore', array('position' => 2))->
  checkResponseElement('table.fatture td', 'Fattura n. 10/1 del '.date('d/m/Y', strtotime('-1 days')), array('position' => 8))->
  checkResponseElement('table.fatture td a', 'Fattura n. 10/1 del '.date('d/m/Y', strtotime('-1 days')), array('position' => 3))->
  checkResponseElement('table.fatture td', '', array('position' => 9))->
  checkResponseElement('table.fatture td', '€ 750,00', array('position' => 10))->
  checkResponseElement('table.fatture td', 'Si', array('position' => 11))->
  checkResponseElement('table.fatture td[style="background-color: green; font-weight: bold;"]', 'Si')->

  checkResponseElement('table.banca', 1)->
  checkResponseElement('table.banca th', 3)->
  checkResponseElement('table.banca th', 'Totale Entrate:', array('position' => 0))->
  checkResponseElement('table.banca th', 'Totale Uscite:', array('position' => 1))->
  checkResponseElement('table.banca th', 'Totale:', array('position' => 2))->
  checkResponseElement('table.banca td', '€ 1.200,00', array('position' => 0))->
  checkResponseElement('table.banca td', '€ 750,00', array('position' => 1))->
  checkResponseElement('table.banca td', '€ 450,00', array('position' => 2));

$browser->
  info('Filtro data cashflow')->
  with('response')->begin()->
    checkElement('label[for="cash_flow_filters_document_date"]', 'Data documento')->
    checkElement('select[name="cash_flow_filters[document_date][from][month]"]')->
    checkElement('select[name="cash_flow_filters[document_date][from][day]"]')->
    checkElement('select[name="cash_flow_filters[document_date][from][year]"]')->

    checkElement('select[name="cash_flow_filters[document_date][to][year]"]')->
    checkElement('select[name="cash_flow_filters[document_date][to][day]"]')->
    checkElement('select[name="cash_flow_filters[document_date][to][month]"]')->

  end()->
  setField('cash_flow_filters[document_date][from][month]', date('m', strtotime('+29 days')))->
  setField('cash_flow_filters[document_date][from][day]', date('d', strtotime('+29 days')))->
  setField('cash_flow_filters[document_date][from][year]', date('Y', strtotime('+29 days')))->

  setField('cash_flow_filters[document_date][to][month]', date('m', strtotime('+29 days')))->
  setField('cash_flow_filters[document_date][to][day]', date('d', strtotime('+29 days')))->
  setField('cash_flow_filters[document_date][to][year]', date('Y', strtotime('+29 days')))->

  click('Filtra')->
  with('request')->begin()->
    isParameter('cash_flow_filters[document_date][to][month]', date('m', strtotime('+29 days')))->
    isParameter('cash_flow_filters[document_date][to][day]', date('d', strtotime('+29 days')))->
    isParameter('cash_flow_filters[document_date][to][year]', date('Y', strtotime('+29 days')))->
  end()->
  with('response')->begin()->
    checkElement('table.fatture tr', 2)->
    checkElement('table.fatture td', date('Y-m-d', strtotime('+29 days')), array('position' => 0))->
  end()
;

?>