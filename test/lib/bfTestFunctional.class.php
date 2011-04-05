<?php

Class bfTestFunctional extends sfTestFunctional
{
  /**
   * @var sfPropelData
   */
  private $loader;

  public function  __construct(sfBrowserBase $browser, lime_test $lime = null, $testers = array())
  {
    parent::__construct($browser, $lime, $testers);
    $this->loader = new sfPropelData();
  }

  public function login($username = 'user', $password = 'user')
  {
    $this->get('/')->
                setField('login', $username)->
                setField('password', $password)->
                click('Entra')->
                followRedirect();
     return $this;
  }
  
  public function loadData($fixture = null)
  {
    
    if(is_null($fixture))
    {
      $fixture = sfConfig::get('sf_test_dir').'/fixtures/companies';
    }
    
    $this->loader->loadData($fixture);
 
    return $this;
  }

  /**
   * Return the loader
   * 
   * @return sfPropelData
   */
  public function getLoader()
  {
    return $this->loader;
  }
}