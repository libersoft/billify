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
  click('rubrica')->
  checkResponseElement('table', 1)->
  checkResponseElement('table tr', 11)->
  checkResponseElement('table tr th', 6)->
  checkResponseElement('table tr th', 'Ragione Sociale', array('position' => 0))->
  checkResponseElement('table tr th', 'Contatto', array('position' => 1))->
  checkResponseElement('table tr th', 'E-Mail', array('position' => 2))->
  checkResponseElement('table tr th', 'Telefono', array('position' => 3))->
  checkResponseElement('table tr th', 'Fax', array('position' => 4))->

  checkResponseElement('.rubrica td', '00 Azienda', array('position' => 0))->
  checkResponseElement('.rubrica td', 'Utente utente', array('position' => 1))->
  checkResponseElement('.rubrica td', 'azienda@example.it', array('position' => 2))->
  checkResponseElement('.rubrica td', '35989805', array('position' => 3))->
  checkResponseElement('.rubrica td', '36064127', array('position' => 4))->

  checkResponseElement('div.navigator', 1)->
  checkResponseElement('div.navigator a', '«', array('position' => 0))->
  checkResponseElement('div.navigator a', '<', array('position' => 1))->
  checkResponseElement('div.navigator', '/1/')->
  checkResponseElement('div.navigator a', '2', array('position' => 2))->
  checkResponseElement('div.navigator a', '>', array('position' => 3))->
  checkResponseElement('div.navigator a', '»', array('position' => 4))
;

$browser->
  info('check for single contact page')->
  click('rubrica')->
  click('01 Azienda')->
  checkResponseElement('.fatture tr', 7)->        
  checkResponseElement('.fatture td', 'Pro-Forma', array('position' => 0))->        
  checkResponseElement('.fatture td', 'Pro-Forma', array('position' => 6))->        
  checkResponseElement('.fatture td', 'Pro-Forma', array('position' => 12))->        
  checkResponseElement('.fatture td', '1', array('position' => 18))->        
  checkResponseElement('.fatture td', '2', array('position' => 24))->        
  checkResponseElement('.fatture td', '3', array('position' => 30))->        
  checkResponseElement('.title h2', '/01 Azienda/')->
  checkResponseElement('#contatti', '/via degli ulivi, 19/')->
  checkResponseElement('#contatti', '/60100 Milano \(MI\)/')->
  checkResponseElement('#contatti', '/Tel. 35989805/')->
  checkResponseElement('#contatti', '/Referente: Utente utente/')->
  checkResponseElement('#contatti', '/E-Mail: azienda@example.it/')->
  checkResponseElement('#contatti', '/P.IVA: 343810309/')->
  checkResponseElement('select[name="year"] option[selected]', '/2011/')->
  checkResponseElement('.total .stimato', '/6.000/')->
  checkResponseElement('.total', '/3.000/');
      

$browser->
  get('/')->
  click('aggiungi un nuovo cliente')->
  setField('contatto[ragione_sociale]', 'Gigi Lapislazulli')->
  setField('contatto[piva]', '1234')->
  setField('contatto[nazione]', 'Italia')->
  click('Salva')->

  followRedirect()->
  checkResponseElement('h2', 'Gigi Lapislazulli')
;



?>
