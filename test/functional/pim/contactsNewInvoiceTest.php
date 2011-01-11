<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new paTestFunctional(new sfBrowser());
$browser->loadData(sfConfig::get('sf_test_dir').'/fixtures/fixtures.yml');

$browser->
  login()->
  click('rubrica')->
  click('00 Azienda')->
  click('new invoice')->

  with('request')->begin()->
    isParameter('module', 'fattura')->
    isParameter('action', 'create')->
  end()->
  followRedirect()->

 info(' check if default invoice value is applied for the client')->
 with('response')->begin()->
    isStatusCode(200)->
    checkElement('#col-left .title h2', '/Fattura n. 26/')->
    checkElement('#col-left h3', '/00 Azienda/')->
    checkElement('#col-right .ul-list li', '/no/', array('position' => 4))->
    checkElement('#col-right .ul-list li', '/si/', array('position' => 5))->
    checkElement('#col-right .ul-list li', '/no/', array('position' => 6))->
 end();



?>