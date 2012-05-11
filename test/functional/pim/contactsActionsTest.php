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
  click('lista clienti')->
  with('response')->
  begin()->
  
  
  checkElement('table', 1)->
  checkElement('table tr', 11)->
  checkElement('table tr th', 6)->
  checkElement('table tr th', 'Ragione Sociale', array('position' => 0))->
  checkElement('table tr th', 'Contatto', array('position' => 1))->
  checkElement('table tr th', 'E-Mail', array('position' => 2))->
  checkElement('table tr th', 'Telefono', array('position' => 3))->
  checkElement('table tr th', 'Fax', array('position' => 4))->

  checkElement('.rubrica td', '00 Azienda', array('position' => 0))->
  checkElement('.rubrica td', 'Utente utente', array('position' => 1))->
  checkElement('.rubrica td', 'azienda@example.it', array('position' => 2))->
  checkElement('.rubrica td', '35989805', array('position' => 3))->
  checkElement('.rubrica td', '36064127', array('position' => 4))->

  checkElement('div.pagination', 1)->
  checkElement('div.pagination a', '«', array('position' => 0))->
  checkElement('div.pagination a', '<', array('position' => 1))->
  checkElement('div.pagination a', '/1/', array('position' => 2))->
  checkElement('div.pagination a', '/2/', array('position' => 3))->
  checkElement('div.pagination a', '/>/', array('position' => 4))->
  checkElement('div.pagination a', '/»/', array('position' => 5))
;

$browser->
  info('check for single contact page')->
  click('lista clienti')->
  click('01 Azienda')->
  with('response')->
  begin()->
  checkElement('.fatture tr', 7)->        
  checkElement('.fatture td', 'Pro-Forma', array('position' => 0))->        
  checkElement('.fatture td', 'Pro-Forma', array('position' => 8))->        
  checkElement('.fatture td', 'Pro-Forma', array('position' => 16))->        
  checkElement('.fatture td', '1', array('position' => 24))->        
  checkElement('.fatture td', '2', array('position' => 32))->        
  checkElement('.fatture td', '3', array('position' => 40))->        
  checkElement('.title h2', '/01 Azienda/')->
  checkElement('#contatti', '/via degli ulivi, 19/')->
  checkElement('#contatti', '/60100 Milano \(MI\)/')->
  checkElement('#contatti', '/Tel. 35989805/')->
  checkElement('#contatti', '/Referente: Utente utente/')->
  checkElement('#contatti', '/E-Mail: azienda@example.it/')->
  checkElement('#contatti', '/P.IVA: 343810309/')->
  checkElement('select[name="year"] option[selected]', '/2011/')->
  checkElement('.total .stimato', '/6.000/')->
  checkElement('.total', '/3.000/');
      

$browser->
  get('/')->
  click('aggiungi un nuovo cliente')->
  setField('contatto[ragione_sociale]', 'Gigi Lapislazulli')->
  setField('contatto[piva]', '1234')->
  setField('contatto[nazione]', 'Italia')->
  click('Salva')->

  followRedirect()->
  with('response')->
  begin()->
  checkElement('h2', 'Gigi Lapislazulli')
;



?>
