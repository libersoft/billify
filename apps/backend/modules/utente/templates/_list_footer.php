<p><?php echo link_to('Genera Codice d\'Invito','invitationcode/make')?></p>
<table class="sf_admin_list" cellspacing="0" style="width: auto;">
<tr>
<th>Codice d'Invito</th>
<th>Inviato</th>
<th>E-Mail</th>
<th></th>
</tr>
<?php 
$inviti = InvitationCodePeer::doSelect(new Criteria());
$i=0;
foreach ($inviti as $invito):?>
<?php if($invito->check()):?>
<tr>
<td align="center" style="font-size: 110%"><?php echo $invito->getCodice()?></td>
<td align="center"><?php echo $invito->getInviato()?></td>
<?php if($invito->getInviato() == 's'):?>
<td align="center"><?php echo $invito->getEmail()?></td>
<?php else:?>
<td>
<?php echo form_tag('invitationcode/send')?>
<?php echo input_hidden_tag('id',$invito->getId())?>
<?php echo input_tag('email')?>&nbsp;
<?php echo submit_tag('Invia')?>
</td>
</form>
<?php endif?>
<td><?php echo link_to('Elimina','invitationcode/delete?id='.$invito->getId())?></td>
<?endif?>
</td>
</tr>
<?php $i++; endforeach;?>
</table>
