<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');
include_once(dirname(__FILE__).'/../../lib/decorator/NumberAndYearInvoiceDecorator.class.php');

$test = new lime_test(4, new lime_output_color());

$invoice = new Vendita();
$invoice->setData('2008-11-01');
$invoice->setNumFattura('1');
$nfp = new NumberAndYearInvoiceDecorator($invoice);
$test->is($nfp->getNumFattura(), '001-2008', '->getNumFattura() returns right invoice number');

$invoice->setData('2010-11-01');
$invoice->setNumFattura('11');
$test->is($nfp->getNumFattura(), '011-2010', '->getNumFattura() returns right invoice number');

$invoice->setData('2020-11-01');
$invoice->setNumFattura('121');
$test->is($nfp->getNumFattura(), '121-2020', '->getNumFattura() returns right invoice number');

$invoice->setNumFattura('1234532134');
$test->is($nfp->getNumFattura(), '1234532134-2020', '->getNumFattura() returns right invoice number');