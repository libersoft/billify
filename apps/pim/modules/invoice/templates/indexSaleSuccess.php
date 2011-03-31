<?php include_stylesheets_for_form($pager->getFilter()) ?>
<?php include_javascripts_for_form($pager->getFilter()) ?>

<div class="title">
  <h2><?php echo __('fatture di vendita'); ?></h2>
</div>

<?php include_partial('pager', array('pager' => $pager, 'route' => '@invoice')); ?>

<form action="<?php echo url_for('invoice/batch'); ?>" method="post">
<table class="fatture" width="100%" style="margin-bottom: 5px;">
<thead>
<tr>
  <th></th>
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
  <th><?php echo __('copia')?></th>
  <th><?php echo __('pdf')?></th>
</tr>
</thead>
<tbody>
<?php foreach ($pager->getResults() as $invoice): $invoice->calcolaFattura($taxes, $sf_user->getSettings()->getTipoRitenuta(), $sf_user->getSettings()->getRitenutaAcconto()); ?>
  <tr>
    <td><input type="checkbox" name="delete[]" value="<?php echo $invoice->getId()?>"></td>
    <td><?php echo link_to($invoice->getShortName(), '@invoice_show?id='.$invoice->getId()); ?></td>
    <td style="text-align: left"><?php echo link_to($invoice->getCliente()->getRagioneSociale(), '@contact_show?id='.$invoice->getCliente()->getId()) ?></td>
    <td><?php echo $invoice->getData('d/m/Y'); ?></td>
    <td><?php echo format_currency($invoice->getImponibile(), 'EUR'); ?></td>
    <td><?php echo format_currency($invoice->getTotale(), 'EUR'); ?></td>
    <td style="font-weight: bold; background-color: <?php echo $invoice->getColorStato()?>; color: <?php echo $invoice->getFontColorStato()?>"><?php echo $invoice->getStato(true)?></td>
    <?php if($sf_user->getSettings()->getBoolConsegnaCommercialista()):?>
      <td><?php echo link_to($fattura->getCommercialista()=='s'?'si':'no','fattura/consegnaCommercialista?id='.$fattura->getID().'&redirect=list')?></td>
    <?php endif?>
    <td class="<?php echo $invoice->checkInRitardo()?'red':'none'?>"><?php echo $invoice->checkInRitardo()?'<strong>si</strong>':'no'?></td>
    <td><?php echo link_to(image_tag('/images/icons_tango/copy.png',array('alt'=>'crea copia fattura')), 'fattura/copia?id='.$invoice->getID())?></td>
    <td><?php echo link_to(image_tag('/images/icons/file_acrobat.gif',array('alt'=>'esporta in pdf')),'fattura/export?id='.$invoice->getID(),array('target' => '_blank'))?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
<?php echo submit_tag('Elimina', array('name' => 'delete_button', 'confirm' => __('Vuoi eliminare le fatture selezionate')))?>
</form>

<?php include_partial('pager', array('pager' => $pager, 'route' => '@invoice')); ?>

<?php
  slot('sidebar');
    include_partial('invoice/sidebar');
  end_slot();
?>

<?php
  slot('infobox');
    include_partial('invoice/filter', array('filter' => $pager->getFilter()));
  end_slot('sidebar');
?>
