<?php

class bfDateTime
{
  public static function createFromFormat($time)
  {
    if (PHP_VERSION_ID >= 50300)
    {
      $format = 'd/m/Y';
      return DateTime::createFromFormat($format, $time);
    }

    $date = explode('/', $time);

    if (count($date) != 3)
    {
      return false;
    }
    
    list($day, $month, $year) = explode('/', $time);
    return new DateTime(sprintf('%s-%s-%s', $year, $month, $day));
  }
}
