<?php

Class paTestFunctional extends sfTestFunctional
{
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
      $fixture = sfConfig::get('sf_test_dir').'/fixtures';
    }
    
    $loader = new sfPropelData();
    $loader->loadData($fixture);
 
    return $this;

  }
}