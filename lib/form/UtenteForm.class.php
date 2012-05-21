<?php

/**
 * Utente form.
 *
 * @package    form
 * @subpackage utente
 * @version    SVN: $Id: sfPropelFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class UtenteForm extends BaseUtenteForm
{
  public function configure()
  {
    parent::configure();
    
    $widgets = $this->getWidgetSchema();
    
    $widgets['password'] = new sfWidgetFormInputPassword();
    $widgets['verifica_password'] = new sfWidgetFormInputPassword();
    
    $this->widgetSchema->setLabel('nome', 'Nome*');
    $this->widgetSchema->setLabel('cognome', 'Cognome*');
    $this->widgetSchema->setLabel('email', 'Email*');
    $this->widgetSchema->setLabel('password', 'Password*');
    $this->widgetSchema->setLabel('verifica_password', 'Verifica Password*');
    
    $validators = $this->getValidatorSchema();
    
    $validators['nome']->setOptions(array('required' => true));
    $validators['nome']->setMessages(array('required' => 'Il nome non pu&ograve; essere vuoto'));
    $validators['cognome']->setOptions(array('required' => true));
    $validators['cognome']->setMessages(array('required' => 'Il cognome non pu&ograve; essere vuoto'));
    $validators['partita_iva']->setOptions(array('min_length' => 11, 'max_length' => 11));
    $validators['partita_iva']->setMessages(array('invalid' => 'Partita iva non valida.'));
    $validators['codice_fiscale']->setOptions(array('min_length' => 11, 'max_length' => 11));
    $validators['codice_fiscale']->setMessages(array('invalid' => 'Codice fiscale non valido.'));
    $validators['email'] = new sfValidatorEmail();
    $validators['email']->setMessages(array('invalid' => 'E-mail non valida'));
    $validators['check_password'] = new sfValidatorSchemaCompare('password', '==', 'verifica_password');
    $validators['check_password']->setMessages(array('invalid' => 'La verifica della password non corrisponde, inserisci di nuovo la password.'));
    
    unset(
      $this['username'],
      $this['id_invitation_code'],
      $this['data_attivazione'],
      $this['data_rinnovo'],
      $this['tipo'],
      $this['stato'],
      $this['fattura'],
      $this['lastlogin'],
      $this['approva_contratto'],
      $this['approva_policy'],
      $this['sconto']
    );
  }
}
