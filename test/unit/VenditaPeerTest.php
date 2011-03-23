<?php
include_once(dirname(__FILE__).'/../bootstrap/unit.php');


$configuration = ProjectConfiguration::getApplicationConfiguration('pim', 'test', true);
$context = sfContext::createInstance($configuration);

$data = new sfPropelData();
$data->loadData(sfConfig::get('sf_test_dir').'/fixtures/fixtures.yml');

$test = new lime_test(4, new lime_output_color());

$criteria = new Criteria();
$criteria->add(UtentePeer::USERNAME , 'user');
$user = UtentePeer::doSelectOne($criteria);

$context->getUser()->signin($user);

FatturaPeer::$user_id = $user->getId();

$fatturato = VenditaPeer::getFatturato('2011');

$test->is($fatturato[0], 17280, '->getFatturato returns right fatturato annuo');
$test->is($fatturato[1], 12000, '->getFatturato returns right fatturato annuo netto');
$test->is($fatturato[2], 0, '->getFatturato returns right ritenuta acconto');
$test->is($fatturato[3], 2400, '->getFatturato returns right inps');
