<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$test = new lime_test(8, new lime_output_color());

$utente = new Utente();

$test->ok(!$utente->isActive(), '->isActive() default is false');

$utente->setStato('test');
$test->ok(!$utente->isActive(), '->isActive() with an invalid status is false yet');

$utente->setStato('attivo');
$test->ok($utente->isActive(), '->isActive() is true');

$test->is((string)$utente, '', '->__toString() returns right value');

$utente->setUsername('freelance');
$test->is((string)$utente, 'freelance', '->__toString() returns right value');

$utente->setNome('Gigi');
$test->is((string)$utente, 'freelance', '->__toString() returns right value');

$utente->setNome(null);
$utente->setCognome('Lapislazzulo');
$test->is((string)$utente, 'freelance', '->__toString() returns right value');

$utente->setNome('Gigi');
$utente->setCognome('Lapislazzulo');
$test->is((string)$utente, 'Gigi Lapislazzulo', '->__toString() returns right value');