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
  click('lista fatture d\'acquisto')->
  setField('fattura_filters[data][from]', '')->
  setField('fattura_filters[data][to]', '')->
  click('Filtra')->
  checkResponseElement('table', 1)->
  checkResponseElement('table tr th', 10)->
  checkResponseElement('table tr th', 'n.', array('position' => 1))->
  checkResponseElement('table tr th', 'ragione sociale', array('position' => 2))->
  checkResponseElement('table tr th', 'data', array('position' => 3))->
  checkResponseElement('table tr th', 'imponibile', array('position' => 4))->
  checkResponseElement('table tr th', 'totale', array('position' => 5))->
  checkResponseElement('table tr th', 'stato', array('position' => 6))->
  checkResponseElement('table tr th', 'ritardo', array('position' => 7))->
  checkResponseElement('table tr', UtentePeer::getImpostazione()->getNumFatture() + 1)->
  checkResponseElement('div[class="navigator"]', '/Pagina 1 di 2/')->
  checkResponseElement('table tr td', date('d/m/Y', strtotime('-2 years')), array('position' => 3))->
  checkResponseElement('table tr td', '/11.200,30/', array('position' => 4))->
  checkResponseElement('div[class="navigator"]', 2)->
  checkResponseElement('table tr', UtentePeer::getImpostazione()->getNumFatture() + 1)->
  click('2')->
  checkResponseElement('table tr td', '10/8', array('position' => 1))->
  click('aggiungi una nuova fattura d\'acquisto')->
  checkResponseElement('h2', '/nuova fattura d\'acquisto/')->
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
  checkResponseElement('input[type="submit"][value="Salva"]')->
  checkResponseElement('td select[name*="fattura[data]"]', '/28/')->
  checkResponseElement('td select[name*="fattura[data]"]', '!/28/', array('position' => 1))->
  checkResponseElement('td select[name*="fattura[data]"]', '/'.date('Y').'/', array('position' => 2));

$browser->
  with('response')->begin()->
    checkElement('select[id="fattura_vat"]')->
    checkElement('select[id="fattura_vat"] option[value="20"]')->
    checkElement('select[id="fattura_vat"] option', 1)->
    checkElement('select[id="fattura_categoria_id"]')->
    checkElement('select[id="fattura_categoria_id"] option', 4)->
    checkElement('select[id="fattura_categoria_id"] option', '', array('position' => 0))->
    checkElement('select[id="fattura_categoria_id"] option', 'Test Categoria 1', array('position' => 1))->
    checkElement('select[id="fattura_categoria_id"] option', 'Test Categoria 2', array('position' => 2))->
    checkElement('select[id="fattura_categoria_id"] option', 'Test Categoria 3', array('position' => 3))->
  end();

$criteria = new Criteria();
$criteria->add(ContattoPeer::CLASS_KEY, ContattoPeer::CLASSKEY_FORNITORE);
$provider = ContattoPeer::doSelectOne($criteria);

$browser->
  setField('fattura[num_fattura]', 'AAABBB11')->
  setField('fattura[data][day]', '01')->
  setField('fattura[data][month]', '01')->
  setField('fattura[data][year]', '2011')->
  setField('fattura[cliente_id]', $provider->getId())->
  click('Salva')->
  with('form')->begin()->
    hasErrors(false)->
  end()->
  followRedirect()->
  with('response')->begin()->
    checkElement('span.notice', '/fattura salvata con successo/')->
  end();

$browser->
  post('/invoices/purchase/create', array('fattura' => array()))->
  with('response')->begin()->
    checkElement('ul.error_list', 4)->
  end();

$browser->
  get('/invoices/purchase')->
  with('response')->begin()->
    checkElement('#fattura_filters_data_from')->
    checkElement('#fattura_filters_data_to')->
    checkElement('#fattura_filters_stato')->
  end()->
  setField('fattura_filters[stato]', Acquisto::NON_PAGATA)->
  click('Filtra')->
  with('response')->begin()->
    checkElement('td', '!/pagata/')->
    checkElement('.fatture tbody tr ', 10)->
  end()->
  setField('fattura_filters[data][from]', date('d/m/Y', strtotime('-1 month')))->
  setField('fattura_filters[data][to]', date('t/m/Y', strtotime('-1 month')))->
  click('Filtra')->
  with('response')->begin()->
    checkElement('td', '!/pagata/')->
    checkElement('.fatture tbody tr ', 3)->
  end();
