<div class="title">
  <h2>
    <?php echo __('Cash Flow')?>
    <?php if ($sf_user->hasFlash('notice')): ?>
      <span class="notice">- <?php echo __($sf_user->getFlash('notice')); ?></span>
    <?php endif; ?>
  </h2>
</div>

<?php include_partial('cashflow/pager', array('pager' => $pager))?>

<table width="100%">
  <tr>
    <th><?php echo __('Data')?></th>
    <th><?php echo __('Contatto')?></th>
    <th><?php echo __('Descrizione')?></th>
    <th><?php echo __('Entrate')?></th>
    <th><?php echo __('Uscite')?></th>
    <th><?php echo __('Pagata')?></th>
  </tr>
  <?php foreach ($cf->getResults() as $row) : ?>
    <tr>
      <td><?php echo $row->getPaymentDate('Y-m-d')?></td>
      <td><?php echo link_to($row->getContact(), $row->getContactUrl())?></td>
      <td><?php echo link_to($row->getDescription().' '.__('del').' '.format_date($row->getDate(), 'dd/MM/yyyy'), $row->getDocumentUrl()) ?></td>
      <td><?php echo $row instanceof  CashFlowSalesAdapter ? format_currency($row->getTotal(), 'EUR') : '' ?></td>
      <td><?php echo $row instanceof CashFlowPurchaseAdapter ? format_currency($row->getTotal(), 'EUR') : ''?></td>
      <td style="background-color: <?php echo $row->getColorStato() ?>; font-weight: bold;" ><?php echo $row->isPaid() ? __('Si') : __('No') ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<?php include_partial('cashflow/pager', array('pager' => $pager))?>

<?php
  slot('sidebar');
    include_partial('cashflow/sidebar');
  end_slot();
?>

<?php
  slot('infobox');
    include_partial('cashflow/filter', array('filter' => $filter));
  end_slot();
?>

<?php
  slot('infobox-2');
    include_partial('cashflow/monitor_cashflow', array('from_date' => $from_date, 'to_date' => $to_date, 'cf' => $cf));
  end_slot();
?>