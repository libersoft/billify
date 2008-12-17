<div id="indicator" style="display:none"></div>
<h3>Anagrafica Cliente</h3>
<div id="anagrafica">
<table class="cliente">
<tbody>
<?php if(UtentePeer::getImpostazione()->getBoolCodiceCliente()):?>
<tr>
  <th>Codice cliente:</th>
  <td><?php echo $cliente->getCod()?></td>
</tr>
<?php endif?>
<tr>
<th  width="35%">Azienda</th>
<td><?php echo $cliente->getAzienda()=='s'?'Si':'No' ?></td>
</tr>
<?php if($cliente->getRagioneSociale()):?>
<tr>
<th>Ragione sociale: </th>
<td><?php echo $cliente->getRagioneSociale() ?></td>
</tr>
<?php endif; ?>
<?php if($cliente->getCognome()):?>
<tr>
<th>Cognome: </th>
<td><?php echo $cliente->getCognome() ?></td>
</tr>
<?php endif; ?>
<?php if($cliente->getNome()):?>
<tr>
<th>Nome: </th>
<td><?php echo $cliente->getNome() ?></td>
</tr>
<?php endif ?>
<?php if($cliente->getVia()):?>
<tr>
<th>Via: </th>
<td><?php echo $cliente->getVia() ?></td>
</tr>
<?php endif ?>
<?php if($cliente->getCitta()):?>
<tr>
<th>Citta: </th>
<td><?php echo $cliente->getCitta() ?></td>
</tr>
<?php endif ?>
<?php if($cliente->getProvincia()):?>
<tr>
<th>Provincia: </th>
<td><?php echo $cliente->getProvincia() ?></td>
</tr>
<?php endif ?>
<?php if($cliente->getCap()):?>
<tr>
<th>Cap: </th>
<td><?php echo $cliente->getCap() ?></td>
</tr>
<?php endif; ?>
<?php if($cliente->getPiva()):?>
<tr>
<th>P.Iva: </th>
<td><?php echo $cliente->getPiva() ?></td>
</tr>
<?php endif ?>
<?php if($cliente->getCf()):?>
<tr>
<th>C.F.: </th>
<td><?php echo strtoupper($cliente->getCf()) ?></td>
</tr>
<?php endif ?>
<?php if($cliente->getTelefono()):?>
<tr>
<th>Telefono: </th>
<td><?php echo $cliente->getTelefono() ?></td>
</tr>
<?php endif ?>
<?php if($cliente->getFax()):?>
<tr>
<th>Fax: </th>
<td><?php echo $cliente->getFax() ?></td>
</tr>
<?php endif ?>
<?php if($cliente->getCellulare()):?>
<tr>
<th>Cellulare: </th>
<td><?php echo $cliente->getCellulare() ?></td>
</tr>
<?php endif ?>
<?php if($cliente->getEmail()):?>
<tr>
<th>Email: </th>
<td><?php echo $cliente->getEmail() ?></td>
</tr>
<?php endif ?>
</tbody>
</table>
</div>