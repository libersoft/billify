<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  get('/')->
  login()->
  click("lista fatture d'acquisto")->
  click("10/7")->

  with('response')->begin()->
    checkElement('input[name="fattura[data_stato]"][value="'.date('d/m/Y', strtotime('-1 month + 10 days')).'"]')->
  end()->

  setField('fattura[stato]', 'p')->
  setField('fattura[data_stato][month]', '')->
  setField('fattura[data_stato][year]', '')->
  setField('fattura[data_stato][day]', '')->
  click('Salva')->

  with('form')->begin()->
    hasErrors(true)->
  end()->

  with('response')->begin()->
    checkElement('ul.error_list li', '/You have to specify a data when marking an invoice as paid/')->
  end();

