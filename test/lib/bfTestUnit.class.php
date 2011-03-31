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

  public function loadData()
  {
    $data = new sfPropelData();
    $data->loadData(sfConfig::get('sf_test_dir').'/fixtures/fixtures.yml');
  }

  public function signin($username)
  {
    $criteria = new Criteria();
    $criteria->add(UtentePeer::USERNAME , $username);
    $user = UtentePeer::doSelectOne($criteria);

    $this->context->getUser()->signin($user);
  }

  public function getContext()
  {
    return $this->context;
  }
}

