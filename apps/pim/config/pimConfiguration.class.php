<?php

class pimConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
    ini_set('include_path', ini_get('include_path').':'.sfConfig::get('sf_plugins_dir').'/idLibrary/lib:'.sfConfig::get('sf_plugins_dir').'/idLibrary/lib/helper:'.sfConfig::get('sf_plugins_dir').'/idLibrary/lib/test:');
  }
}
