<?php

/**
 * Impostazione form.
 *
 * @package    form
 * @subpackage impostazione
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ImpostazioneForm extends BaseImpostazioneForm
{
  protected static $tipo_ritenuta_choiches = array('credito'=>'credito','debito'=>'debito'); 
  protected static $choices = array('s' => 'Si', 'n' => 'No');
    
  public function configure()
  {
      parent::configure();
  
      $widgets = $this->getWidgetSchema();
      
      $widgets['invoice_decorator_type'] = new sfWidgetFormSelect(array('choices' => ImpostazionePeer::$available_decorator_classes_text));
      $widgets['consegna_commercialista'] = new sfWidgetFormChoice(array('choices' => self::$choices));
      $widgets['fattura_automatica'] = new sfWidgetFormChoice(array('choices' => self::$choices));
      $widgets['tipo_ritenuta'] = new sfWidgetFormSelect(array('choices' => self::$tipo_ritenuta_choiches));
      
      $this->widgetSchema->setLabel('invoice_decorator_type', 'Tipo Numero Fattura');

      $validators = $this->getValidatorSchema();
      
      $validators['num_clienti'] = new sfValidatorNumber(array('required' => true, 'min' => 1));
      $validators['num_clienti']->setMessages(array('required' => 'Il num clienti non pu&ograve; essere vuoto', 'min' => 'Il valore minimo deve essere 1'));
      $validators['num_fatture'] = new sfValidatorNumber(array('required' => true, 'min' => 1));
      $validators['num_fatture']->setMessages(array('required' => 'Il num fatture non pu&ograve; essere vuoto', 'min' => 'Il valore minimo deve essere 1'));
      $validators['righe_dettagli'] = new sfValidatorNumber(array('required' => true, 'min' => 1));
      $validators['righe_dettagli']->setMessages(array('required' => 'Le righe dettaggli non pu&ograve; essere vuoto', 'min' => 'Il valore minimo deve essere 1'));
      $validators['ritenuta_acconto'] = new sfValidatorNumber(array('required'=> true, 'min' => 0, 'max' => 100));
      $validators['ritenuta_acconto']->setMessages(array('required' => 'La percentuale non pu&ograve; essere vuota', 'min' => 'Il valore minimo deve essere 0', 'max' => 'Il valore massimo deve essere 100'));
     
      unset(
        $this['codice_cliente'],
        $this['deposita_iva'],
        $this['riepilogo_home']
        );
  }
}
