<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  login()->
  info('1. sale invoices list')->
  click('lista fatture di vendita')->

  with('response')->begin()->
    checkElement('table', 1)->
    checkElement('table.fatture th', 10)->
    checkElement('table.fatture th', 'n.', array('position' => 1))->
    checkElement('table.fatture th', 'ragione sociale', array('position' => 2))->
    checkElement('table.fatture th', 'data', array('position' => 3))->
    checkElement('table.fatture th', 'imponibile', array('position' => 4))->
    checkElement('table.fatture th', 'totale', array('position' => 5))->
    checkElement('table.fatture th', 'stato', array('position' => 6))->
    checkElement('table.fatture th', 'ritardo', array('position' => 7))->
    checkElement('table.fatture tr', 21)->
    checkElement('table.fatture td:contains("1")')->
    checkElement('table.fatture td:contains("2")')->
  end();

$browser->click('1')->
  with('request')->begin()->
    isParameter('module', 'fattura')->
    isParameter('action', 'show')->
  end()->
  back()->
  click('01 Azienda')->
  with('request')->begin()->
    isParameter('module', 'contact')->
    isParameter('action', 'show')->
  end()->

  info('2. sale invoice create')->
  get('fattura/create')->
  with('request')->begin()->
    isParameter('module', 'fattura')->
    isParameter('action', 'create')->
  end()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('#breadcrumps ul li', 4)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Fatture/', array('position' => 2))->
    checkElement('#breadcrumps ul li', '/Nuova/', array('position' => 3))->
    checkElement('h2', '/Nuova Fattura/')->
    checkElement('table.edit', 1)->
    checkElement('table th', 'Pro forma', array('position' => 0))->
    checkElement('table th', 'Num fattura', array('position' => 1))->
    checkElement('table th', 'Cliente', array('position' => 2))->
    checkElement('table th', 'Data', array('position' => 3))->
    checkElement('table th', 'Modo pagamento', array('position' => 4))->
    checkElement('table th', 'Sconto', array('position' => 5))->
    checkElement('table th', 'Iva', array('position' => 6))->
    checkElement('table th', 'Spese anticipate', array('position' => 7))->
    checkElement('table th', 'Calcola ritenuta', array('position' => 8))->
    checkElement('table th', 'Calcola tasse', array('position' => 9))->
    checkElement('table th', 'Scorpora tasse', array('position' => 10))->
    checkElement('#cliente_id option', 20)->
    checkElement('#modo_pagamento_id option', 2)->
    checkElement('#modo_pagamento_id option', '10 Giorni', array('position' => 0))->
    checkElement('#modo_pagamento_id option', 'Rimessa diretta', array('position' => 1))->
    checkElement('#vat option', 1)->
    checkElement('#vat option', '20%')->
  end()->
  click('Salva e vai ai dettagli')->
  with('request')->begin()->
    isParameter('module', 'fattura')->
    isParameter('action', 'update')->
  end()->
  followRedirect()->
  with('request')->begin()->
    isParameter('module', 'fattura')->
    isParameter('action', 'show')->
  end();

$browser->
  get('/invoices/sale')->
  with('response')->begin()->
    checkElement('#fattura_filters_data_from')->
    checkElement('#fattura_filters_data_to')->
    checkElement('#fattura_filters_stato')->
  end()->
  setField('fattura_filters[stato]', Vendita::PAGATA)->
  click('Filtra')->
  with('response')->begin()->
    checkElement('td', '!/non inviata/')->
    checkElement('td', '!/inviata/')->
    checkElement('td', '!/rifiutata/')->
    checkElement('.fatture tbody tr ', 1)->
  end()->
  setField('fattura_filters[data][from]', '01/01/'.date('Y', strtotime('-1 year')))->
  setField('fattura_filters[data][to]', '31/12/'.date('Y', strtotime('-1 year')))->
  click('Filtra')->
  with('response')->begin()->
    checkElement('td', '!/non inviata/')->
    checkElement('td', '!/inviata/')->
    checkElement('td', '!/rifiutata/')->
    checkElement('.fatture tbody tr ', 3)->
  end()->
  click('Reset')->
  setField('fattura_filters[num_fattura]', '2')->
  click('Filtra')->
  with('response')->begin()->
    checkElement('.fatture tbody tr ', 3)->
  end()->
  click('Reset')->
  setField('fattura_filters[cliente_id]', '01')->
  click('Filtra')->
  with('response')->begin()->
    checkElement('.fatture tbody tr ', 6)->
  end()->
  click('Reset')->
  setField('fattura_filters[cliente_id]', 'test')->
  click('Filtra')->
  with('response')->begin()->
    checkElement('p:contains("Nessuna fattura disponibile.")')->
  end();

