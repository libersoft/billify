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
    $this->widgetSchema['data']->setOption('template', 'da %from_date%<br/> a %to_date%');
    $this->widgetSchema['stato'] = new sfWidgetFormChoice(array('choices' => AcquistoForm::$states));
    
    $this->useFields(array('data', 'stato')); 
  }
}
