<?php

/**
 * Fattura filter form.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
abstract class FatturaFormFilter extends BaseFatturaFormFilter
{
  protected $choices = array("" => "");

  abstract function getRoute();
  
  public function configure()
  {
    $this->widgetSchema['data'] = new sfWidgetFormFilterDate(
      array('template'    => 'da %from_date%<br/> a %to_date%',
            'from_date'   => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true, 'culture' => 'it')),
            'to_date'     => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true, 'culture' => 'it')),
            'with_empty'  => false));

    $this->widgetSchema['stato'] = new sfWidgetFormChoice(array('choices' => $this->choices));

    $this->validatorSchema['data'] = new sfValidatorDateRange(
            array('required'  => false,
                  'from_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')),
                  'to_date'   => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'))));

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
    $default_filter['data']['from'] = '01/01/'.date('Y');
    $default_filter['data']['to']   = '31/12/'.date('Y');
    $default_filter['stato']        = '';

    return $default_filter;
  }
}
