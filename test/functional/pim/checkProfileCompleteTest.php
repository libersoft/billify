<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestBrowser();
$browser->initialize();

$browser->
  get('/');
