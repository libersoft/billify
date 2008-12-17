<?php

/**
 * paypal actions.
 *
 * @package    sf_sandbox
 * @subpackage paypal
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 1415 2006-06-11 08:33:51Z fabien $
 */

require("paypal_ipn.php");

class paypalActions extends sfActions
{
  private $receiver_email = 'francesco@cphp.it';
  
  /**
   * Executes index action
   *
   */
  public function executeCancel()
  {
  	
  }
  
  public function executeSuccess()
  {
  	
  }

  public function sendCancelMail($utente){
  	$criteria = new Criteria();

  	$mail = new sfMail();
  	$mail->initialize();
  	$mail->setMailer('sendmail');
  	$mail->setCharset('utf-');

  	// definition of the required parameters
  	$mail->setSender(sfConfig::get('app_admin_from'), sfConfig::get('app_admin_label'));
  	$mail->setFrom(sfConfig::get('app_admin_from'), sfConfig::get('app_admin_label'));

  	$mail->addAddress($utente->getEmail());

  	$mail->setSubject('[PIM On-line] Cancellazione dal sevizio PIM On-line');
  	$mail->setBody('Gentile '.$utente->getNome().' '.$utente->getCognome().',

la cancellazione dal servizio e\' avvenuto con successo. Potra\' continuare ad accedere al suo profilo ma come utente demo.

Se vuole essere cancellato del tutto dal servizio ci contatti all\'indirizzo email info@personal-invoice-manager.net.

Deve uscire e reintrare dal servizio per terminare l\'aggiornamento del suo profilo.

Cordiali Saluti

Lo Staff di PIM On-Line
--
AutoMailer PIM On-Line Profile Upgrade');

  	// send the email
  	$mail->send();
 }
  
  public function sendUpgradeMail($utente){
  	$criteria = new Criteria();
  	//$criteria->add(UtentePeer::ID , $this->getRequestParameter('id'));

  	//$utente = UtentePeer::doSelectOne($criteria);

  	$mail = new sfMail();
  	$mail->initialize();
  	$mail->setMailer('sendmail');
  	$mail->setCharset('utf-');

  	// definition of the required parameters
  	$mail->setSender(sfConfig::get('app_admin_from'), sfConfig::get('app_admin_label'));
  	$mail->setFrom(sfConfig::get('app_admin_from'), sfConfig::get('app_admin_label'));

  	$mail->addAddress($utente->getEmail());

  	$mail->setSubject('[PIM On-line] Iscrizione al servizio '.strtoupper($utente->getTipo()));
  	$mail->setBody('Gentile '.$utente->getNome().' '.$utente->getCognome().',

l\'iscrizione al servizio e\' avvenuto con successo. Ora puo\' usufruire di tutti i servizi PIM On-line.

Le ricordiamo che la validita\' dell\'iscrizione e\' mensile e la data di scadenza e\' il '.$utente->getDataScadenza().'.
Quando il contratto sara\' scaduto lei potra\' decidere di rinnovare il contratto o di sospenderlo attraverso il servizio offerto da PayPal 
(http://www.paypal.it).

Deve uscire e reintrare dal servizio per terminare l\'aggiornamento del suo profilo.

Cordiali Saluti

Lo Staff di PIM On-Line
--
AutoMailer PIM On-Line Profile Upgrade');

  	// send the email
  	$mail->send();
  }

  function executeIpn(){
  	// PayPal will send the information through a POST
  	$paypal_info = $_POST;

  	// To disable https posting to PayPal uncomment the following
  	// $paypal_ipn = new paypal_ipn($paypal_info, "");

  	// Then comment out this one
  	$paypal_ipn = new paypal_ipn($paypal_info);
	$paypal_ipn->setUrlString('www.paypal.com/cgi-bin/webscr?');
	
  	// where to contact us if something goes wrong
  	$paypal_ipn->error_email = sfConfig::get('app_admin_email');

  	// We send an identical response back to PayPal for verification
  	$paypal_ipn->send_response();

  	// PayPal will tell us whether or not this order is valid.
  	// This will prevent people from simply running your order script
  	// manually
	sfContext::getInstance()->getLogger()->err("Inizio Transazione PAYPAL ---");
	sfContext::getInstance()->getLogger()->err("Verifico...");
  	if( !$paypal_ipn->is_verified() )
  	{
  		// bad order, someone must have tried to run this script manually
  		$paypal_ipn->error_out("Ordine non valido (PayPal says it's invalid)");
  	    sfContext::getInstance()->getLogger()->err("Ordine non valido");
  	    sfContext::getInstance()->getLogger()->err("Fine Transazione PAYPAL ---");
		exit();
	}

	if($this->receiver_email != $paypal_ipn->paypal_post_vars['receiver_email']){
		$paypal_ipn->error_out("Receiver email non valida");
  	    sfContext::getInstance()->getLogger()->err("Receiver email non valido");
  	    sfContext::getInstance()->getLogger()->err("Fine Transazione PAYPAL ---");
		exit();
	}
  
  	// Se l'id della transazione esiste giˆ interrompo l'esecuzione dello script
  	// qualcuno sta cercando di usare una transazione giˆ effettuata per pagare
  	$paypal_txn_count = 0;
	sfContext::getInstance()->getLogger()->err("Verifico Transazione");
	if($paypal_ipn->get_txn_id() != ''){
  		$c = new Criteria();
  		$c->add(PaypalPeer::TXN_ID,$paypal_ipn->get_txn_id());
  		$paypal_txn_count = PaypalPeer::doCount($c);
  	}

  	if($paypal_txn_count > 0)
  	{
  		$paypal_ipn->error_out("The TXN ID already exist - TXN ID: ".$paypal_ipn->get_txn_id());
		sfContext::getInstance()->getLogger()->err('Transazione Invalida');
		sfContext::getInstance()->getLogger()->err('Fine Transazione PAYPAL ---');
		exit();
  	}
  	else
  	{
  		sfContext::getInstance()->getLogger()->err("Seleziono utente id ".$paypal_ipn->get_custom()."...");
		$utente = UtentePeer::retrieveByPk($paypal_ipn->get_custom());
		if(!is_object($utente)){
			sfContext::getInstance()->getLogger()->err("Utente non valido");
			sfContext::getInstance()->getLogger()->err("Fine Transazione PAYPAL ---");
			$paypal_ipn->error_out("No User ID");
			exit();
		}
		
		sfContext::getInstance()->getLogger()->err("Utente selezionata: ".$utente->getUsername()." ".$utente->getEmail());
		sfContext::getInstance()->getLogger()->err("Memorizzo la transazione su DB");
		$this->updateTransaction($paypal_ipn);
		sfContext::getInstance()->getLogger()->err("Payment Status: ".$paypal_ipn->paypal_post_vars['payment_status']);
		sfContext::getInstance()->getLogger()->err("Txn Type: ".$paypal_ipn->paypal_post_vars['txn_type']);
  		// payment status
  		switch( $paypal_ipn->get_payment_status() )
  		{
  			case 'Completed':
  				// iscrizione pagata con successo
  				$utente->setStato('attivo');
  				$utente->rinnova();
				sfContext::getInstance()->getLogger()->err("Pagamento Riuscito");
				$paypal_ipn->error_out($utente->getUsername() ." - ".$utente->getEmail().": Payment Success");
  				break;

  			case 'Pending':
  				// money isn't in yet, just quit.
  				// paypal will contact this script again when it's ready
				sfContext::getInstance()->getLogger()->err("Pagamento Pendente");
  				$paypal_ipn->error_out($utente->getUsername() ." - ".$utente->getEmail().": Pending Payment");
  				break;

  			case 'Failed':
  				//Disattivo utente
  				$utente->setStato('disattivo');
				sfContext::getInstance()->getLogger()->err("Pagamento Fallito");
  				$paypal_ipn->error_out($utente->getUsername ." - ".$utente->getEmail.": Failed Payment");
  				break;

  			case 'Denied':
  				//Disattivo utente
  				$utente->setStato('disattivo');
				sfContext::getInstance()->getLogger()->err("Pagamento Negato");
  				$paypal_ipn->error_out($utente->getUsername ." - ".$utente->getEmail.": Denied Payment");
  				break;

  			default:
  				$utente = $this->subscriptionStatus($paypal_ipn, $utente);
  				break;

  		} // end switch
		
  		sfContext::getInstance()->getLogger()->err("Aggiorno i dati dell'utente");
  		$utente->save();

  	}
	
  	sfContext::getInstance()->getLogger()->err("Fine Transazione PAYPAL ---");

  	// If we made it down here, the order is verified and payment is complete.
  	// You could log the order to a MySQL database or do anything else at this point.

  	// Email the information to us
  	/*$date = date("D M j G:i:s T Y", time());

  	$message .= "\n\nThe followwing info was received from PayPal - $date:\n\n";
  	@reset($paypal_info);
  	while( @list($key,$value) = @each($paypal_info) )
  	{
  		$message .= $key . ':' . " \t$value\n";
  	}
  	mail($paypal_ipn->error_email, "[PIM On-line - $date] PayPal Payment Notification", $message);*/
  	return sfView::NONE;
  }
  
  private function subscriptionStatus($paypal_ipn, $utente)
  {
  	sfContext::getInstance()->getLogger()->err("Aggiorno Iscrizione...");
  	sfContext::getInstance()->getLogger()->err("Tipo Utente: ".$utente->getTipo());
  	switch($paypal_ipn->get_txn_type())
  	{
  		case 'subscr_signup':
  			$utente->setTipo('base');
  			$utente->setStato('attivo');
  			$utente->rinnova();
  			$this->sendUpgradeMail($utente);
			sfContext::getInstance()->getLogger()->err("Nuova Iscrizione");
			$paypal_ipn->error_out($utente->getUsername() ." - ".$utente->getEmail().": Subscription Signup");
			break;
  		case 'subscr_cancel':
  			$utente->setTipo('demo');
  			$utente->setDataRinnovo($utente->getDataAttivazione());
  			$this->sendCancelMail($utente);
  			//$utente->setStato('disattivo');
			sfContext::getInstance()->getLogger()->err("Iscrizione cancellata");
  			$paypal_ipn->error_out($utente->getUsername ." - ".$utente->getEmail.": Subscription Cancel");
  			break;
  		case 'subscr_eot':
  			//$utente->setStato('disattivo');
  			// Devo capire come gestire queto end of term
			sfContext::getInstance()->getLogger()->err("Iscrizione EOT");
  			$paypal_ipn->error_out($utente->getUsername ." - ".$utente->getEmail.": Subscription EOT");
  			break;
  		case 'subscr_payment':
  			$utente->setStato('attivo');
			sfContext::getInstance()->getLogger()->err("Iscrizione Pagata");
			$paypal_ipn->error_out($utente->getUsername() ." - ".$utente->getEmail().": Subscription Payment Success");
  			break;
  		default:
			sfContext::getInstance()->getLogger()->err("Niente da aggiornare");
  			$paypal_ipn->error_out($utente->getUsername ." - ".$utente->getEmail.": Error on subscription");
  			break;
  	}

  	return $utente;
  }
  
  private function updateTransaction($paypal_ipn)
  {
  	
  		$paypal = new Paypal();
  		$paypal->setDate(time());
  		if($paypal_ipn->paypal_post_vars['item_name'] != '')
  		$paypal->setItemName($paypal_ipn->paypal_post_vars['item_name']);

  		if($paypal_ipn->paypal_post_vars['item_number'] != '')
  		$paypal->setItemNumber($paypal_ipn->paypal_post_vars['item_number']);

  		if($paypal_ipn->paypal_post_vars['quantity'] != '')
  		$paypal->setQuantity($paypal_ipn->paypal_post_vars['quantity']);

  		if($paypal_ipn->paypal_post_vars['custom'] != '')
  		$paypal->setIdUtente($paypal_ipn->paypal_post_vars['custom']);

  		if($paypal_ipn->paypal_post_vars['payment_status'] != '')
  		$paypal->setPaymentStatus($paypal_ipn->paypal_post_vars['payment_status']);

  		if($paypal_ipn->paypal_post_vars['pending_reason'] != '')
  		$paypal->setPendingReason($paypal_ipn->paypal_post_vars['pending_reason']);

  		if($paypal_ipn->paypal_post_vars['payment_gross'] != '')
  		$paypal->setPaymentGross($paypal_ipn->paypal_post_vars['payment_gross']);

  		if($paypal_ipn->paypal_post_vars['payment_fee'] != '')
  		$paypal->setPaymentFee($paypal_ipn->paypal_post_vars['payment_fee']);

  		if($paypal_ipn->paypal_post_vars['payment_type'] != '')
  		$paypal->setPaymentType($paypal_ipn->paypal_post_vars['payment_type']);

  		if($paypal_ipn->paypal_post_vars['payment_type'] != '')
  		$paypal->setPaymentDate($paypal_ipn->paypal_post_vars['payment_type']);

  		if($paypal_ipn->paypal_post_vars['receiver_email'] != '')
  		$paypal->setReceiverEmail($paypal_ipn->paypal_post_vars['receiver_email']);

  		if($paypal_ipn->get_txn_id() != '')
  		$paypal->setTxnId($paypal_ipn->get_txn_id());

  		if($paypal_ipn->get_txn_type() != '')
  		$paypal->setTxnType($paypal_ipn->get_txn_type());

  		if($paypal_ipn->paypal_post_vars['payer_email'] != '')
  		$paypal->setPayerEmail($paypal_ipn->paypal_post_vars['payer_email']);

  		if($paypal_ipn->paypal_post_vars['payer_status'] != '')
  		$paypal->setPayerStatus($paypal_ipn->paypal_post_vars['payer_status']);

  		if($paypal_ipn->paypal_post_vars['first_name'] != '')
  		$paypal->setFirstName($paypal_ipn->paypal_post_vars['first_name']);

  		if($paypal_ipn->paypal_post_vars['last_name'] != '')
  		$paypal->setLastName($paypal_ipn->paypal_post_vars['last_name']);

  		if($paypal_ipn->paypal_post_vars['address_city'] != '')
  		$paypal->setAddressCity($paypal_ipn->paypal_post_vars['address_city']);

  		if($paypal_ipn->paypal_post_vars['address_street'] != '')
  		$paypal->setAddressStreet($paypal_ipn->paypal_post_vars['address_street']);

  		if($paypal_ipn->paypal_post_vars['address_state'] != '')
  		$paypal->setAddressState($paypal_ipn->paypal_post_vars['address_state']);

  		if($paypal_ipn->paypal_post_vars['address_zip'])
  		$paypal->setAddressZip($paypal_ipn->paypal_post_vars['address_zip']);

  		if($paypal_ipn->paypal_post_vars['address_country'] != '')
  		$paypal->setAddressCountry($paypal_ipn->paypal_post_vars['address_country']);

  		if($paypal_ipn->paypal_post_vars['address_status'] != '')
  		$paypal->setAddressStatus($paypal_ipn->paypal_post_vars['address_status']);

  		if($paypal_ipn->paypal_post_vars['subscr_date'] != '')
  		$paypal->setSubscrDate($paypal_ipn->paypal_post_vars['subscr_date']);

  		if($paypal_ipn->paypal_post_vars['period1'] != '')
  		$paypal->setPeriod1($paypal_ipn->paypal_post_vars['period1']);

  		if($paypal_ipn->paypal_post_vars['period2'] != '')
  		$paypal->setPeriod2($paypal_ipn->paypal_post_vars['period2']);

  		if($paypal_ipn->paypal_post_vars['period3'] != '')
  		$paypal->setPeriod3($paypal_ipn->paypal_post_vars['period3']);

  		if($paypal_ipn->paypal_post_vars['amount1'] != '')
  		$paypal->setAmount1($paypal_ipn->paypal_post_vars['amount1']);

  		if($paypal_ipn->paypal_post_vars['amount2'] != '')
  		$paypal->setAmount2($paypal_ipn->paypal_post_vars['amount2']);

  		if($paypal_ipn->paypal_post_vars['amount3'])
  		$paypal->setAmount3($paypal_ipn->paypal_post_vars['amount3']);

  		if($paypal_ipn->paypal_post_vars['recurring'])
  		$paypal->setRecurring($paypal_ipn->paypal_post_vars['recurring']);

  		if($paypal_ipn->paypal_post_vars['reattempt'])
  		$paypal->setReattempt($paypal_ipn->paypal_post_vars['reattempt']);

  		if($paypal_ipn->paypal_post_vars['retry_at'])
  		$paypal->setRetryAt($paypal_ipn->paypal_post_vars['retry_at']);

  		if($paypal_ipn->paypal_post_vars['recur_times'])
  		$paypal->setRecurTimes($paypal_ipn->paypal_post_vars['recur_times']);

  		if($paypal_ipn->paypal_post_vars['subscr_id'] != '')
  		$paypal->setSubscrId($paypal_ipn->paypal_post_vars['subscr_id']);

  		if($paypal_ipn->paypal_post_vars['entirepost'])
  		$paypal->setEntirepost($paypal_ipn->paypal_post_vars['entirepost']);

  		if($paypal_ipn->paypal_post_vars['paypal_verified'])
  		$paypal->setPaypalVerified($paypal_ipn->paypal_post_vars['paypal_verified']);

  		if($paypal_ipn->paypal_post_vars['verify_sign'])
  		$paypal->setVerifySign($paypal_ipn->paypal_post_vars['verify_sign']);

  		$paypal->save();	
  
}

public function executeSimpleIpn(){
  	
  	// leggi il post del sistema PayPal e aggiungi cmd
  	$req = 'cmd=_notify-validate';

  	foreach ($_POST as $key => $value) {
  		$value = urlencode(stripslashes($value));
  		$req .= "&$key=$value";
  	}

  	// reinvia al sistema PayPal per la convalida
  	$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
  	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
  	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
  	$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);

  	// assegna variabili inviate a variabili locali
  	$item_name = $_POST['item_name'];
  	$item_number = $_POST['item_number'];
  	$payment_status = $_POST['payment_status'];
  	$payment_date = $_POST['payment_date'];
  	$payment_amount = $_POST['mc_gross'];
  	$payment_currency = $_POST['mc_currency'];
  	$txn_id = $_POST['txn_id'];
  	$txn_type = $_POST['txn_type'];
  	//Data di inizio iscrizione o cancellazione iscrizione
  	$subscr_date = $_POST['subscr_date'];
  	//Data di riprova della sottoscrizione
  	$retry_at = $_POST['retry_at'];
  	//Motivazione di pagamento pendente
  	$pending_reason = $_POST['pending_reason'];
  	
  	$receiver_email = $_POST['receiver_email'];
  	$payer_email = $_POST['payer_email'];
  	$custom = $_POST['custom'];

  	if (!$fp) {
		sfContext::getInstance()->getLogger()->err('Impossibile connetersi a paypal IPN');
  	} else {
  		fputs ($fp, $header . $req);
  		while (!feof($fp)) {
  			$res = fgets ($fp, 1024);
  			if (strcmp ($res, "VERIFIED") == 0) {
  				// controlla che payment_status sia Completed
  				$message = "\n------------------- Inizio Pagamento --------------------------";
  				$message .= "\n".'Stato Pagamento: '.$payment_status."\n";
  				$message .= 'Data Pagamento: '.$payment_date."\n";
  				// controlla che txn_id non sia stato g elaborato
  				$message .= 'Txn id: '.$txn_id."\n";
  				$message .= 'Txn Type: '.$txn_type."\n";
  				$message .= 'Date: '.$subscr_date."\n";
  				// controlla che receiver_email sia il tuo indirizzo email PayPal principale
  				$message .= 'Receiver email: '.$receiver_email."\n";
  				$message .= 'Payer email: '.$payer_email."\n";
  				// controlla che payment_amount/payment_currency siano corretti
  				$message .= 'Payment Amount: '.$payment_amount."\n";
  				$message .= 'Payment Currency: '.$payment_currency."\n";
  				$message .= 'ID Utente: '.$custom."\n";
  				$message .= "-------------------- Fine Pagamento -------------------------";

  				// elabora pagamento
  				sfContext::getInstance()->getLogger()->err($message);
  				
  			}
  			else if (strcmp ($res, "INVALID") == 0) {
  				sfContext::getInstance()->getLogger()->err('Impossibile eseguire il pagamento da '.$payer_email);
  				
  			}
  		}
  		fclose ($fp);
  	}
  	
  	return sfView::NONE;
  }
}
