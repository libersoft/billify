<?php

class Graph
{
  private $title;
  private $values;
  
  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function addXAxisValue($value)
  {
    $this->values[] = $value;
  }

  public function setXAxisValues($value)
  {
    $this->values = $value;
  }

  public function getXAxisValue($position)
  {
    return $this->values[$position];
  }

  public function getXAxisValues()
  {
    return $this->values;
  }

  public function addSerie($serie)
  {
    $this->series[] = $serie;
  }

  /**
   * Return GraphSerie
   * 
   * @param integet $position
   * @return GraphSerie
   */
  public function getSerie($position)
  {
    return $this->series[$position];
  }

  public function getSeries()
  {
    return $this->series;
  }
}
