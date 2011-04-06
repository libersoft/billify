<?php

/**
 * Fattura filter form.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class AcquistoFormFilter extends FatturaFormFilter
{
  public function configure()
  {
    $this->choices += AcquistoForm::$states;

    parent::configure();
    
    $this->useFields(array('data', 'stato', 'categoria_id'));

    $criteria = new Criteria;
    $criteria->addAscendingOrderByColumn(CategoriaPeer::NOME);
    $this->widgetSchema['categoria_id']->setOption('criteria', $criteria);
  }

  public function getRoute()
  {
    return '@invoice_purchase';
  }
}
