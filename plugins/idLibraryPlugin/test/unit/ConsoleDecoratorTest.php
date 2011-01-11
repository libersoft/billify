<?php
include(dirname(__FILE__).'/../../../../test/bootstrap/unit.php');
include(dirname(__FILE__).'/../../lib/decorator/ConsoleDecorator.class.php');

$t = new lime_test(2, new lime_output_color());

Class PropelObject{

  public function toArray(){
    return array('ID' => 1, 'NAME' => 'PROVA', 'SURNAME' => 'PROVA');
  }
}


$decorator = new ConsoleDecorator(new PropelObject());
$t->isa_ok($decorator->render(), 'string', '->render() returns right type');
$string = "ID: 1\nNAME: PROVA\nSURNAME: PROVA\n";
$t->is($decorator->render(), $string, '->render() returns right value');

?>