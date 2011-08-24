<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  login('freelance', 'freelance')->

  info('set withholding tax')->
  click('impostazioni')->
  setField('impostazione[percentuale_ra]', '20')->
  setField('impostazione[percentuale_imponibile_ra]', '100')->
  click('Salva')->

  info('insert new tax code')->
  click('lista codici iva')->
  with('response')->begin()->
    checkElement('#col-left p', '/Nessun codice iva disponibile/')->
  end()->
  click('nuovo codice iva')->
  setField('codice_iva[nome]', '20%')->
  setField('codice_iva[valore]', '20')->
  setField('codice_iva[descrizione]', 'Iva al 20%')->
  click('Salva')->
  followRedirect()->

  info('insert new payment type')->
  click('impostazioni')->
  click('lista tipologie di pagamento')->
  with('response')->begin()->
    checkElement('#col-left p', '/Nessuna tipologia di pagamento disponibile/')->
  end()->
  click('nuova tipologia di pagamento')->
  setField('modo_pagamento[num_giorni]', '30')->
  setField('modo_pagamento[descrizione]', '30 giorni')->
  click('Salva')->
  followRedirect()->

  info('insert new contact')->
  click('rubrica')->
  with('response')->begin()->
    checkElement('#col-left p', '/Nessun contatto disponibile/')->
  end()->
  click('aggiungi un nuovo cliente')->
  setField('contatto[ragione_sociale]', 'Lapislazzolo Sas')->
  click('Salva')->
  followRedirect()->

  info('insert new sale invoice')->
  click('nuova fattura')->
  followRedirect()->

  post('dettagliFattura/update',
      array(
        'ids_new' => array(''),
        'qty_new' => array(1),
        'descrizione_new' => array('Test'),
        'prezzo_new' => array('1000'),
        'sconto_new' => array('0'),
        'iva_new' => array('20'),
        'fattura_id' => $browser->getRequest()->getParameter('id')
      )
  )->
  get('/')->click('fatture')->click('1')->
  with('response')->begin()->
    checkElement('table.edit th', 'Ritenuta d\'acconto:', array('position' => '4'))->
    checkElement('table.edit td', '/200,00/', array('position' => '4'))->
    checkElement('table.edit td', '/-/', array('position' => '4'))->
  end()->
  click('impostazioni')->
  setField('impostazione[percentuale_ra]', '0')->
  setField('impostazione[percentuale_imponibile_ra]', '100')->
  click('Salva')->
  click('fatture')->
  click('1')->
  with('response')->begin()->
    checkElement('table.edit th', '!/Ritenuta d\'acconto/', array('position' => '4'))->
  end()->
  
  info('insert new provider')->
  info('insert new purchase invoice')->
  info('insert new entrance')->
  info('insert new exit')->
  info('see cashflow')->
  info('see statistics')
;
