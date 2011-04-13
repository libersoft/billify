<?php
include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  login('user', 'user')->
  click('cash flow')->

  with('response')->begin()->
    checkElement('table.banca td', format_currency('93600', 'EUR'), array('position' => 0))->
    checkElement('table.banca td', format_currency('298455.08', 'EUR'), array('position' => 1))->
    checkElement('table.banca td', format_currency('-204855.08', 'EUR'), array('position' => 2))->
  end();

$cash_flow_filters = array('document_date' => array(
    'from' => array('day' => 1, 'month' => 1, 'year' =>  date('Y', strtotime('-2 year'))),
    'tom'  => array('day' => 31, 'month' => 1, 'year' =>  date('Y', strtotime('-2 year'))),
));

$browser->
  info('Filtro data cashflow dal 01/01/'.date('Y', strtotime('-2 year')).' al 31/12/'.date('Y', strtotime('-2 year')))->
  
  setField('cash_flow_filters[document_date][from][day]', '1')->
  setField('cash_flow_filters[document_date][from][month]', '1')->
  setField('cash_flow_filters[document_date][from][year]', date('Y', strtotime('-2 year')))->

  setField('cash_flow_filters[document_date][to][day]', '31')->
  setField('cash_flow_filters[document_date][to][month]', '12')->
  setField('cash_flow_filters[document_date][to][year]', date('Y', strtotime('-2 year')))->

  click('Filtra')->

  with('response')->begin()->
    checkElement('table.banca td', format_currency('2400', 'EUR'), array('position' => 0))->
    checkElement('table.banca td', format_currency('132024.20', 'EUR'), array('position' => 1))->
    checkElement('table.banca td', format_currency('-129624.20', 'EUR'), array('position' => 2))->
  end();

$browser->
  info('Filtro data cashflow dal 01/01/'.date('Y', strtotime('-1 year')).' al 31/12/'.date('Y', strtotime('-1 year')))->
  
  setField('cash_flow_filters[document_date][from][day]', '1')->
  setField('cash_flow_filters[document_date][from][month]', '1')->
  setField('cash_flow_filters[document_date][from][year]', date('Y', strtotime('-1 year')))->

  setField('cash_flow_filters[document_date][to][day]', '31')->
  setField('cash_flow_filters[document_date][to][month]', '12')->
  setField('cash_flow_filters[document_date][to][year]', date('Y', strtotime('-1 year')))->

  click('Filtra')->

  with('response')->begin()->
    checkElement('table.banca td', format_currency('3600', 'EUR'), array('position' => 0))->
    checkElement('table.banca td', format_currency('118821.78', 'EUR'), array('position' => 1))->
    checkElement('table.banca td', format_currency('-115221.78', 'EUR'), array('position' => 2))->
  end();

$browser->
  info('Filtro data cashflow anno corrente mese di gennaio')->
  
  setField('cash_flow_filters[document_date][from][day]', '1')->
  setField('cash_flow_filters[document_date][from][month]', '1')->
  setField('cash_flow_filters[document_date][from][year]', date('Y'))->

  setField('cash_flow_filters[document_date][to][day]', '31')->
  setField('cash_flow_filters[document_date][to][month]', '1')->
  setField('cash_flow_filters[document_date][to][year]', date('Y'))->

  click('Filtra')->

  with('response')->begin()->
    checkElement('#col-left p', 'Nessuna entrata nel cash flow.')->
    checkElement('#col-right div.title', '/cash flow/')->
  end();

$browser->
  info('Filtro data cashflow anno corrente mese di marzo')->
  
  setField('cash_flow_filters[document_date][from][day]', '1')->
  setField('cash_flow_filters[document_date][from][month]', date('m', strtotime('-1 month')))->
  setField('cash_flow_filters[document_date][from][year]', date('Y'))->

  setField('cash_flow_filters[document_date][to][day]', date('t', strtotime('today')))->
  setField('cash_flow_filters[document_date][to][month]', date('m', strtotime('-1 month')))->
  setField('cash_flow_filters[document_date][to][year]', date('Y'))->

  click('Filtra')->

  with('response')->begin()->
    checkElement('table.banca td', format_currency('1200', 'EUR'), array('position' => 0))->
    checkElement('table.banca td', format_currency('39607.26', 'EUR'), array('position' => 1))->
    checkElement('table.banca td', format_currency('-38407.26', 'EUR'), array('position' => 2))->
  end();

$browser->
  info('Filtro data cashflow anno corrente mese di aprile')->
  
  setField('cash_flow_filters[document_date][from][day]', '1')->
  setField('cash_flow_filters[document_date][from][month]', date('m', strtotime('today')))->
  setField('cash_flow_filters[document_date][from][year]', date('Y'))->

  setField('cash_flow_filters[document_date][to][day]', date('t', strtotime('today')))->
  setField('cash_flow_filters[document_date][to][month]', date('m', strtotime('today')))->
  setField('cash_flow_filters[document_date][to][year]', date('Y'))->

  click('Filtra')->

  with('response')->begin()->
    checkElement('table.banca td', format_currency('24000', 'EUR'), array('position' => 0))->
    checkElement('table.banca td', format_currency('8001.84', 'EUR'), array('position' => 1))->
    checkElement('table.banca td', format_currency('15998.16', 'EUR'), array('position' => 2))->
  end();