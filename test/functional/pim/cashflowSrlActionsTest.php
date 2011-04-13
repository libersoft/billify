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
  info('Filtro data cashflow')->
  
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
;