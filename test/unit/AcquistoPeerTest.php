<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('pim', 'test', true);
new sfDatabaseManager($configuration);

$test = new lime_test(1, new lime_output_color());
$acquisto_peer = new AcquistoPeer(new sfUser(new sfEventDispatcher(), new sfSessionTestStorage(array('session_path' => '/tmp'))));

$test->isa_ok($acquisto_peer, 'AcquistoPeer', '->getInstance returns an AcquistoPeer object');
