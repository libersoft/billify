<?php
require_once(dirname(__FILE__).'/../bootstrap/unit.php');
require_once(dirname(__FILE__).'/../../plugins/idLibrary/lib/adapter/BrowserAdapter.abstract.php');
require_once(dirname(__FILE__).'/../../plugins/idLibrary/lib/adapter/FirefoxAdapter.class.php');


$t = new lime_test(7, new lime_output_color());
$t->comment('->construct()');

$browser = new FirefoxAdapter();
$t->is($browser instanceof BrowserAdapter, true, '->construct() returns object that extends BrowserAdapter');
$t->isa_ok($browser, 'FirefoxAdapter', '->construct() returns instance of FirefoxAdapter');

$t->comment('->getContent()');
$content = '<html></head><title>Test</title></head><body>Prova</body></html>';
$browser->setContent($content);
$t->is($browser->getContent(), $content, '->getContent() returns right content');

$t->comment('->getUrl()');
$t->is($browser->getUrl(), null, '->getUrl() returns right value');
$browser->setUrl('file:///tmp/test.html');
$t->is($browser->getUrl(), 'file:///tmp/test.html', '->getUrl() returns right value');

$t->comment('->open()');
$t->isa_ok($browser->open(), true, '->open() opens firefox right');
$t->isa_ok($browser->getUrl(), 'string', '->getUrl() returns right value');