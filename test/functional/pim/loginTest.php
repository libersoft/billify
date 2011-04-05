<?php 

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  get('/')->
  checkResponseElement('input[type="text"][name="login"]')->
  checkResponseElement('input[type="password"][name="password"]')->
  checkResponseElement('input[type="submit"][value="Entra"]')->
  click('Entra')->
  followRedirect()->
  responseContains('Identificazione fallita')->
  setField('login', 'pippo')->
  setField('password', 'pippo')->
  click('Entra')->
  followRedirect()->
  responseContains('Identificazione fallita')->
  setField('login', 'user')->
  setField('password', 'user')->
  click('Entra')->
  followRedirect()->
  isStatusCode(200)
  
;