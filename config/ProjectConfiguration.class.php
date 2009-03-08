<?php
 
require_once '/usr/local/symfony_rep/1.2/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();
 
class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfCompat10Plugin'));
  }
}

