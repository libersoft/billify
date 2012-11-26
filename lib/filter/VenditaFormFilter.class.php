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
    $this->choices += VenditaForm::$states;

    parent::configure();
 
    $this->widgetSchema['num_fattura'] = new sfWidgetFormChoice(array('choices' => array('' => '', 1 => 'Regolare', 2 => 'Pro-Forma')));

    $this->widgetSchema->setLabel('num_fattura', 'Tipo');

    $this->useFields(array('data', 'stato', 'num_fattura', 'cliente_id', 'categoria_id'));
    $this->widgetSchema->setPositions(array('data', 'cliente_id', 'stato', 'num_fattura', 'categoria_id'));
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

  public function getRoute()
  {
    return '@invoice';
  }

  protected function getNewCriteria()
  {
    return new Criteria();
  }
}
