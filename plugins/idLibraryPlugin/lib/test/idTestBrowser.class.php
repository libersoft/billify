<?php

/**
 * Class idTestBrowser
 * 
 * @author Francesco (cphp) Trucchia <ft@ideato.it>
 * @version 0.1
 * @package ideato.lib
 * @subpackage test
 *
 */
class idTestBrowser extends sfTestBrowser {

  private $fakepath = '';
  private $data;
  private $project_configuration;
  
  public function __construct(ProjectConfiguration $project_configuration, $hostname = null, $remote = null, $options = array()){
    
    $this->project_configuration = $project_configuration;
    parent::__construct($hostname, $remote, $options);
  }
  
  /**
   * Kill fakemail process
   *
   */
  private function killFakemail()
  {
    # We clean fakemail environment before we go on with testing
    $pid = shell_exec("ps ax | grep fakemail | grep -v grep | awk ' { print $1 } '");

    if ($pid)
      shell_exec("kill -9 ".$pid);
  }

  /**
   * Remove fakemail dir
   *
   */
  private function removeFakemailDir()
  {
    $this->fakepath = dir(sfConfig::get('app_mailer_fakepath'));

    while($entry = $this->fakepath->read())
    {
      if ($entry != "." && $entry != "..")
        @unlink($this->fakepath->path.'/'.$entry);
    }

    @rmdir($this->fakepath->path);

  }

  /**
   * Create fakemail tmp dir
   *
   */
  private function createFakemailDir()
  {
    $fakepath = sfConfig::get('app_mailer_fakepath');

    if (is_dir($fakepath)) {
      $this->removeFakemailDir();
    }

    @mkdir($fakepath);
    $this->fakepath = dir($fakepath);

    $this->fakepath->close();
  }

  /**
   * Start Fakemail
   *
   */
  private function startFakemail()
  {
    $command = $this->project_configuration->getRootDir().'/test/fakemail/fakemail --background';
    $command .= ' --path='.sfConfig::get('app_mailer_fakepath');
    $command .= ' --host=localhost';
    $command .= ' --port='.sfConfig::get('app_mailer_port');

    $this->test()->info($comman);
    shell_exec($command);
  }

  /**
   * Setup fakemail
   *
   */
  public function setup()
  {
    $this->killFakemail();
    $this->createFakemailDir();
    $this->startFakemail();
  }

  /**
   * Tear Down Fakemail
   *
   */
  public function tearDown()
  {
    $this->killFakemail();
    $this->removeFakemailDir();
  }

  /**
   * Initialize test
   *
   * @param string $hostname
   * @param string $remote
   * @param array $options
   */
  public function initialize($hostname = null, $remote = null, $options = array())
  {    
    if(!is_null($remote)) 
    {
      sfConfig::set('sf_factory_controller', 'idTestController');
      sfConfig::set('sf_factory_response', 'idTestResponse');
    }
    
    $load_data_file = sfConfig::get('sf_test_dir').'/fixtures/fixtures.yml';

    if (isset($options['load_data_file'])) {
      $load_data_file = $options['load_data_file'];
    }

    parent::initialize($hostname = null, $remote = null, $options = array());

    $this->data = new sfPropelData();
    $this->data->loadData($load_data_file);

  }

  /**
   * The lillo debug
   *
   * @return unknown
   */
  public function lillo() {
    return $this->debug();
  }

  /**
   * Get the first element of a css selector result
   *
   * @param string $selector
   * @return mixed
   */
  public function getFirstElement($selector) {
    $element = $this->getResponseDomCssSelector()->getElements($selector);
    return $element[0];
  }
  
  /**
   * Get data
   *
   * @return mixed
   */
  public function getData() {
    return $this->data;
  }
  
  /**
   * You can add a comment in test
   *
   * @param string $diag
   * @return this
   */
  public function diag($diag) {
    $this->test()->diag($diag);
    return $this;
  }

  /**
   * Set the dom from content
   *
   * @param string $content
   * @return this
   */
  public function setDom($content) {
    $this->dom = new DomDocument('1.0', sfConfig::get('sf_charset'));
    $this->dom->validateOnParse = true;
    $this->dom->loadHTML($content);
    $this->domCssSelector = new sfDomCssSelector($this->dom);
    
    return $this;
  }
  
  public function openResponseInFirefox($selector = null, $debug = 'lillo') 
  {
    return $this->debug(new FirefoxAdapter, $selector, $debug);
  }
  
  /**
   * Call fail method to remember an action to do
   *
   * @param string $message
   * @return fulloTestBrowser
   */
  public function todo($message)
  {
    $this->test()->fail('TODO: '.$message);
    return $this;
  }
  
  public function debug(BrowserAdapter $browser_adapter = null, $selector = null, $debug_inline = 'lillo')
  {
     if ($selector) {
       $this->outlineNodes($selector);
     }

    if ($browser_adapter) {
      $browser_adapter->setContent($this->dom->saveHTML());
      $browser_adapter->open();
    }

    if ($debug_inline) {
      $this->responseContains($debug_inline);
    }

    return $this;
  }

  private function outlineNodes($selector, $style = 'border: 4px solid red; padding: 4px;') 
  {
    $elements = $this->getResponseDomCssSelector()->matchAll($selector);

    foreach ($elements->getNodes('nodes') as $element) {
      $element->setAttribute('style', $style);
    }
  }
}