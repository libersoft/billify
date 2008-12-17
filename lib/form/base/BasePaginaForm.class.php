<?php

/**
 * Pagina form base class.
 *
 * @package    form
 * @subpackage pagina
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 8807 2008-05-06 14:12:28Z fabien $
 */
class BasePaginaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'titolo' => new sfWidgetFormInput(),
      'corpo'  => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorPropelChoice(array('model' => 'Pagina', 'column' => 'id', 'required' => false)),
      'titolo' => new sfValidatorString(array('max_length' => 255)),
      'corpo'  => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('pagina[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pagina';
  }


}
