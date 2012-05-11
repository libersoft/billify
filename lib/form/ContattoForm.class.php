<?php

/**
 * Contatto form.
 *
 * @package    form
 * @subpackage contatto
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ContattoForm extends BaseContattoForm
{
  public function configure()
  {
    $this->widgetSchema->setFormFormatterName('table');
    
    // PIVA or CF required
    $required = new sfValidatorOr(
      array(
        new sfValidatorSchemaFilter('piva', new sfValidatorString(array('required' => true))),
        new sfValidatorSchemaFilter('cf', new sfValidatorString(array('required' => true))),
      ),
      array(),
      array('invalid' => 'PIVA or CF required')
    );
    
    // check unicity of PIVA and CF
    $unicity = new sfValidatorAnd(
    array(
      new sfValidatorPropelUniqueContatto(array('model' => 'Contatto', 'column' => array('piva'))), 
      new sfValidatorPropelUniqueContatto(array('model' => 'Contatto', 'column' => array('cd'))),
    ),
    array(),
    array('invalid'=>'existent PIVA / CF')
    );
    
    // full validator
    $this->mergePostValidator(new sfValidatorAnd(
    array(
      $required,
      $unicity,
    ),
    array('halt_on_error' => true),
    array('invalid' => '')
    ));
  }
}
