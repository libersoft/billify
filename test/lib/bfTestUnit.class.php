<?php

class bfTestUnit extends lime_test
{
  private $context;
  private $configuration;

  public function  __construct($plan = null, $options = array())
  {
    parent::__construct($plan, $options);
    $this->configuration = ProjectConfiguration::getApplicationConfiguration('pim', 'test', true);
    $this->context = sfContext::createInstance($this->configuration);
  }

  public function loadData($file = null)
  {
    if(!$file)
    {
      $file = sfConfig::get('sf_test_dir').'/fixtures/companies/srl.yml';
    }

    $data = new sfPropelData();
    $data->loadData($file);
  }

  public function signin($username)
  {
    $criteria = new Criteria();
    $criteria->add(UtentePeer::USERNAME , $username);
    $user = UtentePeer::doSelectOne($criteria);

    if (!$user)
    {
      throw new Exception('User '.$username.' does not exists');
    }
    
    $this->context->getUser()->signin($user);

    FatturaPeer::$user_id = $user->getId();

    return $user;
  }

  public function getContext()
  {
    return $this->context;
  }
}

