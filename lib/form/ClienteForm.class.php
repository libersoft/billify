<?php

/**
 * Cliente form.
 *
 * @package    form
 * @subpackage cliente
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ClienteForm extends ContattoForm
{
  protected static $calcola_ritenuta_choices = array('a' => 'Auto', 's' => 'Si', 'n' => 'No');
  protected static $choices = array('s' => 'Si', 'n' => 'No');
  protected static $culture = 'it';

  public function configure()
  {
    parent::configure();

    $widgets = $this->getWidgetSchema();
    $widgets['class_key'] = new sfWidgetFormInputHidden();
    $widgets['calcola_ritenuta_acconto'] = new sfWidgetFormSelect(array('choices' => self::$calcola_ritenuta_choices));
    $widgets['includi_tasse'] = new sfWidgetFormSelect(array('choices' => self::$choices));
    $widgets['calcola_tasse'] = new sfWidgetFormSelect(array('choices' => self::$choices));
    $widgets['azienda'] = new sfWidgetFormSelectRadio(array('choices' => self::$choices));
    $widgets['nazione'] = new sfWidgetFormI18nSelectCountry(array('culture' => self::$culture));

    $this->setDefault('class_key', ContattoPeer::CLASSKEY_CLIENTE);
    $this->setDefault('azienda', 's');

    $this->widgetSchema->setLabel('email', 'E-Mail');
    $this->widgetSchema->setLabel('citta', 'Città');
    $this->widgetSchema->setLabel('piva', 'P.Iva');
    $this->widgetSchema->setLabel('cap', 'C.A.P.');
    $this->widgetSchema->setLabel('modo_pagamento_id', 'Modo pagamento');
    $this->widgetSchema->setLabel('id_tema_fattura', 'Tema fattura');
    $this->widgetSchema->setLabel('id_banca', 'Banca');

    $this->validatorSchema['ragione_sociale']->setOption('required', true);
    
    //valori di default
		
		$this->setDefault('calcola_tasse', 'n');
				
		$default_tema_fattura = TemaFatturaPeer::retrieveByPk(sfConfig::get('app_contact_default_tema_fattura_id'));
		if($default_tema_fattura != null)
			$this->setDefault('id_tema_fattura', sfConfig::get('app_contact_default_tema_fattura_id'));      
			
		$default_banca = BancaPeer::retrieveByPk(sfConfig::get('app_contact_default_banca_id'));
		if($default_banca != null)
			$this->setDefault('id_banca', sfConfig::get('app_contact_default_banca_id'));		
		                 
    unset(
      $this['id_utente'],
      $this['stato'],
      $this['cod'],
      $this['nome'],
      $this['cognome']      
    );
  }

  public function getRoute() {
    return '@customer';
  }
}
