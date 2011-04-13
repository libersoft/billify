<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  login()->
  info('Dashboard')->
  with('response')->begin()->
    checkElement('#col-right h4:contains("fatturato ultimo anno")')->
    checkElement('#col-right h4:contains("fatturato ultimo mese")')->
    checkElement('#col-right h4:contains("iva ultimo anno")')->
    checkElement('#col-right h4:contains("iva ultimo mese")')->
    checkElement('#col-right ul li', '/1.000,00/')->
    checkElement('#col-right ul li', '/12.000,00/')->
    checkElement('#col-right ul li', '/0,00/', array('position' => 1))->
    checkElement('#col-right ul li', '/40.402,26/', array('position' => 1))->
    checkElement('#col-right ul li', '/1.000,00/', array('position' => 2))->
    checkElement('#col-right ul li', '/28.402,26/', array('position' => 2))->
    checkElement('#col-right ul li', '/200,00/', array('position' => 3))->
    checkElement('#col-right ul li', '/2.840,00/', array('position' => 3))->
    checkElement('#col-right ul li', '/0,00/', array('position' => 4))->
    checkElement('#col-right ul li', '/7.206,84/', array('position' => 4))->
    checkElement('#col-right ul li', '/200,00/', array('position' => 5))->
    checkElement('#col-right ul li', '/4.366,84/', array('position' => 5))->
    checkElement('#col-right ul li', '/1.000,00/', array('position' => 6))->
    checkElement('#col-right ul li', '/33.600,90/', array('position' => 7))->
    checkElement('#col-right ul li', '/32.600,90/', array('position' => 8))->
    checkElement('#col-right ul li', '/200,00/', array('position' => 9))->
    checkElement('#col-right ul li', '/6.006,36/', array('position' => 10))->
    checkElement('#col-right ul li', '/5.806,36/', array('position' => 11))->
  end()->

  
  click('lista fatture di vendita')->
  with('response')->begin()->
    checkElement('ul.ul-list li', 'entrate: € 1.000,00 (€ 12.000,00)', array('position' => 0))->
    checkElement('ul.ul-list li', 'uscite: € 0,00 (€ 40.402,26)', array('position' => 1))->
    checkElement('ul.ul-list li', 'utile € 1.000,00 (-€ 28.402,26)', array('position' => 2))->
  end()->

  setField('fattura_filters[data][from]', date('d/m/Y', strtotime('-2 months')))->
  setField('fattura_filters[data][to]', date('t/m/Y', strtotime('-2 months')))->
  click('Filtra')->
  with('response')->begin()->
    checkElement('ul.ul-list li', 'entrate: € 0,00 (€ 0,00)', array('position' => 0))->
    checkElement('ul.ul-list li', 'uscite: € 0,00 (€ 0,00)', array('position' => 1))->
  end()->

  setField('fattura_filters[data][from]', date('d/m/Y', strtotime('-1 month')))->
  setField('fattura_filters[data][to]', date('t/m/Y', strtotime('-1 month')))->
  click('Filtra')->
  with('response')->begin()->
    checkElement('ul.ul-list li', 'entrate: € 1.000,00 (€ 1.000,00)', array('position' => 0))->
    checkElement('ul.ul-list li', 'uscite: € 0,00 (€ 33.600,90)', array('position' => 1))->
  end()->

  setField('fattura_filters[data][from]', date('d/m/Y', strtotime('today')))->
  setField('fattura_filters[data][to]', date('t/m/Y', strtotime('today')))->
  click('Filtra')->
  with('response')->begin()->
    checkElement('ul.ul-list li', 'entrate: € 0,00 (€ 11.000,00)', array('position' => 0))->
    checkElement('ul.ul-list li', 'uscite: € 0,00 (€ 6.801,36)', array('position' => 1))->
  end()->

  setField('fattura_filters[data][from]', '01/01/'.date('Y', strtotime('-1 year')))->
  setField('fattura_filters[data][to]', '31/12/'.date('Y', strtotime('-1 year')))->
  click('Filtra')->
  with('response')->begin()->
    checkElement('ul.ul-list li', 'entrate: € 3.000,00 (€ 3.000,00)', array('position' => 0))->
    checkElement('ul.ul-list li', 'uscite: € 100.802,70 (€ 100.802,70)', array('position' => 1))->
    checkElement('ul.ul-list li', 'utile -€ 97.802,70 (-€ 97.802,70)', array('position' => 2))->
  end()->

  setField('fattura_filters[data][from]', '01/01/'.date('Y', strtotime('-2 year')))->
  setField('fattura_filters[data][to]', '31/12/'.date('Y', strtotime('-2 year')))->
  click('Filtra')->
  with('response')->begin()->
    checkElement('ul.ul-list li', 'entrate: € 0,00 (€ 2.000,00)', array('position' => 0))->
    checkElement('ul.ul-list li', 'uscite: € 112.003,00 (€ 112.003,00)', array('position' => 1))->
    checkElement('ul.ul-list li', 'utile -€ 112.003,00 (-€ 110.003,00)', array('position' => 2))->
  end()->

  setField('fattura_filters[data][from]', '01/01/'.date('Y', strtotime('-3 year')))->
  setField('fattura_filters[data][to]', '31/12/'.date('Y', strtotime('-3 year')))->
  click('Filtra')->
  with('response')->begin()->
    checkElement('ul.ul-list li', 'entrate: € 0,00 (€ 3.000,00)', array('position' => 0))->
    checkElement('ul.ul-list li', 'uscite: € 0,00 (€ 0,00)', array('position' => 1))->
    checkElement('ul.ul-list li', 'utile € 0,00 (€ 3.000,00)', array('position' => 2))->
  end()->


  click('lista fatture d\'acquisto')->
  with('response')->begin()->
    checkElement('ul.ul-list li', 'entrate: € 1.000,00 (€ 12.000,00)', array('position' => 0))->
    checkElement('ul.ul-list li', 'uscite: € 0,00 (€ 40.402,26)', array('position' => 1))->
    checkElement('ul.ul-list li', 'utile € 1.000,00 (-€ 28.402,26)', array('position' => 2))->
  end()->
  setField('fattura_filters[data][from]', '01/01/'.date('Y', strtotime('-1 year')))->
  setField('fattura_filters[data][to]', '31/12/'.date('Y', strtotime('-1 year')))->
  click('Filtra')->
  with('response')->begin()->
    checkElement('ul.ul-list li', '/0,00/', array('position' => 0))->
    checkElement('ul.ul-list li', '/100.802,70/', array('position' => 1))->
    checkElement('ul.ul-list li', '/97.802,70/', array('position' => 2))->
  end();

$browser->click('esci');
$browser->
  login('freelance', 'freelance')->
  with('response')->begin()->
    checkElement('#nav', '/benvenuto freelance/')->
    checkElement('#col-right ul li', 'entrate: € 0,00 (€ 0,00)')->
  end();