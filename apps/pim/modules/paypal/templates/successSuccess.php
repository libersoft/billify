
<?php
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';

$tx_token = $_GET['tx'];
$auth_token = "VHWnpeaUrFmfWvVB2E4k2WMm6Ezy__-btNA8unxJbhiswyB8wrVqJ3Dbxm4";
$req .= "&tx=$tx_token&at=$auth_token";

// post back to PayPal system to validate
$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
// If possible, securely post back to paypal using HTTPS
// Your PHP server will need to be SSL enabled
// $fp = fsockopen ('ssl://www.paypal.com', 443, $errno, $errstr, 30);

if (!$fp) {
// HTTP ERROR
} else {
fputs ($fp, $header . $req);
// read the body data
$res = '';
$headerdone = false;
while (!feof($fp)) {
$line = fgets ($fp, 1024);
if (strcmp($line, "\r\n") == 0) {
// read the header
$headerdone = true;
}
else if ($headerdone)
{
// header has been read. now read the contents
$res .= $line;
}
}

// parse the data
$lines = explode("\n", $res);
$keyarray = array();
if (strcmp ($lines[0], "SUCCESS") == 0) {
for ($i=1; $i<count($lines);$i++){
list($key,$val) = explode("=", $lines[$i]);
	$keyarray[urldecode($key)] = urldecode($val);
}

//print_r($keyarray);
// check the payment_status is Completed
// check that txn_id has not been previously processed
// check that receiver_email is your Primary PayPal email
// check that payment_amount/payment_currency are correct
// process payment
$firstname = $keyarray['first_name'];
$lastname = $keyarray['last_name'];
$itemname = $keyarray['item_name'];
$custom = $keyarray['custom'];
if(isset($keyarray['payment_gross']))
	$amount = $keyarray['payment_gross'];
if(isset($keyarray['subscr_date']))
	$subscr_date = $keyarray['subscr_date'];

echo ("<h2>Grazie per aver attivato il servizio</h2>");
echo ("<p>La sua richiesta di iscrizione &egrave; stata inoltrata, a breve il sistema verificher&agrave; l'avvenuto pagamento e il servizio sar&agrave; attivato.</p><p></p>");
echo ("<p><b>Dettagli Iscrizione</b><br/>");
echo ("Nome: $firstname $lastname<br/>\n");
echo ("Pacchetto: $itemname<br/>");

if(isset($keyarray['payment_gross']) && $amount != "")
	echo ("Prezzo: $amount<br/>");
	
if(isset($keyarray['subscr_date']))
	echo ("Data Iscrizione: $subscr_date<br/>");
	
echo ("<!--Id Utente: $custom<br/>-->");

?>
<p>La transazione &egrave; stata completata e una email di notifica &egrave; stata inviata al suo indirizzo di posta elettronica.<br/>
Pu&ograve; accedere al suo account <a href='https://www.paypal.com'>PayPal</a> per visualizzare i dettagli di questa transizione.</p>

<p>Deve <?php echo link_to('uscire e rientrare','login/logout')?> per terminare l'aggiornamento del suo profilo.</p>
<?php 
}
else if (strcmp ($lines[0], "FAIL") == 0) {
// log for manual investigation

echo "<h2>Errore nell'iscrizione al servizio</h2>";
echo "<p>E' stato impossibile attivare la sua iscrizione al servizio, per maggiori informazioni ci contatti all'indirizzo <a href=\"mailto:".sfConfig::get('app_admin_email')."\">".sfConfig::get('app_admin_email')."</a></p>";

}

}

fclose ($fp);

?>

