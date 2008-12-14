<div id="indicator" style="display:none"></div>
<h3>Opzioni Fattura</h3>

<table class="cliente">
<tbody>
<tr>
<th>Modo Pagamento:</th>
<td><?php echo is_object($cliente->getModoPagamento())?$cliente->getModoPagamento()->getDescrizione():'Nessuno';?></td>
</tr>
<tr>
<th>Calcola Ritenuta:</th>
<td>
<?php echo $cliente->getCalcolaRitenutaAcconto()=='s'?'Si':''?>
<?php echo $cliente->getCalcolaRitenutaAcconto()=='n'?'No':''?>
<?php echo $cliente->getCalcolaRitenutaAcconto()=='a'?'Auto':''?>
</td>
</tr>
<tr>
<th>Calcola Tasse:</th>
<td><?php echo $cliente->getCalcolaTasse()=='s'?'Si':'No'?></td>
</tr>
<tr>
<th>Scorpora Tasse:</th>
<td><?php echo $cliente->getIncludiTasse()=='s'?'Si':'No'?></td>
</tr>
<?php if($cliente->getIdBanca()):?>
<tr>
<th>Banca:</th>
<td><?php echo $cliente->getBanca()->toString()?></td>
</tr>
<?php endif?>
<?php if($cliente->getIdTemaFattura()):?>
<tr>
<th>Tema Fattura:</th>
<td><?php echo $cliente->getTemaFattura()->toString()?></td>
</tr>
<?php endif?>
<tr>
<th>Note:</th>
<td><?php echo $cliente->getNote()!=""?$cliente->getNote():"Nessuna Nota"; ?></td>
</tr>
</tbody>
</table>
