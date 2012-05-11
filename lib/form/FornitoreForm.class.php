<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FornitoreFormclass
 *
 * @author cphp
 */
class FornitoreForm extends ContattoForm{
  
  protected static $choices = array('s' => 'Si', 'n' => 'No');
  
  public function configure()
  {
    parent::configure();

    $widgets = $this->getWidgetSchema();
    $widgets['class_key'] = new sfWidgetFormInputHidden();
    $widgets['azienda'] = new sfWidgetFormSelectRadio(array('choices' => self::$choices));
    
    $this->setDefault('class_key', ContattoPeer::CLASSKEY_FORNITORE);
    $this->widgetSchema->setLabel('email', 'E-Mail');
    $this->widgetSchema->setLabel('citta', 'Città');
    $this->widgetSchema->setLabel('piva', 'P.Iva');
    $this->widgetSchema->setLabel('cap', 'C.A.P.');
    $this->widgetSchema->setLabel('modo_pagamento_id', 'Modo pagamento');
    
    $this->validatorSchema['ragione_sociale']->setOption('required', true);

    unset(
      $this['id_utente'],
      $this['id_tema_fattura'],
      $this['stato'],
      $this['id_banca'],
      $this['calcola_ritenuta_acconto'],
      $this['includi_tasse'],
      $this['calcola_tasse'],
      $this['cod'],
      $this['nome'],
      $this['cognome']
    );
  }

  public function getRoute() {
    return '@provider';
  }
}
?>
