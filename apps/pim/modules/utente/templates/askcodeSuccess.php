<h2>Richiesta codice d'invito</h2>

<?php if($sf_request->hasParameter('success')):?>
<p class="error"><strong><?php echo $sf_request->getParameter('success')?></strong></p>
<p>Presto riceverei nel tuo indirizzo e-mail il codice d'invito richiesto, attraverso il quale potrai iscriverti a PIM On-Line.</p>
<?php else:?>
<p>Inserisci il tuo indirizzo e-mail per richiedere un codice d'invito.</p>
<?php echo form_tag('utente/codesend')?>
<table class="cliente">
<tr>
<th>E-Mail:</th>
<td><?php echo input_tag('email',null,array('size'=>40))?>
</td>
<td>
<input type="submit" value="Invia" /></td>
<?php if($sf_request->hasError('email')):?>
<td class="validate-error">
<?php echo image_tag('icons/icon_alert.gif')?>&nbsp;<?php echo $sf_request->getError('email')?>
</td>
<?php endif?>
</tr>

<tr>
</table>
<?php endif?>
</form>
