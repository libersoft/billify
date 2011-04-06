<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('pim', 'test', true);
new sfDatabaseManager($configuration);

$test = new lime_test(17, new lime_output_color());

$dettaglio1 = new DettagliFattura();
$dettaglio1->setPrezzo(1000);
$dettaglio1->setQty(2);
$dettaglio1->setIVa(20);

$dettaglio2 = new DettagliFattura();
$dettaglio2->setPrezzo(1000);
$dettaglio2->setQty(2);
$dettaglio2->setIva(10);

$fattura = new Vendita();
$fattura->addDettagliFattura($dettaglio1);
$fattura->addDettagliFattura($dettaglio2);
$fattura->calcolaFattura();

$test->is($fattura->getTotale(), '4600', '->getTotale() returns right value');

$tassa = new Tassa();
$tassa->setValore(20);

$fattura = new Vendita();
$fattura->addDettagliFattura($dettaglio1);
$fattura->addDettagliFattura($dettaglio2);

$fattura->calcolaFattura(array($tassa));
$tasse_ulteriori = $fattura->getTasseUlteriori();

$test->isa_ok($tasse_ulteriori, 'array', '->getTasseUlteriori() returns right value');
$test->is($tasse_ulteriori[0]['costo'], '800', '->getTasseUlteriori() returns right value');
$test->is($fattura->getIva(), '720', '->getIva() returns right value');
$test->is($fattura->getImponibile(), '4000', '->getImponibile() returns right value');
$test->is($fattura->getImponibileFineIva(), '4800', '->getImponibileFineIva() returns right value');
$test->is($fattura->getTotale(), 4800 + 720, '->getTotale() returns right value');

$test->comment('->checkInRitardo()');
$modo_pagamento = new ModoPagamento();
$modo_pagamento->setNumGiorni(10);

$fattura = new Vendita();
$fattura->setStato('i');
$fattura->setModoPagamento($modo_pagamento);
$fattura->setData(date('Y-m-d', strtotime('-1 year')));
$test->is($fattura->checkInRitardo(), true, '->checkInRitardo() return true');
$fattura->setData(date('Y-m-d', strtotime('-1 month')));
$test->is($fattura->checkInRitardo(), true, '->checkInRitardo() return true');
$fattura->setData(date('Y-m-d', strtotime('+1 month')));
$test->is($fattura->checkInRitardo(), false, '->checkInRitardo() return false');

$test->comment('->getDataPagamento()');
$test->is($fattura->getDataPagamento(), strftime(date('d M Y', strtotime('+10 days +1 month'))), '->getDataPagamento() return right date');

$test->comment('getStato()');
$fattura = new Vendita();
$fattura->setStato('n');
$test->is($fattura->getStato(), 'n', '->getStato() returns right value');
$test->is($fattura->getStato(true), 'non inviata', '->getStato() returns right value');

$test->comment('getColorStato()');
$test->is($fattura->getColorStato(), 'yellow', '->getColorStato() returns right value');

$test->comment('getFontColorStato()');
$test->is($fattura->getFontColorStato(), 'black', '->getFontColorStato() returns right value');

$test->comment('Limite caratteri nel numero di fattura');
$fattura = new Vendita();
$fattura->setNumFattura('123456789012');
$fattura->save();

$test->is($fattura->getNumFattura(), '123456789012', '->getNumFattura() returns right value');

$user = UtentePeer::retrieveByUsername('user');

$fattura = new Vendita();
$fattura->setNumFattura('1');
$fattura->setData('2011-01-10');
$fattura->setUtente($user);

$test->is($fattura->getNumFattura(), '1', '->getNumFattura() returns right value');