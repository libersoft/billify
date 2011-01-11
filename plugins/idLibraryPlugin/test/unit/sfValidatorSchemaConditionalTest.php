<?php
include(dirname(__FILE__).'/../../../../test/bootstrap/unit.php');
require_once(dirname(__FILE__).'/../../lib/validator/sfValidatorSchemaConditional.class.php');

$t = new lime_test(11, new lime_output_color());

// __construct()
$t->diag('__construct()');

$v =  new sfValidatorSchemaConditional('send_remind', array(0 => array('first_field' => new sfValidatorString(array('required' => false, 'trim' => true, 'max_length' => 3))),
                                                            1 => array('second_field' => new sfValidatorEmail(array('required' => false))),
                                                            2 => null ));
                                                             
$t->isa_ok($v, 'sfValidatorSchemaConditional', '__construct() ok');

try{
  $v =  new sfValidatorSchemaConditional('send_remind','');
  $t->fail('__construct() not fallen in Exception');
}
catch(Exception $e){
   $t->pass('__construct() throws an Exception');
}

// ->clean()
$v =  new sfValidatorSchemaConditional('send_remind', array(0 => array('first_field' => new sfValidatorString(array('trim' => true, 'max_length' => 3))),
                                                            1 => array('second_field' => new sfValidatorEmail()),
                                                            2 => null ));

try{
  $v->clean('bla');
  $t->fail('clean not fallen in Exception');
}
catch (InvalidArgumentException $e){
  $t->pass('->clean() throws a InvalidArgumentException');
}
  
$checkboxValue = 0;  

$t->diag('->clean() with only checkbox checked');
try
{
  $v->clean(array('send_remind' => $checkboxValue));
  $t->fail('clean not fallen in Exception');
}
catch (sfValidatorError $e)
{
  $t->pass('->clean() throws a sfValidatorError:'.$e);
}

$t->diag('->clean() with checkbox and first_field (not validate)');
try
{
  $v->clean(array('send_remind' => $checkboxValue,
                  'first_field' => 'prova'));
  $t->fail('clean not fallen in Exception');
}
catch (sfValidatorError $e)
{
  $t->pass('->clean() throws a sfValidatorError:'.$e);
}

$t->diag('->clean() with checkbox and second_field (not validate)');
try
{
  $v->clean(array('send_remind' => $checkboxValue,
                  'second_field' => 'prova'));
  $t->fail('clean not fallen in Exception');
}
catch (sfValidatorError $e)
{
  $t->pass('->clean() throws a sfValidatorError:'.$e);
}

$checkboxValue = 0;  

$t->diag('->clean() with checkbox and first_field (validate)');

$t->isa_ok($v->clean(array('send_remind' => $checkboxValue,
                'first_field' => 'pro')),'array','clean() returns right values');

$checkboxValue = 1;  

$t->diag('->clean() with checkbox and first_field (not validate)');
try
{
  $v->clean(array('send_remind' => $checkboxValue,
                  'first_field' => 'prova'));
  $t->fail('clean not fallen in Exception');
}
catch (sfValidatorError $e)
{
  $t->pass('->clean() throws a sfValidatorError:'.$e);
}

$t->diag('->clean() with checkbox and second_field (not validate)');
try
{
  $v->clean(array('send_remind' => $checkboxValue,
                  'second_field' => 'prova'));
  $t->fail('clean not fallen in Exception');
}
catch (sfValidatorError $e)
{
  $t->pass('->clean() throws a sfValidatorError:'.$e);
}

$t->diag('->clean() with checkbox and first_field (validate)');

$t->isa_ok($v->clean(array('send_remind' => $checkboxValue,
                'second_field' => 'prova@prova.it')),'array','clean() returns right values');
                
$checkboxValue = 2;

$t->isa_ok($v->clean(array('send_remind' => $checkboxValue)),'array','clean() returns right values');

