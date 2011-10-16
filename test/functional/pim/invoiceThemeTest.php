<?php

include_once(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData(sfConfig::get('sf_test_dir').'/fixtures/invoice-themes.yml');

$browser->
  login()->
  info('check default invoice theme for customer')->
  click('lista clienti')->
  click('01 Azienda')->
  click('modifica', array(), array('position'=>2))->
  with('request')->begin()->
    isParameter('module', 'contact')->
    isParameter('action', 'edit')->
  end();

$c = new Criteria();
$c->add(TemaFatturaPeer::NOME, 'ideato rimessa');
$rimessa = TemaFatturaPeer::doSelectOne($c);

$browser->
  with('response')->begin()->
    checkElement('#contatto_id_tema_fattura option[selected]', 'ideato srl')->
  end()->
  
  info('create a new invoice for customer')->
  click('lista clienti')->
  click('01 Azienda')->        
  click('nuova fattura')->      
  followRedirect()->
  with('response')->begin()->
    checkElement('div.title h2', '/Fattura n. 1/')->
        
  end()->      
  click('modifica', array(), array('position' => 2))->        
  with('response')->begin()->
    checkElement('#id_tema_fattura option[selected]', 'ideato srl')->
  end()->
  click('Salva e vai ai dettagli')->           
  followRedirect();
        
$browser->        
  info('edit invoice default theme for customer')->   
  click('lista clienti')->
  click('01 Azienda')->
  click('modifica', array(), array('position' => 2))->
  with('response')->begin()->
    checkElement('#contatto_id_tema_fattura option[selected]', 'ideato srl')->
    setField('contatto[id_tema_fattura]', $rimessa->getId())->    
  end()->        
  click('Salva')->        
  followRedirect();
        
$browser->        
  info('previous invoices for a customer must have old theme')->              
  click('lista clienti')->
  click('01 Azienda')->
  click('1')->
  click('modifica', array(), array('position' => 2))->        
  with('response')->begin()->
    checkElement('#id_tema_fattura option[selected]', 'ideato srl')->
  end();
        
$browser->         
  info('new invoices for customer must have new theme')->     
  click('lista clienti')->
  click('01 Azienda')->    
  click('nuova fattura')->        
  followRedirect()->        
  with('response')->begin()->
    checkElement('div.title h2', '/Fattura n. 2/')->
  end()->      
  click('modifica', array(), array('position' => 2))->        
  with('response')->begin()->
    checkElement('#id_tema_fattura option[selected]', 'ideato rimessa')->
  end()->
  click('Salva e vai ai dettagli')->           
  followRedirect();
        
$browser->        
  info('other customers themes are untouched')->     
  click('lista clienti')->
  click('02 Azienda')->    
  click('modifica', array(), array('position' => 2))->        
  with('response')->begin()->
    checkElement('#contatto_id_tema_fattura option[selected]', 'ideato srl')->
  end();
