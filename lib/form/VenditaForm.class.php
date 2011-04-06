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
  
  static $calcola_ritenuta_acconto = array(
                                            'a' => 'Auto',
                                            's' =>  'Si', 
                                            'n' =>  'No'
      );
  static $si_no = array(
                        's' =>  'Si', 
                        'n' =>  'No'
      );
  
  public function configure()
  {
    parent::configure();
    
    
    $widgets = $this->getWidgetSchema();
    $widgets['class_key'] = new sfWidgetFormInputHidden();

    $this->setDefault('class_key', FatturaPeer::CLASSKEY_VENDITA);
    
    $this->widgetSchema->setNameFormat('%s');
    
    $this->widgetSchema['num_fattura'] = new sfWidgetFormInput();
    $this->widgetSchema['modo_pagamento_id'] = new sfWidgetFormPropelChoice(array('model' => 'ModoPagamento', 'add_empty' => false));
    
    $criteria = new Criteria();
    $criteria->add(CodiceIvaPeer::ID_UTENTE, $this->getOption('user')->getId());
    
    $this->widgetSchema['vat'] = new sfWidgetFormPropelChoice(array('model' => 'CodiceIva', 'add_empty' => false, 'criteria' => $criteria, 'key_method' => 'getValore'));
    $this->widgetSchema['calcola_ritenuta_acconto'] = new sfWidgetFormChoice(array('choices' => self::$calcola_ritenuta_acconto));
    $this->widgetSchema['calcola_tasse'] = new sfWidgetFormChoice(array('choices' => self::$si_no));
    $this->widgetSchema['includi_tasse'] = new sfWidgetFormChoice(array('choices' => self::$si_no));
    
    $this->widgetSchema['data'] = new sfWidgetFormJQueryDate();
    $this->widgetSchema['proforma'] = new sfWidgetFormChoice(array('choices' => array('y' => 'proforma'), 'expanded' => true, 'multiple' => true));
    $this->validatorSchema['proforma'] = new sfValidatorChoice(array('choices' => array('y')));
    $this->validatorSchema['calcola_ritenuta_tasse'] = new sfValidatorChoice(array('choices' => array_keys(self::$calcola_ritenuta_acconto)));
    $this->validatorSchema['calcola_tasse'] = new sfValidatorChoice(array('choices' => array_keys(self::$si_no)));
    $this->validatorSchema['includi_tasse'] = new sfValidatorChoice(array('choices' => array_keys(self::$si_no)));
    
        $this->useFields(array(
                            'id_utente',
                            'num_fattura',
                            'cliente_id',
                            'data',
                            'modo_pagamento_id',
                            'sconto',
                            'vat',
                            'spese_anticipate',
                            'calcola_ritenuta_acconto',
                            'calcola_tasse',
                            'includi_tasse',
                            'proforma',
                            'note'
                  )
            );

  }

  public function getModelName()
  {
    return 'Vendita';
  }
}