$browser->info('Edit invoice of sale');

$browser->
  click('fatture')->
  click('1')->
  click('modifica')->
  with('response')->begin()->
    checkElement('table th:contains("Pro forma")')->
    checkElement('table th:contains("Num fattura")')->
    checkElement('table th:contains("Cliente")')->
    checkElement('table th:contains("Data")')->
    checkElement('table th:contains("Modo pagamento")')->
    checkElement('table th:contains("Sconto")')->
    checkElement('table th:contains("Iva")')->
    checkElement('table th:contains("Spese anticipate")')->
    checkElement('table th:contains("Calcola ritenuta")')->
    checkElement('table th:contains("Calcola tasse")')->
    checkElement('table th:contains("Scorpora tasse")')->
    checkElement('table th:contains("Note")')->
    checkElement('input[type="checkbox"][name="proforma"][value="y"]')->
    checkElement('input[type="hidden"][name="num_fattura"][value="1"]')->
    checkElement('input[type="hidden"][name="data"][value="'.date('d/m/y', strtotime('tomorrow')).'"]')->
    checkElement('select[name="modo_pagamento_id"] option', '10 Giorni')->
    checkElement('select[name="modo_pagamento_id"] option', 'Rimessa diretta', array('position' => 1))->
    checkElement('input[type="text"][name="sconto"][value="0"]')->
    checkElement('input[type="text"][name="sconto"][value="0"]')->
    checkElement('select[name="vat"] option', '20%')->
    checkElement('input[type="text"][name="spese_anticipate"][value="0"]')->
    checkElement('select[name="calcola_ritenuta_acconto"] option[selected="selected"]', 'Auto')->
    checkElement('select[name="calcola_tasse"] option[selected="selected"]', 'Si')->
    checkElement('select[name="includi_tasse"] option[selected="selected"]', 'No')->
  end()->
  setField('sconto', '10')->
  click('Salva e vai ai dettagli')->
  followRedirect()->
  with('response')->begin()->
    checkElement('table.edit th', 'Imponibile:')->
    checkElement('table.edit td', '/1.000,00 €/')->
    checkElement('table.edit th', 'Sconto 10%:', array('position' => 1))->
    checkElement('table.edit td', '-100 €', array('position' => 1))->
  end();
  
 $criteria = new Criteria();
 $criteria->add(UtentePeer::USERNAME, 'user');

 $user = UtentePeer::doSelectOne($criteria);
 
 $settings = $user->getImpostazione();
 $settings->setInvoiceDecoratorType('number_and_year');
 $settings->save();
 
 $new_invoice_date = strtotime('+1 year');
 
 $browser->
  click('modifica')->
  setField('data', date('d/m/y', $new_invoice_date))->
  click('Salva e vai ai dettagli')->
  followRedirect()->
  with('response')->begin()->
    checkElement('h2', '/001-'.date('Y', $new_invoice_date).' del/')->
  end();


$browser->test()->todo('Test taxes payment');
$browser->test()->todo('Test invoice copy');
$browser->test()->todo('Test invoice download');
$browser->test()->todo('test invoice details');
$browser->test()->todo('test invoice calculation');