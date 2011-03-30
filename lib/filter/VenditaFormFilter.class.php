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

    $this->widgetSchema['cliente_id'] = new sfWidgetFormInput();
    $this->widgetSchema['stato'] = new sfWidgetFormChoice(array('choices' => $choices));
    $this->widgetSchema['num_fattura'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Regolare', 2 => 'Pro-Forma')));

    $this->widgetSchema->setLabel('num_fattura', 'Tipo');

    $this->validatorSchema['cliente_id'] = new sfValidatorPass(array('required' => false));

    $this->useFields(array('data', 'stato', 'num_fattura', 'cliente_id'));
    $this->widgetSchema->setPositions(array('data', 'cliente_id', 'stato', 'num_fattura'));
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

  public function addNumFatturaColumnCriteria(Criteria $criteria, $field, $value)
  {
    switch($value)
    {
      case 2:
        $criteria->add(FatturaPeer::NUM_FATTURA, 0, Criteria::EQUAL);
        break;
      case 1:
        $criteria->add(FatturaPeer::NUM_FATTURA, 0, Criteria::GREATER_THAN);
        break;
    }
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
