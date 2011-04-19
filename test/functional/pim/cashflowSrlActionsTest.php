<?php
include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  login('user', 'user')->
  click('cash flow');

$cf = new CashFlow();
$cf->getCriteria()->addDateTimeRange(new DateTime(), new DateTime(date('Y-m-t')));
$cf->init();

$browser->
  with('response')->begin()->
    checkElement('table.monitor td', format_currency($cf->getIncoming(), 'EUR'), array('position' => 0))->
    checkElement('table.monitor td', format_currency($cf->getOutcoming(), 'EUR'), array('position' => 1))->
    checkElement('table.monitor td', format_currency($cf->getBalance(), 'EUR'), array('position' => 2))->
  end();

$cash_flow_filters = array('document_date' => array(
    'from' => '1/1/'.date('Y', strtotime('-2 year')),
    'tom'  => '31/1/'.date('Y', strtotime('-2 year')),
));

$browser->
  info('Filtro data cashflow dal 01/01/'.date('Y', strtotime('-2 year')).' al 31/12/'.date('Y', strtotime('-2 year')))->
  setField('cash_flow_filters[document_date][from]', date('1/1/Y', strtotime('-2 year')))->
  setField('cash_flow_filters[document_date][to]', date('31/12/Y', strtotime('-2 year')))->
  click('Filtra')->

  with('response')->begin()->
    checkElement('table.monitor td', format_currency('2400', 'EUR'), array('position' => 0))->
    checkElement('table.monitor td', format_currency('132024.71', 'EUR'), array('position' => 1))->
    checkElement('table.monitor td', format_currency('-129624.71', 'EUR'), array('position' => 2))->
  end();

$browser->
  info('Filtro data cashflow dal 01/01/'.date('Y', strtotime('-1 year')).' al 31/12/'.date('Y', strtotime('-1 year')))->
  setField('cash_flow_filters[document_date][from]', date('1/1/Y', strtotime('-1 year')))->
  setField('cash_flow_filters[document_date][to]', date('31/12/Y', strtotime('-1 year')))->

  click('Filtra')->

  with('response')->begin()->
    checkElement('table.monitor td', format_currency('3600', 'EUR'), array('position' => 0))->
    checkElement('table.monitor td', format_currency('118822.24', 'EUR'), array('position' => 1))->
    checkElement('table.monitor td', format_currency('-115222.24', 'EUR'), array('position' => 2))->
  end();

$browser->
  info('Filtro data cashflow anno corrente mese di gennaio')->
  setField('cash_flow_filters[document_date][from]', date('1/1/Y'))->
  setField('cash_flow_filters[document_date][to]', date('31/1/Y'))->
  click('Filtra')->

  with('response')->begin()->
    checkElement('#col-left p', 'Nessuna entrata nel cash flow.')->
    checkElement('#col-right div.title', '/filtro/')->
  end();

$browser->
  info('Filtro data cashflow anno corrente mese di marzo')->
  setField('cash_flow_filters[document_date][from]', date('1/m/Y', strtotime('-1 month')))->
  setField('cash_flow_filters[document_date][to]', date('t/m/Y', strtotime('-1 month')))->

  click('Filtra')->

  with('response')->begin()->
    checkElement('table.monitor td', format_currency('1200', 'EUR'), array('position' => 0))->
    checkElement('table.monitor td', format_currency('39607.41', 'EUR'), array('position' => 1))->
    checkElement('table.monitor td', format_currency('-38407.41', 'EUR'), array('position' => 2))->
  end();

$browser->
  info('Filtro data cashflow anno corrente mese di aprile')->
  setField('cash_flow_filters[document_date][from]', date('1/m/Y', strtotime('today')))->
  setField('cash_flow_filters[document_date][to]', date('t/m/Y', strtotime('today')))->
  click('Filtra');

$cf->reset();
$cf->getCriteria()->addDateTimeRange(new DateTime(), new DateTime(date('Y-m-t')));
$cf->init();

$browser->
  with('response')->begin()->
    checkElement('table.monitor td', format_currency($cf->getIncoming(), 'EUR'), array('position' => 0))->
    checkElement('table.monitor td', format_currency($cf->getOutcoming(), 'EUR'), array('position' => 1))->
    checkElement('table.monitor td', format_currency($cf->getBalance(), 'EUR'), array('position' => 2))->
  end();