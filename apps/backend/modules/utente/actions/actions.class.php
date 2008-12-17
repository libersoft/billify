<?php

/**
 * utente actions.
 *
 * @package    sf_sandbox
 * @subpackage utente
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */
class utenteActions extends autoutenteActions
{
	public function executeChangeStato(){
		$utente = UtentePeer::retrieveByPK($this->getRequestParameter('id'));
		$this->forward404Unless($utente instanceof Utente);
		
		if($utente->getStato() == 'attivo')
			$utente->setStato('disattivo');
		else 
			$utente->setStato('attivo');
			
		$utente->save();
			
		$this->redirect('utente/list');
	}
	
	public function executeSconto(){
		$utente = UtentePeer::retrieveByPK($this->getRequestParameter('id'));
		$this->forward404Unless($utente instanceof Utente);
		
		if($utente->getSconto() == 0)
			$utente->setSconto(1);
		else 
			$utente->setSconto(0);
			
		$utente->save();
			
		$this->redirect('utente/list');
	}
	
	public function executeUpgradeUtente(){
		$utente = UtentePeer::retrieveByPK($this->getRequestParameter('id'));
		$this->forward404Unless($utente instanceof Utente);
		
		if($utente->getTipo() == Utente::DEMO )
			$utente->setTipo(Utente::BASE);
		elseif ($utente->getTipo() == Utente::BASE)
			$utente->setTipo(Utente::PRO);
		else
			$utente->setTipo(Utente::DEMO);
			
		$utente->save();
			
		$this->redirect('utente/list');
	}
	
	public function executeSendUpgradeMail(){
		$criteria = new Criteria();
		$criteria->add(UtentePeer::ID , $this->getRequestParameter('id'));

		$utente = UtentePeer::doSelectOne($criteria);
		
		$mail = new sfMail();
		$mail->initialize();
		$mail->setMailer('sendmail');
		$mail->setCharset('utf-');

		// definition of the required parameters
		$mail->setSender('info@personal-invoice-manager.net', 'PIM On-Line');
		$mail->setFrom('info@personal-invoice-manager.net', 'PIM On-Line');

		$mail->addAddress($utente->getEmail());

		$mail->setSubject('[PIM On-line] Acquisto del servizio '.strtoupper($utente->getTipo()));
		$mail->setBody('Gentile '.$utente->getNome().' '.$utente->getCognome().',
 
l\'acquisto del servizio e\' avvenuto con successo. Ora puo\' usufruire di tutti i servizi PIM On-line. 

Le ricordiamo che la validita\' dell\'iscrizione e\' mensile e la data di scadenza e\' il '.$utente->getDataScadenza().'.
Quando il contratto sara\' scaduto lei potra\' decidere di rinnovare il contratto o di sospenderlo attraverso il servizio offerto da PayPal (http://www.paypal.it).
  		
Deve uscire e reintrare dal servizio per terminare l\'aggiornamento del suo profilo.
 	
Cordiali Saluti
  	
Lo Staff di PIM On-Line
--
AutoMailer PIM On-Line Profile Upgrade');

  	// send the email
  	$mail->send();
  	$this->forward('utente','list');
	}
	
}
