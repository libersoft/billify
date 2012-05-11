<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData(sfConfig::get('sf_test_dir').'/fixtures/cashflow.yml');

$browser->
  login()->
  get('@cashflow')->
  checkElement('h2', '/Cash Flow/')->

  info('1 - Nuova entrata')->
  click('aggiungi una nuova entrata')->
  with('request')->
  begin()->
  isParameter('module', 'cashflow')->
  isParameter('action', 'create')->
  isParameter('type', FatturaPeer::CLASSKEY_ENTRATA)->

  with('response')->
  begin()->
  checkElement('h2', '/Nuova entrata/')->
  checkElement('label[for="fattura_contatto_string"]', 'Contatto')->
  checkElement('input[type="text"][id="fattura_contatto_string"]')->
  checkElement('label[for="fattura_descrizione"]', 'Descrizione')->
  checkElement('input[type="text"][id="fattura_descrizione"]')->
  checkElement('label[for="fattura_data"]', 'Data')->
  checkElement('input[id="fattura_data"]')->
  checkElement('label[for="fattura_imponibile"]', 'Imponibile')->
  checkElement('input[type="text"][id="fattura_imponibile"]')->
  checkElement('label[for="fattura_imposte"]', 'Imposte')->
  checkElement('input[type="text"][id="fattura_imposte"]')->
  checkElement('label[for="fattura_data_scadenza"]', 'Data scadenza')->
  checkElement('input[id="fattura_data_scadenza"]')->
  checkElement('label[for="fattura_stato"]', 'Stato')->
  checkElement('select[id="fattura_stato"]')->
  checkElement('input[type="submit"][value="Salva"]')->

  setField('fattura[contatto_string]', 'Azienda Custom')->
  setField('fattura[descrizione]', 'Nuova riga')->
  setField('fattura[imponibile]', '10000')->
  setField('fattura[imposte]', '1000')->
  setField('fattura[stato]', 'n')->
  setField('fattura[data]', '10/01/2008')->
  click('Salva')->
  with('form')->begin()->
    hasErrors(true)->
  end()->
  setField('fattura[data_scadenza]', '10/02/2008')->
  click('Salva')->

  with('form')->begin()->
    hasErrors(false)->
  end()->
  followRedirect()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('span.notice', '/documento salvato con successo/')->
  end()->
        
  get('@cashflow')->
  setField('cash_flow_filters[document_date][from]', '10/2/2008')->
  setField('cash_flow_filters[document_date][to]', '10/2/2008')->
  click('Filtra')->
  
  with('response')->
  begin()->   
  checkElement('table td', '2008-02-10', array('position' => 0))->
  checkElement('table td', 'Azienda Custom', array('position' => 1))->
  checkElement('table td', 'Nuova riga del 10/01/2008', array('position' => 2))->
  checkElement('table td a', 'Nuova riga del 10/01/2008', array('position' => 1))->
  checkElement('table td', format_currency('11000', 'EUR'), array('position' => 3))->
  checkElement('table td', '', array('position' => 4))->
  checkElement('table td', 'non pagata', array('position' => 5))->
  checkElement('table td span.warning', 'non pagata');

$browser->
  click('Nuova riga del 10/01/2008')->
  click('Elimina')->
  followRedirect()->
  with('response')->begin()->
    checkElement('span.notice', '/Documento eliminato con successo/')->
  end();
