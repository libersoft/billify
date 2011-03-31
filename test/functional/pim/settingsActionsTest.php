<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData(sfConfig::get('sf_test_dir').'/fixtures/fixtures.yml');

$browser->
  login()->
  info('1. settings list')->
  click('impostazioni')->

  with('request')->begin()->
    isParameter('module', 'impostazione')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('h2', '/Impostazioni/')->
    checkElement('#breadcrumps ul li', 3)->
    checkElement('#breadcrumps ul li', 'Sei in:', array('position' => 0))->
    checkElement('#breadcrumps ul li', '/Home/', array('position' => 1))->
    checkElement('#breadcrumps ul li', '/Impostazioni/', array('position' => 2))->

    checkElement('#paginazione th', 3)->
    checkElement('#paginazione th', 'Num clienti:', array('position' => 0))->
    checkElement('#paginazione th', 'Num fatture:', array('position' => 1))->
    checkElement('#paginazione th', 'Righe dettagli:', array('position' => 2))->
    checkElement('#paginazione td input[id="num_clienti"]')->
    checkElement('#paginazione td input[name="num_fatture"][value="20"]')->
    checkElement('#paginazione td input[id="righe_dettagli"]')->

    checkElement('#features th', 6)->
    checkElement('#features th', 'Consegna commercialista:', array('position' => 0))->
    checkElement('#features th', 'Deposita iva:', array('position' => 1))->
    checkElement('#features th', 'Fattura automatica:', array('position' => 2))->
    checkElement('#features th', 'Codice cliente:', array('position' => 3))->
    checkElement('#features th', 'Ritenuta acconto:', array('position' => 4))->
    checkElement('#features th', 'Tipo ritenuta:', array('position' => 5))->

    checkElement('#features td input[id="riepilogo_home_s"]', false)->
    checkElement('#features td input[id="riepilogo_home_n"]', false)->
    checkElement('#features td input[id="consegna_commercialista_s"]')->
    checkElement('#features td input[id="consegna_commercialista_n"]')->
    checkElement('#features td input[id="deposita_iva_s"]')->
    checkElement('#features td input[id="deposita_iva_n"]')->
    checkElement('#features td input[id="fattura_automatica_s"]')->
    checkElement('#features td input[id="fattura_automatica_n"]')->
    checkElement('#features td input[id="codice_cliente_s"]')->
    checkElement('#features td input[id="codice_cliente_n"]')->
    checkElement('#features td input[id="percentuale_ra"]')->
    checkElement('#features td input[id="percentuale_imponibile_ra"]')->
    checkElement('#features td select[id="tipo_ritenuta"]')->

    checkElement('#label-fattura th', 7)->
    checkElement('#label-fattura th', 'Label imponibile:', array('position' => 0))->
    checkElement('#label-fattura th', 'Label spese:', array('position' => 1))->
    checkElement('#label-fattura th', 'Label imponibile iva:', array('position' => 2))->
    checkElement('#label-fattura th', 'Label iva:', array('position' => 3))->
    checkElement('#label-fattura th', 'Label totale fattura:', array('position' => 4))->
    checkElement('#label-fattura th', 'Label ritenuta acconto:', array('position' => 5))->
    checkElement('#label-fattura th', 'Label netto liquidare:', array('position' => 6))->

    checkElement('#label-fattura td input[id="label_imponibile"][value="Imponibile"]')->
    checkElement('#label-fattura td input[id="label_spese"][value="Spese Anticipate"]')->
    checkElement('#label-fattura td input[id="label_imponibile_iva"][value="Imponibile ai fini iva"]')->
    checkElement('#label-fattura td input[id="label_iva"][value="Iva"]')->
    checkElement('#label-fattura td input[id="label_totale_fattura"][value="Totale Fattura"]')->
    checkElement('#label-fattura td input[id="label_ritenuta_acconto"][value="Ritenuta d\'acconto"]')->
    checkElement('#label-fattura td input[id="label_netto_liquidare"][value="Netto da liquidare"]')->

    checkElement('#label-dettagli-fattura th', 5)->
    checkElement('#label-dettagli-fattura th', 'Label quantita:', array('position' => 0))->
    checkElement('#label-dettagli-fattura th', 'Label descrizione:', array('position' => 1))->
    checkElement('#label-dettagli-fattura th', 'Label prezzo singolo:', array('position' => 2))->
    checkElement('#label-dettagli-fattura th', 'Label prezzo totale:', array('position' => 3))->
    checkElement('#label-dettagli-fattura th', 'Label sconto:', array('position' => 4))->

    checkElement('#label-dettagli-fattura td input[id="label_quantita"][value="Qty"]')->
    checkElement('#label-dettagli-fattura td input[id="label_descrizione"][value="Descrizione"]')->
    checkElement('#label-dettagli-fattura td input[id="label_prezzo_singolo"][value="Prezzo Singolo"]')->
    checkElement('#label-dettagli-fattura td input[id="label_prezzo_totale"][value="Prezzo Totale"]')->
    checkElement('#label-dettagli-fattura td input[id="label_sconto"][value="Sconto"]')->
  end()->

  setField('label_quantita', 'Quantità')->
  click('Salva')->

  //followRedirect()->

  with('response')->begin()->
    checkElement('#label-dettagli-fattura td input[id="label_quantita"][value="Quantità"]')->
  end()
;