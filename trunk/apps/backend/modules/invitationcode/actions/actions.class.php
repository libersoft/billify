<?php

/**
 * invitationcode actions.
 *
 * @package    sf_sandbox
 * @subpackage invitationcode
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class invitationcodeActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeMake()
  {
  	$codiceInvito = new InvitationCode();
  	$codiceInvito->setCodice(Utente::generatePassword(10));
  	$codiceInvito->save();

  	$this->redirect('utente/list');
  }

  public function executeDelete(){
  	$codice = InvitationCodePeer::retrieveByPK($this->getRequestParameter('id'));
  	$this->forward404Unless($codice instanceof InvitationCode );
  	$codice->delete();


  	$this->redirect('utente/list');
  }

  public function executeSend(){
  	$codice = InvitationCodePeer::retrieveByPK($this->getRequestParameter('id'));
  	$this->forward404Unless($codice instanceof InvitationCode );

  	$codice->setEmail($this->getRequestParameter('email'));
  	$codice->setInviato('s');
  	$codice->save();

		$mail = new sfMail();
		$mail->initialize();
		$mail->setMailer('sendmail');
		$mail->setCharset('utf-8');

		// definition of the required parameters
		$mail->setSender('francesco@ideato.info', 'PIM On-Line');
		$mail->setFrom('francesco@ideato.info', 'PIM On-Line');

		$mail->addAddress($this->getRequestParameter('email'));

		$mail->setSubject('Richiesta codice d\'invito per PIM On-line ');
		$mail->setBody('Gentile utente,

ecco il codice d\' invito da lei richiesto, CODICE INVITO: '.$codice->getCodice().'

Ora puo\' registrarsi al servizio web PIM On-Line (http://account.ideato.info)

Cordiali Saluti

Lo Staff di PIM On-Line
--
AutoMailer PIM On-Line Invitation Code');

  	// send the email
  	$mail->send();
  	$this->forward('utente','list');
	}
}
