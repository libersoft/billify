<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');

include_once(dirname(__FILE__).'/../../lib/decorator/PlainInvoiceDecorator.class.php');

$test = new lime_test(4, new lime_output_color());

$invoice = new Vendita();
$invoice->setData('2008-11-01');
$invoice->setNumFattura('1');
$nfp = new PlainInvoiceDecorator($invoice);
$test->is($nfp->getNumFattura(), '1', '->getNumFattura() returns right invoice number');

$invoice->setData('2010-11-01');
$invoice->setNumFattura('11');
$test->is($nfp->getNumFattura(), '11', '->getNumFattura() returns right invoice number');

$invoice->setData('2020-11-01');
$invoice->setNumFattura('121');
$test->is($nfp->getNumFattura(), '121', '->getNumFattura() returns right invoice number');

$invoice->setNumFattura('1234532134');
$test->is($nfp->getNumFattura(), '1234532134', '->getNumFattura() returns right invoice number');