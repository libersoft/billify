<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData();

$browser->
  get('/')->
  with('response')->begin()->
    checkElement('title', 'Billify - simplify your business management')->
    checkElement('#main')->
    checkElement('div.topbar h3 a', '/Billify/')->
    checkElement('#main #footer p', 1)->
  end()->
  login()->
  with('response')->begin()->
	checkElement('div.topbar h3 a', '/Billify/')->
    checkElement('div.topbar ul.nav li.active', 1)->
    checkElement('div.topbar ul.nav li.dropdown', 4)->
	checkElement('div.topbar ul.secondary-nav', 1)->
	checkElement('div.topbar ul.secondary-nav', '/benvenuto User User/')->
    checkElement('div.topbar ul.secondary-nav li.dropdown li', '/profilo/', array('position' => 0))->
    checkElement('div.topbar ul.secondary-nav li.dropdown li', '/impostazioni/', array('position' => 1))->
    checkElement('div.topbar ul.secondary-nav li.dropdown li', '/esci/', array('position' => 2))->
    checkElement('div.topbar ul.nav li.active', 'bacheca')->
    checkElement('ul.nav li', '/rubrica/', array('position' => 1))->
    checkElement('ul.nav li.dropdown', '/fatture/', array('position' => 1))->
    checkElement('ul.nav li.dropdown', '/cash flow/', array('position' => 2))->
    checkElement('#main div#breadcrumps')->
    checkElement('#main div#cols2')->
    checkElement('#main div#cols2 #col-right')->
    checkElement('#main div#cols2 #col-left')->

    checkElement('#main div#cols2 #col-left div.title h2', 'fatture da inviare')->
    checkElement('#main div#cols2 #col-left div.title h2', 'fatture da incassare', array('position' => 1))->

    checkElement('h4:contains("rubrica clienti")')->
    checkElement('ul li:contains("lista clienti")')->
    checkElement('ul li:contains("aggiungi un nuovo cliente")')->

    checkElement('h4:contains("rubrica fornitori")')->
    checkElement('ul li:contains("lista fornitori")')->
    checkElement('ul li:contains("aggiungi un nuovo fornitore")')->

    checkElement('h4:contains("fatture di vendita")')->
    checkElement('ul li:contains("lista fatture di vendita")')->
    checkElement('ul li:contains("aggiungi una nuova fattura di vendita")')->

    checkElement('h4:contains("fatture d\'acquisto")')->
    checkElement('ul li:contains("lista fatture d\'acquisto")')->
    checkElement('ul li:contains("aggiungi una nuova fattura d\'acquisto")')->

    checkElement('h4:contains("cash flow")')->
    checkElement('ul li:contains("cash flow")')->
    checkElement('ul li:contains("aggiungi una nuova entrata")')->
    checkElement('ul li:contains("aggiungi una nuova uscita")')->

  end()->
  click('lista clienti')->
  with('request')->begin()->
    isParameter('module', 'contact')->
    isParameter('action', 'index')->
  end()->
  back()->
  click('lista fornitori')->
  with('request')->begin()->
    isParameter('module', 'contact')->
    isParameter('action', 'index')->
  end()->
  back()->
  click('lista fatture di vendita')->
  with('request')->begin()->
    isParameter('module', 'invoice')->
    isParameter('action', 'indexSale')->
  end()->
  back()->
  click('lista fatture d\'acquisto')->
  with('request')->begin()->
    isParameter('module', 'invoice')->
    isParameter('action', 'indexPurchase')->
  end()->
  back()->
  click('cash flow', array(), array('position' => 2))->
  with('request')->begin()->
    isParameter('module', 'cashflow')->
    isParameter('action', 'index')->
  end()
;
