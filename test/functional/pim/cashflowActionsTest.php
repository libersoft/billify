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
  get('@cashflow')->
  setField('cash_flow_filters[document_date][from]', '')->
  setField('cash_flow_filters[document_date][to]', '')->
  click('Filtra')->
  with('response')->
  begin()->

  checkElement('h2', '/Cash Flow/')->
  checkElement('table', 2)->
  checkElement('table th', 9)->
  checkElement('table th', 'Data', array('position' => 0))->
  checkElement('table th', 'Contatto', array('position' => 1))->
  checkElement('table th', 'Descrizione', array('position' => 2))->
  checkElement('table th', 'Entrate', array('position' => 3))->
  checkElement('table th', 'Uscite', array('position' => 4))->
  checkElement('table th', 'Stato', array('position' => 5))->
  checkElement('table tr', 6)->
        
  checkElement('table td', date('Y-m-d', strtotime('+8 days')), array('position' => 0))->
  checkElement('table td', 'Cliente', array('position' => 1))->
  checkElement('table td a', 'Cliente', array('position' => 0))->
  checkElement('table td', 'Fattura n. 1 del '.date('d/m/Y', strtotime('-2 days')), array('position' => 2))->
  checkElement('table td a', 'Fattura n. 1 del '.date('d/m/Y', strtotime('-2 days')), array('position' => 1))->
  checkElement('table td', format_currency('1200', 'EUR'), array('position' => 3))->
  checkElement('table td', '', array('position' => 4))->
  checkElement('table td span.warning', 'non inviata')->

  checkElement('table td', date('Y-m-d', strtotime('+29 days')), array('position' => 6))->
  checkElement('table td', 'Fornitore', array('position' => 7))->
  checkElement('table td a', 'Fornitore', array('position' => 2))->
  checkElement('table td', 'Fattura n. 10/1 del '.date('d/m/Y', strtotime('-1 days')), array('position' => 8))->
  checkElement('table td a', 'Fattura n. 10/1 del '.date('d/m/Y', strtotime('-1 days')), array('position' => 3))->
  checkElement('table td', '', array('position' => 9))->
  checkElement('table td', format_currency('750', 'EUR'), array('position' => 10))->
  checkElement('table td span.success', 'pagata')->

  checkElement('table.monitor', 1)->
  checkElement('table.monitor th', 3)->
  checkElement('table.monitor th', 'Totale Entrate:', array('position' => 0))->
  checkElement('table.monitor th', 'Totale Uscite:', array('position' => 1))->
  checkElement('table.monitor th', 'Totale:', array('position' => 2))->
  checkElement('table.monitor td', format_currency('1200', 'EUR'), array('position' => 0))->
  checkElement('table.monitor td', format_currency('750', 'EUR'), array('position' => 1))->
  checkElement('table.monitor td', format_currency('450', 'EUR'), array('position' => 2));

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
  get('@cashflow')->
  with('response')->begin()->
    checkElement('#col-left p', '/Nessuna entrata nel cash flow./')->
  end()->
  click('esci');
