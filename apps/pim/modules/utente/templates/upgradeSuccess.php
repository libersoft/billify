<?php if($sconto == 1):?>
<div id="update-profile" class="update-profile">
<p><?php echo $message?></p>
</div>
<?php endif?>

<div id="pro">
<?php if($sf_user->getAttribute('tipo_utente') == Utente::DEMO): ?>
<h2>Iscriviti al servizio BASE</h2>
<p>Iscrivendoti al servizio <strong>BASE</strong> potrai continuare ad utilizzare il servizio.</p>

<h3>Prezzo</h3>
<p>Il costo &egrave; di sole <strong><?php if($sconto):?><del><?php echo $prezzo?> euro</del> <?php echo $prezzo_scontato?><?php else:?><?php echo $prezzo?><?php endif?> euro + iva</strong> al mese.</p>
<p>Per iscriversi al servizio &egrave; necessario un account <strong><a href="http://www.paypal.it" target="_blank">PayPal</a></strong>.</p>
<p>Iscrivendoti pagherai ogni mese il costo del servizio e potrai annullare l'iscrizione quando lo vorrai, non pagando pi&ugrave; nulla.</p>
<br/>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="image" src="https://www.paypal.com/it_IT/i/btn/x-click-but20.gif" border="0" name="submit" alt="Effettua i tuoi pagamenti con PayPal.  un sistema rapido, gratuito e sicuro.">
<img alt="" border="0" src="https://www.paypal.com/it_IT/i/scr/pixel.gif" width="1" height="1">
<input type="hidden" name="cmd" value="_xclick-subscriptions">
<input type="hidden" name="business" value="paypal@personal-invoice-manager.net">
<input type="hidden" name="item_name" value="PIM On-line - Servizio Base <?php echo $sconto?'(Sconto '.$sconto_value.'%)':''?>">
<input type="hidden" name="item_number" value="1">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="return" value="http://pimonline.impattocreativo.com/paypal/success">
<input type="hidden" name="cancel_return" value="http://pimonline.impattocreativo.com/paypal/cancel">
<input type="hidden" name="no_note" value="1">
<input type="hidden" name="currency_code" value="EUR">
<input type="hidden" name="lc" value="IT">
<input type="hidden" name="bn" value="PP-SubscriptionsBF">
<input type="hidden" name="a3" value="<?php echo number_format(($sconto?$prezzo_scontato+($prezzo_scontato/100*$sconto_value):$prezzo+($prezzo/100*$sconto_value)),2,'.','')?>">
<input type="hidden" name="p3" value="1">
<input type="hidden" name="t3" value="M">
<input type="hidden" name="src" value="1">
<input type="hidden" name="sra" value="1">
<input type="hidden" name="custom" value="<?php echo $sf_user->getAttribute('id_utente')?>">
</form>

<!-- END PAYPAL -->

</div>

<?php endif?>

<?php if($sf_user->getAttribute('tipo_utente') == Utente::DEMO || $sf_user->getAttribute('tipo_utente') == Utente::BASE): ?>
<h2>Iscriviti al servizio PRO</h2>
<p>Servizio non ancora disponibile.</p>
<?php endif?>
