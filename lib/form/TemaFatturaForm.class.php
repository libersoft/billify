<?php

/**
 * TemaFattura form.
 *
 * @package    form
 * @subpackage tema_fattura
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class TemaFatturaForm extends BaseTemaFatturaForm
{
  public function configure()
  {
    parent::configure();
  
    $widgets = $this->getWidgetSchema();
  
    $widgets['logo'] = new sfWidgetFormInputFileEditable(array('edit_mode'=>true,'with_delete' => false, 'is_image' => !$this->isNew, 'file_src' => '/uploads/logos/'.$this->getObject()->getLogo(), 'template'  => ' %input%%file%'));
    
    $this->widgetSchema->setLabel('template', 'Modello fattura');
    $this->widgetSchema->setLabel('css', 'Stile fattura');
    
    $this->widgetSchema->moveField('logo', sfWidgetFormSchema::AFTER, 'nome');
    
    $validators = $this->getValidatorSchema();
    
    $validators['nome']->setOptions(array('required' => true));
    $validators['nome']->setMessages(array('required' => 'Il nome non pu&ograve; essere vuoto'));
    $validators['template']->setOptions(array('required' => true));
    $validators['template']->setMessages(array('required' => 'L\'header non pu&ograve; essere vuoto'));
    $validators['css']->setOptions(array('required' => true));
    $validators['css']->setMessages(array('required' => 'Il css non pu&ograve; essere vuoto'));
    $validators['logo'] = new sfValidatorFile(
      array(
        'mime_types' => array('image/jpeg'), 
        'max_size' => '512000', 
        'required' => true, 
        'path' => sfConfig::get('sf_upload_dir').'/logos'
      ));
    
    $validators['logo']->setMessages(array('mime_types' => 'Sono ammesse solo immagini di tipo JPEG', 'max_size' => 'La dimensione massima &egrave; 512Kb', 'required' => 'Il logo è necessario'));
    
    unset(
      $this['id_utente']
      );
  }
}
