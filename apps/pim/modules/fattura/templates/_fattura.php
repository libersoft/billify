<li><strong <?php echo $fattura->checkInRitardo()?'class="red"':''?>>scadenza:</strong> <?php echo format_date($fattura->getDataPagamento('U'), 'dd MMM yyyy') ?> <?php echo $fattura->checkInRitardo()?'(In ritardo)':''?>
<li><strong>valuta:</strong> <?php echo (is_object($fattura->getModoPagamento()) ? strtolower($fattura->getModoPagamento()->getDescrizione()) : 'nessuno') ?>
<li><strong>netto da liquidare:</strong> <?php echo format_currency($fattura->getNettoDaLiquidare(), 'EUR')?>
<li><strong>calcola ritenuta:</strong>
<?php switch($fattura->getCalcolaRitenutaAcconto()) : ?>
<?php case 's':?>
  <?php echo link_to('si','fattura/calcolaRitenuta?id='.$fattura->getID())?>
<?php break; ?>
<?php case 'n': ?>
<?php echo link_to('no','fattura/calcolaRitenuta?id='.$fattura->getID())?>
<?php break; ?>
<?php default: ?>
  <?php echo link_to('auto','fattura/calcolaRitenuta?id='.$fattura->getID())?>
<?php break; ?>
<?php endswitch ?>

<li><strong>calcola tasse:</strong> <?php echo link_to($fattura->getCalcolaTasse() == 's' ? 'si' : 'no', 'fattura/calcolaTasse?id='.$fattura->getID())?>
<li><strong>scorpora tasse:</strong> <?php echo link_to($fattura->getIncludiTasse() == 's' ? 'si' : 'no', 'fattura/includiTasse?id='.$fattura->getID())?>
<li><strong>note:</strong> <?php echo $fattura->getNote() != "" ? $fattura->getNote() : "Nessuna Nota"; ?>
