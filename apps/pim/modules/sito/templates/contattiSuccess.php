<h2>Contatti</h2>

<p>
Per qualsiasi informazione, bug o assistenza contattaci attraverso l'apposita form o inviando una e-mail all'indirizzo <a href="mailto:info@personal-invoice-manager.net">info[at]personal-invoice-manager.net</a>
</p>
<?php if($sf_request->hasParameter('success')):?>
<p class="success">Messaggio inviato con successo</p>
<?php endif?>

<div class="contatti">
<?php echo form_tag('sito/inviaContatti')?>
<label for="nome">Nome e Cognome</label> 
<?php echo form_error('nome')?>
<?php echo input_tag('nome')?>
<label>E-Mail</label>
<?php echo form_error('email')?>
<?php echo input_tag('email')?>
<label>Oggetto</label>
<?php echo form_error('oggetto')?>
<?php echo input_tag('oggetto')?>
<label>Messaggio</label>
<?php echo form_error('messaggio')?>
<?php echo textarea_tag('messaggio')?>
<label></label>
<?php echo submit_tag('Invia')?>
</form>
</contatti>
