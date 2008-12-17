<div style="margin-bottom: 10px;margin-top: 10px;">
<?php echo link_to('Utenti','utente/list')?> |
<?php echo link_to('Sito','sito/list')?> |
<?php echo link_to('Bug','bug/list')?> 
</div>

<table class="sf_admin_list" cellspacing="1" style="width: auto;margin-bottom: 10px;">
<tr>
<th>Utenti Demo:</th>
<td><?php echo UtentePeer::getNumberUtente()?></td>
</tr>
<tr>
<th>Utenti Base:</th>
<td><?php echo UtentePeer::getNumberUtente(Utente::BASE )?></td>
</tr>
<tr>
<th>Utenti Pro:</th>
<td><?php echo UtentePeer::getNumberUtente(Utente::PRO )?></td>
</tr>
</table>