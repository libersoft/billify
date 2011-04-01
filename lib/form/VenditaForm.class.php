<?php

/**
 * Vendita form.
 *
 * @package    form
 * @subpackage fattura
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class VenditaForm extends FatturaForm
{
  static $states = array(
      Vendita::NON_PAGATA => 'non inviata',
      Vendita::INVIATA => 'inviata',
      Vendita::PAGATA => 'pagata',
      Vendita::RIFIUTATA => 'rifiutata',
  );
  
  public function configure()
  {
    parent::configure();
    
    $widgets = $this->getWidgetSchema();
    $widgets['class_key'] = new sfWidgetFormInputHidden();

    $this->setDefault('class_key', FatturaPeer::CLASSKEY_VENDITA);
  }

  public function getModelName()
  {
    return 'Vendita';
  }
}
