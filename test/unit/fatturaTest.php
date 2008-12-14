<?php 
include_once(dirname(__FILE__).'/../bootstrap/unit.php');
include_once(dirname(__FILE__).'/../../lib/model/Fattura.php');

Class ModoPagamento{  
  
  function getId(){
    return 1;
  }
  
  function setNumGiorni($num){
    $this->num_giorni = $num;
  }
  
  function getNumGiorni(){
    return $this->num_giorni;
  }
  
}

$test = new lime_test(4, new lime_output_color());

$test->comment('->checkInRitardo()');

$modo_pagamento = new ModoPagamento();
$modo_pagamento->setNumGiorni(10);

$fattura = new Fattura();
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

?>