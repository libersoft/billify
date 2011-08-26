<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new lime_test(10, new lime_output_color());

$v1 = new Vendita();
$v1->setId(100);
$v1->setData(strtotime('-3 days'));
$v1->setNumFattura('100');

$cliente = new Cliente();
$cliente->setRagioneSociale('Customer');
$cliente->setId(100);
$cliente->setAzienda('s');

$dettaglio = new DettagliFattura();
$dettaglio->setPrezzo(1000);
$dettaglio->setQty(1);
$dettaglio->setIva(20);

$v1->setCliente($cliente);
$v1->addDettagliFattura($dettaglio);
$v1->calcolaFattura();

$vcf1 = new CashFlowSalesAdapter($v1);
$test->is($vcf1 instanceof ICashFlowAdapter, true, '->__construct() return an instance of ICashFlowAdapter');
$test->is($vcf1->getDate(), date('Y/m/d', strtotime('-3 days')), '->getDate() return right date');
$test->is($vcf1->getDescription(), 'Fattura n. 100', '->getDescription() return right description value');
$test->is($vcf1->getTaxable(), '1000', '->getTaxable() return right taxable value');
$test->is($vcf1->getTaxes(), '200', '->getTaxes() return right taxes value');
$test->is($vcf1->getTotal(), '1200', '->getTotal() return right total');
$test->is($vcf1->getContact(), 'Customer', '->getContact() returns right value');
$test->is($vcf1->getContactUrl(), 'contact/show?id=100', '->getContact() returns right value');
$test->is($vcf1->isPaid(), false, '->getContact() returns right value');

$vcf1->setWithTaxes(false);
$test->is($vcf1->getTotal(), '1000', '->getTotal() return right total');