<?php

/**
 * Fattura filter form.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class VenditaFormFilter extends FatturaFormFilter
{
  public function configure()
  {
    $choices = array("" => "");
    $choices += VenditaForm::$states;
    
    $this->widgetSchema['data'] = new sfWidgetFormFilterDate(
      array('template'    => 'da %from_date%<br/> a %to_date%',
            'from_date'   => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
            'to_date'     => new sfWidgetFormDate(array('format' => '%day%/%month%/%year%')),
            'with_empty'  => false));

    $this->widgetSchema['stato'] = new sfWidgetFormChoice(array('choices' => $choices));
    
    $this->useFields(array('data', 'stato')); 
  }

  public function addStatoColumnCriteria(Criteria $criteria, $field, $value)
  {
    if ('' == $value)
    {
      return;
    }
    
    $criteria->add(FatturaPeer::STATO, $value);
  }

  public function getDefaultFilter()
  {
    $default_filter=array();
    $default_filter['data']['from']['day']    = '1';
    $default_filter['data']['from']['month']  = '1';
    $default_filter['data']['from']['year']   = date('Y');
    $default_filter['data']['to']['day']    = '31';
    $default_filter['data']['to']['month']  = '12';
    $default_filter['data']['to']['year']   = date('Y');
    $default_filter['stato']   = '';

    return $default_filter;
  }

  public function getRoute()
  {
    return '@invoice';
  }
}
