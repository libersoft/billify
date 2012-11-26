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
    $this->widgetSchema['cliente_id'] = new sfWidgetFormInput();
    $this->widgetSchema['data'] = new sfWidgetFormFilterDate(
      array('template'    => 'da %from_date%<br/> a %to_date%',
            'from_date'   => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true, 'culture' => 'it')),
            'to_date'     => new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true, 'culture' => 'it')),
            'with_empty'  => false));

    $this->widgetSchema['stato'] = new sfWidgetFormChoice(array('choices' => $this->choices));
    $this->widgetSchema['categoria_id'] = new sfWidgetFormPropelChoice(array('model' => 'Categoria', 'add_empty' => true));


    $this->validatorSchema['cliente_id'] = new sfValidatorPass(array('required' => false));
    $this->validatorSchema['data'] = new sfValidatorDateRange(
            array('required'  => false,
                  'from_date' => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')),
                  'to_date'   => new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'))));

    $this->validatorSchema['categoria_id'] = new sfValidatorPropelChoice(array('required' => false, 'model' => 'Categoria', 'column' => 'id'));
  }

  public function addStatoColumnCriteria(Criteria $criteria, $field, $value)
  {
    if ('' == $value)
    {
      return;
    }

    $criteria->add(FatturaPeer::STATO, $value);
  }

  public function addClienteIdColumnCriteria(Criteria $criteria, $field, $value)
  {
    $criteria->addJoin(FatturaPeer::CLIENTE_ID, ClientePeer::ID);
    $criteria->add(ClientePeer::RAGIONE_SOCIALE, "%$value%", Criteria::LIKE);
  }
  
  public function getDefaultFilter($from_date = null, $to_date = null)
  {
    if (null === $from_date)
    {
      $from_date = '01/01/'.date('Y');
    }

    if (null === $to_date)
    {
      $to_date = '31/12/'.date('Y');
    }

    $default_filter=array();
    $default_filter['data']['from'] = $from_date;
    $default_filter['data']['to']   = $to_date;
    $default_filter['stato']        = '';
    
    return $default_filter;
  }

  protected function doBuildCriteria(array $values)
  {
    $criteria = $this->getNewCriteria();

    $peer = constant($this->getModelName().'::PEER');

    $fields = $this->getFields();

    // add those fields that are not represented in getFields() with a null type
    $names = array_merge($fields, array_diff(array_keys($this->validatorSchema->getFields()), array_keys($fields)));
    $fields = array_merge($fields, array_combine($names, array_fill(0, count($names), null)));

    foreach ($fields as $field => $type)
    {
      if (!isset($values[$field]) || null === $values[$field] || '' === $values[$field])
      {
        continue;
      }

      try
      {
        $method = sprintf('add%sColumnCriteria', call_user_func(array($peer, 'translateFieldName'), $field, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_PHPNAME));
      }
      catch (Exception $e)
      {
        // not a "real" column
        if (!method_exists($this, $method = sprintf('add%sColumnCriteria', self::camelize($field))))
        {
          throw new LogicException(sprintf('You must define a "%s" method to be able to filter with the "%s" field.', $method, $field));
        }
      }

      if (method_exists($this, $method))
      {
        $this->$method($criteria, $field, $values[$field]);
      }
      else
      {
        if (!method_exists($this, $method = sprintf('add%sCriteria', $type)))
        {
          throw new LogicException(sprintf('Unable to filter for the "%s" type.', $type));
        }

        $this->$method($criteria, $field, $values[$field]);
      }
    }

    return $criteria;
  }
}
