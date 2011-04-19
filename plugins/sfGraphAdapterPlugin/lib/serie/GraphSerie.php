<?php

abstract class GraphSerie
{
  protected $name;
  protected $data = array();

  abstract public function getType();

  public function setName($name)
  {
    $this->name = $name;
  }

  public function getName()
  {
    return $this->name;
  }

  public function addData($data)
  {
    $this->data[] = $data;
  }

  public function setData($data)
  {
    $this->data = $data;
  }
  
  public function getData($position)
  {
    return $this->data[$position];
  }

  public function getAllData()
  {
    return $this->data;
  }
}
