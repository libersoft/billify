<?php
include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  get('/')->
  setField('login', 'user')->
  setField('password', 'user')->
  click('Entra')->
  followRedirect()->
  click('lista fornitori')->
  with('response')->
  begin()->
  checkElement('table', 1)->
  checkElement('table tr th', 6)->
  checkElement('table tr th', 'Ragione Sociale', array('position' => 0))->
  checkElement('table tr th', 'Contatto', array('position' => 1))->
  checkElement('table tr th', 'E-Mail', array('position' => 2))->
  checkElement('table tr th', 'Telefono', array('position' => 3))->
  checkElement('table tr th', 'Fax', array('position' => 4))->

  click('aggiungi un nuovo fornitore')->
  with('response')->
  begin()->
  checkElement('h2', 'Nuovo fornitore')->
  checkElement('label[for="contatto_ragione_sociale"]', 'Ragione sociale')->
  checkElement('input[type="text"][id="contatto_ragione_sociale"]')->
  checkElement('label[for="contatto_email"]', 'E-Mail')->
  checkElement('input[type="text"][id="contatto_email"]')->
  checkElement('label[for="contatto_telefono"]', 'Telefono')->
  checkElement('input[type="text"][id="contatto_telefono"]')->
  checkElement('label[for="contatto_fax"]', 'Fax')->
  checkElement('input[type="text"][id="contatto_fax"]')->
  checkElement('label[for="contatto_contatto"]', 'Contatto')->
  checkElement('input[type="text"][id="contatto_contatto"]')->
  checkElement('input[type="submit"][value="Salva"]')->

  click('Salva')->
  with('request')->
  begin()->
  isParameter('module', 'contact')->
  isParameter('action', 'create')->
  isStatusCode(200)->
  with('response')->
  begin()->
  checkElement('.error_list', 2)->

  setField('contatto[ragione_sociale]', 'Prova')->
  click('Salva')->
  with('response')->
  begin()->
  checkElement('.error_list', 1)->

  setField('contatto[piva]', '1234')->
  click('Salva')->
  followRedirect()->
  with('response')->
  begin()->
  checkElement('.error_list', 0)->
  click('lista fornitori')->
  
  with('response')->
  begin()->
  checkElement('tr', 11)->
  click('delete')->
  followRedirect()->
  click('delete')->
  followRedirect()->
  click('>')->
  checkElement('tr', 10)


;
?>
