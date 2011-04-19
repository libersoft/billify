<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData(sfConfig::get('sf_test_dir').'/fixtures/cashflow.yml');

$browser->
  login()->
  info('1 - Nuova uscita')->
  click('aggiungi una nuova uscita')->
  isRequestParameter('module', 'cashflow')->
  isRequestParameter('action', 'create')->
  isRequestParameter('type', FatturaPeer::CLASSKEY_USCITA )->

  checkResponseElement('h2', '/Nuova uscita/')->
  checkResponseElement('label[for="fattura_contatto_string"]', 'Contatto')->
  checkResponseElement('input[type="text"][id="fattura_contatto_string"]')->
  checkResponseElement('label[for="fattura_descrizione"]', 'Descrizione')->
  checkResponseElement('input[type="text"][id="fattura_descrizione"]')->
  checkResponseElement('label[for="fattura_data"]', 'Data')->
  checkResponseElement('input[id="fattura_data"]')->
  checkResponseElement('label[for="fattura_imponibile"]', 'Imponibile')->
  checkResponseElement('input[type="text"][id="fattura_imponibile"]')->
  checkResponseElement('label[for="fattura_imposte"]', 'Imposte')->
  checkResponseElement('input[type="text"][id="fattura_imposte"]')->
  checkResponseElement('label[for="fattura_data_scadenza"]', 'Data scadenza')->
  checkResponseElement('input[id="fattura_data_scadenza"]')->
  checkResponseElement('label[for="fattura_stato"]', 'Stato')->
  checkResponseElement('select[id="fattura_stato"]')->
  checkResponseElement('input[type="submit"][value="Salva"]')->

  setField('fattura[contatto_string]', 'Azienda Custom Uscita')->
  setField('fattura[descrizione]', 'Nuova riga')->
  setField('fattura[imponibile]', '5000')->
  setField('fattura[imposte]', '200')->
  setField('fattura[stato]', 'n')->
  setField('fattura[data]', '12/01/2008')->
  click('Salva')->
  with('form')->begin()->
    hasErrors(true)->
  end()->
  setField('fattura[data_scadenza]', '09/02/2008')->
  click('Salva')->
        
  with('form')->begin()->
    hasErrors(false)->
  end()->
  followRedirect()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('span.notice', '/documento salvato con successo/')->
  end()->
  click('cash flow')->
  setField('cash_flow_filters[document_date][from]', '9/2/2008')->
  setField('cash_flow_filters[document_date][to]', '9/2/2008')->
  click('Filtra')->

  checkResponseElement('table td', '2008-02-09', array('position' => 0))->
  checkResponseElement('table td', 'Azienda Custom Uscita', array('position' => 1))->
  checkResponseElement('table td', 'Nuova riga del 12/01/2008', array('position' => 2))->
  checkResponseElement('table td a', 'Nuova riga del 12/01/2008', array('position' => 1))->
  checkResponseElement('table td', '', array('position' => 3))->
  checkResponseElement('table td', format_currency('5200', 'EUR'), array('position' => 4))->
  checkResponseElement('table td', 'No', array('position' => 5))->
  checkResponseElement('table td[style="background-color: red; font-weight: bold;"]', 'No')
  ;

$browser->
  click('Nuova riga del 12/01/2008')->
  click('Elimina')->
  followRedirect()->
  with('response')->begin()->
    checkElement('span.notice', '/Documento eliminato con successo/')->
  end();