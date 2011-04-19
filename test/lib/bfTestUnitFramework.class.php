<?php

class bfTestUnitFramework extends lime_test
{
  protected $plan;

  public function  __construct()
  {
    parent::__construct($this->plan, new lime_output_color());
  }

  public function setUp()
  {

  }

  public function tearDown()
  {

  }
  
  public function run()
  {
    $reflection_class = new ReflectionClass(get_class($this));

    foreach($reflection_class->getMethods() as $method)
    {
      if (0 === strpos($method->name, 'test') && 'test_is_deeply' != $method->name)
      {
        $this->setUp();
        call_user_func_array(array($this, $method->name), array());
        $this->tearDown();
      }
    }
  }
}
