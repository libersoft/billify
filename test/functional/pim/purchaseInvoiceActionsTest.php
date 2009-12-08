<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$data = new sfPropelData();
$data->loadData(sfConfig::get('sf_test_dir').'/fixtures/fixtures.yml');

$browser = new sfTestBrowser();
$browser->initialize();

$browser->
  get('/')->
  setField('login', 'user')->
  setField('password', 'user')->
  click('Entra')->
  followRedirect()->
  click('lista fatture d\'acquisto')->

  checkResponseElement('table', 1)->
  checkResponseElement('table tr th', 9)->
  checkResponseElement('table tr th', 'n.', array('position' => 1))->
  checkResponseElement('table tr th', 'ragione sociale', array('position' => 2))->
  checkResponseElement('table tr th', 'data', array('position' => 3))->
  checkResponseElement('table tr th', 'totale', array('position' => 4))->
  checkResponseElement('table tr th', 'stato', array('position' => 5))->
  checkResponseElement('table tr th', 'ritardo', array('position' => 6))->

  click('aggiungi una nuova fattura d\'acquisto')->
  checkResponseElement('h2', 'nuova fattura d\'acquisto')->
  checkResponseElement('label[for="fattura_num_fattura"]', 'N.')->
  checkResponseElement('input[type="text"][id="fattura_num_fattura"]')->
  checkResponseElement('label[for="fattura_cliente_id"]', 'Fornitore')->
  checkResponseElement('select[id="fattura_cliente_id"]')->
  checkResponseElement('label[for="fattura_data"]', 'Data')->
  checkResponseElement('select[id="fattura_data_month"]')->
  checkResponseElement('select[id="fattura_data_day"]')->
  checkResponseElement('select[id="fattura_data_year"]')->
  checkResponseElement('label[for="fattura_imponibile"]', 'Imponibile')->
  checkResponseElement('input[type="text"][id="fattura_imponibile"]')->
  checkResponseElement('label[for="fattura_imposte"]', 'Imposte')->
  checkResponseElement('input[type="text"][id="fattura_imposte"]')->
  checkResponseElement('label[for="fattura_modo_pagamento_id"]', 'Modo pagamento')->
  checkResponseElement('select[id="fattura_modo_pagamento_id"]')->
  checkResponseElement('label[for="fattura_stato"]', 'Stato')->
  checkResponseElement('select[id="fattura_stato"]')->
  checkResponseElement('input[type="submit"][value="Salva"]')

;
?>