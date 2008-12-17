<?php if($sf_request->getCookie('updateProfile') != 'noview' &&  ($utente->getRagioneSociale() == '' || $utente->getPartitaIva() == '' || $utente->getCodiceFiscale() == '' || $tema == 0 || $banca == 0)):?>
<div id="update-profile" class="update-profile">
<p><strong>Devi compiere ancora alcune azioni:</strong></p>
<?php if($utente->getRagioneSociale() == ''):?>
<p><?php echo link_to('Inserisci la tua ragione sociale','utente/edit')?></p>
<?php else:?>
<p><strike>Inserisci la tua ragione sociale</strike></p>
<?php endif?>

<?php if($utente->getPartitaIva() == ''):?>
<p><?php echo link_to('Inserisci la tua partita iva','utente/edit')?></p>
<?php else:?>
<p><strike>Inserisci la tua partita iva</strike></p>
<?php endif?>

<?php if($utente->getCodiceFiscale() == ''):?>
<p><?php echo link_to('Inserisci il tuo codice fiscale','utente/edit')?></p>
<?php else:?>
<p><strike>Inserisci il tuo codice fiscale</strike></p>
<?php endif?>

<?php if($tema == 0):?>
<p><?php echo link_to('Inserisci il tema delle tue fattura','temafattura/create')?></p>
<?php else:?>
<p><strike>Inserisci il tema per la fattura</strike></p>
<?php endif?>

<?php if($banca == 0):?>
<p><?php echo link_to('Inserisci le tue coordinate bancarie','banca/create')?></p>
<?php else:?>
<p><strike>Inserisci le tue coordinate bancarie</strike></p>
<?php endif?>

<?php echo form_tag('main/updateProfile')?>
<?php echo input_hidden_tag('referrer',$_SERVER['SCRIPT_URI'])?>
<p align="right"><small>Non visualizzare questa finestra <?php echo checkbox_tag('noview',1,false,array('onclick'=>'form.submit();'))?></small></p>
</form>
</div>
<?endif?>
