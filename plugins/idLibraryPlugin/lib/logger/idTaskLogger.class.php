<?php

/**
 * Class idTaskLogger
 *
 * @author Francesco (cphp) Trucchia <ft@ideato.it>
 * @version 0.1
 * @package ideato.lib
 * @subpackage logger
 * 
 */
Class idTaskLogger extends sfLogger{
  
  private $task;
  
  public function __construct(sfEventDispatcher $dispatcher, sfBaseTask $task, $options = array()){
  
    parent::__construct($dispatcher, $options);  
    $this->task = $task;
  }
  
  public function doLog($message, $priority){
    $this->log($message, $priority);
  }
  
  public function log($message, $priority = self::INFO){
    $this->task->logSection('debug', $message, 10000);
  }
  
}

?>