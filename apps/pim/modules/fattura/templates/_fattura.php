<table id="opzioni_fattura" class="fattura fattura_show1" style="display: none;margin-left: 0px;margin-top: 5px;margin-bottom: 5px;" width="100%">
<tr>
<th width="45%"><strong <?php echo $fattura->checkInRitardo()?'class="red"':''?>>Scadenza: </strong></th>
<td><?php echo $fattura->getDataPagamento('d M y') ?> <?php echo $fattura->checkInRitardo()?'(In ritardo)':''?></td>
</tr>
<tr>
<th>Valuta: </th>
<td><?php echo (is_object($fattura->getModoPagamento())?$fattura->getModoPagamento()->getDescrizione():'Nessuno') ?></td>
</tr>
<tr>
<th>Netto da Liquidare:</th>
<td><?php echo format_currency($fattura->getNettoDaLiquidare(),'EUR')?></td>
</tr>
<tr>
<th>Calcola Ritenuta:</th>
<?php switch($fattura->getCalcolaRitenutaAcconto()):?>
<?php case 's':?>
<td><?php echo link_to('Si','fattura/calcolaRitenuta?id='.$fattura->getID())?></td>
<?php break; ?>
<?php case 'n': ?>
<td><?php echo link_to('No','fattura/calcolaRitenuta?id='.$fattura->getID())?></td>
<?php break; ?>
<?php default: ?>
<td><?php echo link_to('Auto','fattura/calcolaRitenuta?id='.$fattura->getID())?></td>
<?php break; ?>
<?php endswitch ?>
</tr>
<tr>
<th>Calcola Tasse:</th>
<td><?php echo link_to($fattura->getCalcolaTasse()=='s'?'Si':'No','fattura/calcolaTasse?id='.$fattura->getID())?></td>
</tr>
<tr>
<th>Scorpora Tasse:</th>
<td><?php echo link_to($fattura->getIncludiTasse()=='s'?'Si':'No','fattura/includiTasse?id='.$fattura->getID())?></td>
</tr>
<th>Note: </th>
<td><?php echo $fattura->getNote()!=""?$fattura->getNote():"Nessuna Nota"; ?></td>
</tr>
</table>
