<table class="fatture" width="100%" style="margin-bottom: 5px;">
<thead>
<tr>
  <?php if (!isset($batch) || $batch): ?>
    <th></th>
  <?php endif; ?>
  <th><?php echo __('n.'); ?></th>
  <th><?php echo __('ragione sociale'); ?></th>
  <th><?php echo __('data')?></th>
  <th><?php echo __('imponibile')?></th>
  <th><?php echo __('totale')?></th>
  <th><?php echo __('stato')?></th>
  <?php if($sf_user->getSettings()->getBoolConsegnaCommercialista()):?>
    <th><abbr title="<?php echo __('comm.ta'); ?>Consegnata al commercialista"><?php echo __('comm.ta')?></abbr></th>
  <?php endif?>
  <th><?php echo __('ritardo')?></th>
  <?php if (!isset($copy) || $copy): ?>
    <th><?php echo __('copia')?></th>
  <?php endif; ?>
  <th><?php echo __('pdf')?></th>
</tr>
</thead>
<tbody>
<?php foreach ($results as $invoice): $invoice->calcolaFattura($taxes, $sf_user->getSettings()->getTipoRitenuta(), $sf_user->getSettings()->getRitenutaAcconto()); ?>
  <tr>
    <?php if (!isset($batch) || $batch): ?>
      <td><input type="checkbox" name="delete[]" value="<?php echo $invoice->getId()?>"></td>
    <?php endif; ?>
    <td><?php echo link_to($invoice->getShortName(), '@invoice_show?id='.$invoice->getId()); ?></td>
    <td style="text-align: left"><?php echo link_to($invoice->getCliente()->getRagioneSociale(), '@contact_show?id='.$invoice->getCliente()->getId()) ?></td>
    <td><?php echo $invoice->getData('d/m/Y'); ?></td>
    <td align="right"><?php echo format_currency($invoice->getImponibile(), 'EUR'); ?></td>
    <td align="right"><?php echo format_currency($invoice->getTotale(), 'EUR'); ?></td>
    <td style="font-weight: bold; background-color: <?php echo $invoice->getColorStato()?>; color: <?php echo $invoice->getFontColorStato()?>"><?php echo $invoice->getStato(true)?></td>
    <?php if($sf_user->getSettings()->getBoolConsegnaCommercialista()):?>
      <td><?php echo link_to($invoice->getCommercialista()=='s'?'si':'no','fattura/consegnaCommercialista?id='.$invoice->getID().'&redirect=list')?></td>
    <?php endif?>
    <td class="<?php echo $invoice->checkInRitardo()?'red':'none'?>"><?php echo $invoice->checkInRitardo()?'<strong>si</strong>':'no'?></td>

    <?php if (!isset($copy) || $copy): ?>
      <td><?php echo link_to(image_tag('/images/icons_tango/copy.png',array('alt'=>'crea copia fattura')), 'fattura/copia?id='.$invoice->getID())?></td>
    <?php endif; ?>
      
    <td><?php echo link_to(image_tag('/images/icons/file_acrobat.gif',array('alt'=>'esporta in pdf')),'fattura/export?id='.$invoice->getID(),array('target' => '_blank'))?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>