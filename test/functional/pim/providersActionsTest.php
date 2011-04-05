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
  checkResponseElement('table', 1)->
  checkResponseElement('table tr th', 6)->
  checkResponseElement('table tr th', 'Ragione Sociale', array('position' => 0))->
  checkResponseElement('table tr th', 'Contatto', array('position' => 1))->
  checkResponseElement('table tr th', 'E-Mail', array('position' => 2))->
  checkResponseElement('table tr th', 'Telefono', array('position' => 3))->
  checkResponseElement('table tr th', 'Fax', array('position' => 4))->

  click('aggiungi un nuovo fornitore')->
  checkResponseElement('h2', 'Nuovo fornitore')->
  checkResponseElement('label[for="contatto_ragione_sociale"]', 'Ragione sociale')->
  checkResponseElement('input[type="text"][id="contatto_ragione_sociale"]')->
  checkResponseElement('label[for="contatto_email"]', 'E-Mail')->
  checkResponseElement('input[type="text"][id="contatto_email"]')->
  checkResponseElement('label[for="contatto_telefono"]', 'Telefono')->
  checkResponseElement('input[type="text"][id="contatto_telefono"]')->
  checkResponseElement('label[for="contatto_fax"]', 'Fax')->
  checkResponseElement('input[type="text"][id="contatto_fax"]')->
  checkResponseElement('label[for="contatto_contatto"]', 'Contatto')->
  checkResponseElement('input[type="text"][id="contatto_contatto"]')->
  checkResponseElement('input[type="submit"][value="Salva"]')->

  click('Salva')->
  isRequestParameter('module', 'contact')->
  isRequestParameter('action', 'create')->
  isStatusCode(200)->
  checkResponseElement('.error_list', 2)->

  setField('contatto[ragione_sociale]', 'Prova')->
  click('Salva')->
  checkResponseElement('.error_list', 1)->

  setField('contatto[piva]', '1234')->
  click('Salva')->
  followRedirect()->
  checkResponseElement('.error_list', 0)->
  click('lista fornitori')->

  checkResponseElement('tr', 11)->
  click('delete')->
  followRedirect()->
  click('delete')->
  followRedirect()->
  click('>')->
  checkResponseElement('tr', 10)


;
?>
