<?php 

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  get('/')->
  with('response')->
  begin()->
  checkElement('input[type="text"][name="login"]')->
  checkElement('input[type="password"][name="password"]')->
  checkElement('input[type="submit"][value="Entra"]')->
  click('Entra')->
  followRedirect()->
  with('response')->
  begin()->
  Contains('Identificazione fallita')->
  setField('login', 'pippo')->
  setField('password', 'pippo')->
  click('Entra')->
  followRedirect()->
  with('response')->
  begin()->
  Contains('Identificazione fallita')->
  setField('login', 'user')->
  setField('password', 'user')->
  click('Entra')->
  followRedirect()->
  isStatusCode(200)
  
;
