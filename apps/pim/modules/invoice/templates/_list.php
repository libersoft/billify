<table class="fatture zebra-striped <?php echo (isset($invoice_type))?$invoice_type:''; ?>" width="100%" style="margin-bottom: 5px;">
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

  <?php $routing_url = ($invoice instanceof Acquisto)? '@invoice_edit':'@invoice_show'; ?>
  
  <tr class="invoice-<?php echo strtolower($invoice->getShortName()); ?>">
    <?php if (!isset($batch) || $batch): ?>
      <td><input type="checkbox" name="delete[]" value="<?php echo $invoice->getId()?>"></td>
    <?php endif; ?>
      <td><a href="<?php echo url_for($routing_url.'?id='.$invoice->getId()); ?>"><?php echo $invoice->getShortName(); ?></a></td>
    <td style="text-align: left"><?php echo link_to($invoice->getCliente()->getRagioneSociale(), '@contact_show?id='.$invoice->getCliente()->getId()) ?></td>
    <td><?php echo $invoice->getData('d/m/Y'); ?></td>
    <td align="right"><?php echo format_currency($invoice->getImponibile(), 'EUR'); ?></td>
    <td align="right"><?php echo format_currency($invoice->getTotale(), 'EUR'); ?></td>
    <td class="centered"><span class="label <?php echo $invoice->getColorStato()?>"><?php echo $invoice->getStato(true)?></span></td>
    <?php if($sf_user->getSettings()->getBoolConsegnaCommercialista()):?>
      <td><?php echo link_to($invoice->getCommercialista()=='s'?'si':'no','fattura/consegnaCommercialista?id='.$invoice->getID().'&redirect=list')?></td>
    <?php endif?>
    <td class="centered"><span class="label <?php echo $invoice->checkInRitardo()?'warning':'success'?>"><?php echo $invoice->checkInRitardo()?'si':'no'?></span></td>

    <?php if (!isset($copy) || $copy): ?>
      <td><?php echo link_to(image_tag('/images/icons_tango/copy.png',array('alt'=>'crea copia fattura')), 'fattura/copia?id='.$invoice->getID())?></td>
    <?php endif; ?>
      
    <td><?php echo link_to(image_tag('/images/icons/file_acrobat.gif',array('alt'=>'esporta in pdf')),'fattura/export?id='.$invoice->getID(),array('target' => '_blank'))?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>