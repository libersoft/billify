<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new paTestBrowser($configuration, 'http://phpaccount.localhost', null, array('load_data_file' => sfConfig::get('sf_test_dir').'/fixtures/cashflow.yml'));

$browser->
  login()->
  click('Cash Flow')->
  checkResponseElement('h2', 'Cash Flow')->
  
  diag('2 - Nuova entrata')->
  click('Nuova entrata')->
  isRequestParameter('module', 'cashflow')->
  isRequestParameter('action', 'create')->
  isRequestParameter('type', FatturaPeer::CLASSKEY_ENTRATA)->
  
  checkResponseElement('h2', 'Nuova entrata')->
  checkResponseElement('label[for="fattura_contatto_string"]', 'Contatto')->
  checkResponseElement('input[type="text"][id="fattura_contatto_string"]')->
  checkResponseElement('label[for="fattura_descrizione"]', 'Descrizione')->
  checkResponseElement('input[type="text"][id="fattura_descrizione"]')->
  checkResponseElement('label[for="fattura_data"]', 'Data')->
  checkResponseElement('select[id="fattura_data_month"]')->
  checkResponseElement('select[id="fattura_data_day"]')->
  checkResponseElement('select[id="fattura_data_year"]')->
  checkResponseElement('label[for="fattura_imponibile"]', 'Imponibile')->
  checkResponseElement('input[type="text"][id="fattura_imponibile"]')->  
  checkResponseElement('label[for="fattura_imposte"]', 'Imposte')->
  checkResponseElement('input[type="text"][id="fattura_imposte"]')->
  checkResponseElement('label[for="fattura_data_scadenza"]', 'Data scadenza')->
  checkResponseElement('select[id="fattura_data_scadenza_month"]')->
  checkResponseElement('select[id="fattura_data_scadenza_day"]')->
  checkResponseElement('select[id="fattura_data_scadenza_year"]')->
  checkResponseElement('label[for="fattura_stato"]', 'Stato')->
  checkResponseElement('select[id="fattura_stato"]')->
  checkResponseElement('input[type="submit"][value="Salva"]')->
  
  setField('fattura[contatto_string]', 'Azienda Custom')->
  setField('fattura[descrizione]', 'Nuova riga')->
  setField('fattura[imponibile]', '10000')->
  setField('fattura[imposte]', '1000')->
  setField('fattura[data]', array('day' => '10', 'month' => '1', 'year' => '2008'))->
  setField('fattura[data_scadenza]', array('day' => '10', 'month' => '2', 'year' => '2008'))->
  click('Salva')->
  
  followRedirect()->
  
  click('Torna al cash flow')->
  
  checkResponseElement('table.fatture td', '2008-02-10', array('position' => 0))->
  checkResponseElement('table.fatture td', 'Azienda Custom', array('position' => 1))->
  checkResponseElement('table.fatture td', 'Nuova riga del 10/01/2008', array('position' => 2))->
  checkResponseElement('table.fatture td a', 'Nuova riga del 10/01/2008', array('position' => 1))->
  checkResponseElement('table.fatture td', '€ 11.000,00', array('position' => 3))->
  checkResponseElement('table.fatture td', '', array('position' => 4))->
  checkResponseElement('table.fatture td', 'No', array('position' => 5))->
  checkResponseElement('table.fatture td[style="background-color: red; font-weight: bold;"]', 'No');
  
$browser = new paTestBrowser($configuration);
$browser->
  login()->
  diag('2 - Nuova uscita')->
  click('Nuova uscita')->
  isRequestParameter('module', 'cashflow')->
  isRequestParameter('action', 'create')->
  isRequestParameter('type', FatturaPeer::CLASSKEY_USCITA )->
  
  checkResponseElement('h2', 'Nuova uscita')->
  checkResponseElement('label[for="fattura_contatto_string"]', 'Contatto')->
  checkResponseElement('input[type="text"][id="fattura_contatto_string"]')->
  checkResponseElement('label[for="fattura_descrizione"]', 'Descrizione')->
  checkResponseElement('input[type="text"][id="fattura_descrizione"]')->
  checkResponseElement('label[for="fattura_data"]', 'Data')->
  checkResponseElement('select[id="fattura_data_month"]')->
  checkResponseElement('select[id="fattura_data_day"]')->
  checkResponseElement('select[id="fattura_data_year"]')->
  checkResponseElement('label[for="fattura_imponibile"]', 'Imponibile')->
  checkResponseElement('input[type="text"][id="fattura_imponibile"]')->  
  checkResponseElement('label[for="fattura_imposte"]', 'Imposte')->
  checkResponseElement('input[type="text"][id="fattura_imposte"]')->
  checkResponseElement('label[for="fattura_data_scadenza"]', 'Data scadenza')->
  checkResponseElement('select[id="fattura_data_scadenza_month"]')->
  checkResponseElement('select[id="fattura_data_scadenza_day"]')->
  checkResponseElement('select[id="fattura_data_scadenza_year"]')->
  checkResponseElement('label[for="fattura_stato"]', 'Stato')->
  checkResponseElement('select[id="fattura_stato"]')->
  checkResponseElement('input[type="submit"][value="Salva"]')->
  
  setField('fattura[contatto_string]', 'Azienda Custom Uscita')->
  setField('fattura[descrizione]', 'Nuova riga')->
  setField('fattura[imponibile]', '5000')->
  setField('fattura[imposte]', '200')->
  setField('fattura[data]', array('day' => '12', 'month' => '1', 'year' => '2008'))->
  setField('fattura[data_scadenza]', array('day' => '9', 'month' => '2', 'year' => '2008'))->
  click('Salva')->
  
  followRedirect()->
  
  click('Torna al cash flow')->
  
  checkResponseElement('table.fatture td', '2008-02-09', array('position' => 0))->
  checkResponseElement('table.fatture td', 'Azienda Custom Uscita', array('position' => 1))->
  checkResponseElement('table.fatture td', 'Nuova riga del 12/01/2008', array('position' => 2))->
  checkResponseElement('table.fatture td a', 'Nuova riga del 12/01/2008', array('position' => 1))->
  checkResponseElement('table.fatture td', '', array('position' => 3))->
  checkResponseElement('table.fatture td', '€ 5.200,00', array('position' => 4))->
  checkResponseElement('table.fatture td', 'No', array('position' => 5))->
  checkResponseElement('table.fatture td[style="background-color: red; font-weight: bold;"]', 'No')
  
  ;