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
  with('response')->
  begin()->
  checkElement('table', 1)->
  checkElement('table tr th', 9)->
  checkElement('table tr th', 'n.', array('position' => 1))->
  checkElement('table tr th', 'ragione sociale', array('position' => 2))->
  checkElement('table tr th', 'data', array('position' => 3))->
  checkElement('table tr th', 'imponibile', array('position' => 4))->
  checkElement('table tr th', 'totale', array('position' => 5))->
  checkElement('table tr th', 'stato', array('position' => 6))->
  checkElement('table tr th', 'ritardo', array('position' => 7))->
  checkElement('table tr', UtentePeer::getImpostazione()->getNumFatture() + 1)->
  checkElement('div[class="pagination"]', '/2/')->
  checkElement('table tr td', date('d/m/Y', strtotime('-2 years')), array('position' => 3))->
  checkElement('table tr td', '/11.200,34/', array('position' => 4))->
  checkElement('div[class="pagination"]', 2)->
  checkElement('table tr', UtentePeer::getImpostazione()->getNumFatture() + 1)->
  click('2')->
  with('response')->
  begin()->
  checkElement('table tr td', '10/8', array('position' => 1))->
  click('aggiungi una nuova fattura d\'acquisto')->
  with('response')->
  begin()->
  checkElement('h2', '/nuova fattura d\'acquisto/')->
  checkElement('label[for="fattura_num_fattura"]', 'N.')->
  checkElement('input[type="text"][id="fattura_num_fattura"]')->
  checkElement('label[for="fattura_cliente_id"]', 'Fornitore')->
  checkElement('select[id="fattura_cliente_id"]')->
  checkElement('label[for="fattura_data"]', 'Data')->
  checkElement('input[id="fattura_data"]')->
  checkElement('label[for="fattura_imponibile"]', 'Imponibile')->
  checkElement('input[type="text"][id="fattura_imponibile"]')->
  checkElement('label[for="fattura_imposte"]', 'Imposte')->
  checkElement('input[type="text"][id="fattura_imposte"]')->
  checkElement('label[for="fattura_modo_pagamento_id"]', 'Modo pagamento')->
  checkElement('select[id="fattura_modo_pagamento_id"]')->
  checkElement('label[for="fattura_stato"]', 'Stato')->
  checkElement('select[id="fattura_stato"]')->
  checkElement('input[type="submit"][value="Salva"]');

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
  setField('fattura_filters[data][from]', date('d/m/Y', strtotime('first day of last month')))->
  setField('fattura_filters[data][to]', date('t/m/Y', strtotime('first day of last month')))->
  click('Filtra')->
  with('response')->begin()->
    checkElement('td', '!/pagata/')->
    checkElement('.fatture tbody tr ', 3)->
  end();

$criteria = new Criteria();
$criteria->add(CategoriaPeer::NOME, 'Test Categoria 1', Criteria::EQUAL);

$categoria = CategoriaPeer::doSelectOne($criteria);

$browser->info('Filtro le fatture di acquisto per categoria')->
  get('/invoices/purchase')->
  setField('fattura_filters[categoria_id]', $categoria->getId())->
  click('Filtra')->
  checkElement('table.fatture tbody tr', 2);

$criteria = new Criteria();
$criteria->add(ContattoPeer::RAGIONE_SOCIALE, '01 Fornitore');
$fornitore = ContattoPeer::doSelectOne($criteria);

$browser->
  info('registro una nuova fattura di acquisto per il fornitore')->
  get('/fornitori')->
  click('01 Fornitore')->
  click('nuova fattura')->
  with('request')->begin()->
        isParameter('module', 'invoice')->
        isParameter('action', 'create')->
        isParameter('type', '2')->
        isParameter('fornitore', $fornitore->getId())->
  end()->
  with('response')->begin()->
        checkElement('select[id="fattura_cliente_id"] option[selected]', '/01 Fornitore/')->
        setField('fattura[num_fattura]', 'birubiru')->
        setField('fattura[data]', date('d/m/Y'))->
  end()->
  click('Salva')->
  followRedirect()->
  with('request')->begin()->
        isParameter('module', 'contact')->
        isParameter('action', 'show')->
        isParameter('id', $fornitore->getId())->  
  end()
;
/*
$browser->
  info('provo a registrare una fattura di acquisto con numero già registrato per il fornitore')->
  get('/fornitori')->
  click('01 Fornitore')->
  click('nuova fattura')->
  with('request')->begin()->
        isParameter('module', 'invoice')->
        isParameter('action', 'create')->
        isParameter('type', '2')->
        isParameter('fornitore', $fornitore->getId())->
  end()->
  with('response')->begin()->
        checkElement('select[id="fattura_cliente_id"] option[selected]', '/01 Fornitore/')->
        setField('fattura[num_fattura]', 'birubiru')->
        setField('fattura[data]', date('d/m/Y'))->
  end()->
  click('Salva')->
  with('request')->begin()->
        isParameter('module', 'invoice')->
        isParameter('action', 'edit')->
        isParameter('type', '2')->
        isParameter('fornitore', $fornitore->getId())->
  end()->
  with('response')->begin()->
        checkElement('.notice', 'Il numero fattura è già stato registrato')->
  end();      
*/        
        
        
$browser->info('Link alle informazioni sul fornitore')->
   get('/invoices/purchase')->
   click('03 Fornitore')->
   with('request')->begin()->
        isParameter('module', 'contact')->
        isParameter('action', 'show')->
   end()
;  

$criteria = new Criteria;
$criteria->add(FatturaPeer::NUM_FATTURA, 'birubiru');
$purchase = FatturaPeer::doSelectOne($criteria);

$browser->info('cancello una fattura di un fornitore')->
         get('/invoices/purchase')->
  with('response')->begin()->
    checkElement('a[title="delete"]', 11)->    
    checkElement('a[title="delete"][href="/index.php/invoice/delete/id/'.$purchase->getId().'"]', 1)->
  end()->        
  get('/invoice/delete/id/'.$purchase->getId())->
  followRedirect()->
  with('request')->begin()->
      isParameter('module', 'invoice')->
      isParameter('action', 'indexPurchase')->
  end()->
  with('response')->begin()->
    checkElement('a[title="delete"][href="/index.php/invoice/delete/id/'.$purchase->getId().'"]', 0)->
  end();
