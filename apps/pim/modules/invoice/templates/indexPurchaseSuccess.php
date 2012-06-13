<?php include_stylesheets_for_form($pager->getFilter()) ?>
<?php include_javascripts_for_form($pager->getFilter()) ?>

<div class="title">
  <h2><?php echo __('fatture di acquisto')?></h2>
</div>

<?php include_partial('pager', array('pager' => $pager, 'route' => '@invoice_purchase')); ?>

<form action="<?php echo url_for('invoice/batch')?>" method="post">
<table class="fatture  zebra-striped" width="100%" style="margin-bottom: 5px;">
<thead>
<tr>
  <th></th>
  <th><?php echo __('n.')?></th>
  <th><?php echo __('ragione sociale')?></th>
  <th><?php echo __('data')?></th>
  <th><?php echo __('imponibile')?></th>
  <th><?php echo __('totale')?></th>
  <th><?php echo __('stato')?></th>
  <th><?php echo __('ritardo')?></th>
  <th></th>
</tr>
</thead>
<tbody>
<?php foreach ($pager->getResults() as $invoice): ?>
  <tr>
    <td><input type="checkbox" name="delete[]" value="<?php echo $invoice->getId()?>"></td>
    <td><?php echo link_to($invoice->getNumberDecorated(), 'invoice/edit?id='.$invoice->getId()) ?></td>
    <td style="text-align: left"><?php echo link_to($invoice->getCliente()->getRagioneSociale(), 'contact/show?id='.$invoice->getCliente()->getId()) ?></td>
    <td><?php echo $invoice->getData('d/m/Y') ?></td>
    <td><?php echo format_currency($invoice->getImponibile(), 'EUR'); ?></td>
    <td><?php echo format_currency($invoice->getTotale(), 'EUR') ?></td>
    <td class="centered"><span class="label <?php echo $invoice->getColorStato()?>"><?php echo $invoice->getStato(true)?></span></td>
    <td class="centered"><span class="label <?php echo $invoice->checkInRitardo()?'warning':'success'?>"><?php echo $invoice->checkInRitardo()?'si':'no'?></span></td>
    <td><?php echo link_to(image_tag('icons_tango/trash-full.png', 'alt=delete'), 'invoice/delete?id='.$invoice->getId(), 'post=true&confirm=vuoi cancellare questa fattura? title=delete') ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>
<input type="submit" name="delete_button" value="Elimina" onclick="return confirm('Vuoi eliminare le fatture selezionate');" />
</form>

<?php include_partial('pager', array('pager' => $pager, 'route' => '@invoice_purchase')); ?>

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

<?php
  slot('infobox-2');
    include_component('cashflow', 'monitor');
  end_slot();
?>
