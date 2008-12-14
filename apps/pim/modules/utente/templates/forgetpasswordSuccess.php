<h2>Richiesta Password</h2>

<?php if($sf_request->hasParameter('success')):?>
<p class="error"><strong><?php echo $sf_request->getParameter('success')?></strong></p>
<p>La nuova password &egrave; stata inviata al tuo indirizzo e-mail.</p>
<?php else:?>
<p>Inserisci il tuo username per ricevere la tua nuova password.</p>
<?php echo form_tag('utente/sendpassword')?>
<table class="cliente">
<tr>
<th>UserName:</th>
<td><?php echo input_tag('username',null,array('size'=>40))?>
</td>
<td>
<?php echo submit_tag('Invia')?></td>
<?php if($sf_request->hasError('username')):?>
<td class="validate-error">
<?php echo image_tag('icons/icon_alert.gif')?>&nbsp;<?php echo $sf_request->getError('username')?>
</td>
<?php endif?>
</tr>

<tr>
</table>
<?php endif?>
</form>