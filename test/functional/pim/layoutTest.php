<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new bfTestFunctional(new sfBrowser());
$browser->loadData(sfConfig::get('sf_test_dir').'/fixtures/fixtures.yml');

$browser->
  get('/')->
  with('response')->begin()->
    checkElement('title', 'Billify - simplify your business management')->
    checkElement('#main')->
    checkElement('#main #header')->
    checkElement('#main #header h1#logo')->
    checkElement('#main #header h1#logo a[title="[vai alla homepage]"]')->
    checkElement('#main #header h1#logo a[title="[vai alla homepage]"] img[src~="logo.gif"]')->
    checkElement('#main #header div#nav', false)->
    checkElement('#main #header div#tray')->
    checkElement('#main #header div#tray ul', false)->
    checkElement('#main #footer p', 2)->
    checkElement('#main #footer p.f-right')->
  end()->
  login()->
  with('response')->begin()->
    checkElement('#main #header div#nav a', 4)->
    checkElement('#main #header div#nav a#nav-active', '/benvenuto User User/')->
    checkElement('#main #header div#nav a', 'profilo', array('position' => 1))->
    checkElement('#main #header div#nav a', 'impostazioni', array('position' => 2))->
    checkElement('#main #header div#nav a', 'esci', array('position' => 3))->
    checkElement('#main div#tray ul')->
    checkElement('#main div#tray ul li', 4)->
    checkElement('#main div#tray ul li#tray-active', 'bacheca')->
    checkElement('#main div#tray ul li', 'rubrica', array('position' => 1))->
    checkElement('#main div#tray ul li', 'fatture', array('position' => 2))->
    checkElement('#main div#tray ul li', 'cash flow', array('position' => 3))->
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
    checkElement('ul li:contains("statistiche")')->

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
  click('cash flow')->
  with('request')->begin()->
    isParameter('module', 'cashflow')->
    isParameter('action', 'index')->
  end()
;