<div class="title">
  <h2><?php echo __('Cash Flow')?></h2>
</div>

<div class="filter">
  <form method="post">
    <?php echo $filter ?>
    <input type="submit" value="<?php echo __('Filter')?>" />
  </form>
</div>

<table class="fatture">
  <tr>
    <th><?php echo __('Data')?></th>
    <th><?php echo __('Contatto')?></th>
    <th><?php echo __('Descrizione')?></th>
    <th><?php echo __('Entrate')?></th>
    <th><?php echo __('Uscite')?></th>
    <th><?php echo __('Pagata')?></th>
  </tr>
  <?php foreach ($cf->getRows() as $row) : ?>
    <tr>
      <td><?php echo $row->getPaymentDate('Y-m-d')?></td>
      <td><?php echo link_to($row->getContact(), $row->getContactUrl())?></td>
      <td><?php echo link_to($row->getDescription().' '.__('del').' '.format_date($row->getDate(), 'dd/MM/yyyy'), $row->getDocumentUrl()) ?></td>
      <td><?php echo $row instanceof  CashFlowSalesAdapter ? format_currency($row->getTotal(), '&euro;') : '' ?></td>
      <td><?php echo $row instanceof CashFlowPurchaseAdapter ? format_currency($row->getTotal(), '&euro;') : ''?></td>
      <td style="background-color: <?php echo $row->getColorStato() ?>; font-weight: bold;" ><?php echo $row->isPaid() ? __('Si') : __('No') ?></td>
    </tr>
  <?php endforeach; ?>
</table>

<table class="banca" style="margin: 10px 0px; border: 1px solid #AAA;">
  <tr>
    <th><?php echo __('Totale Entrate')?>:</th>
    <td align="right"><?php echo format_currency($cf->getIncoming(), '&euro;')?></td>
  </tr>
  <tr>
    <th><?php echo __('Totale Uscite')?>:</th>
    <td align="right"><?php echo format_currency($cf->getOutcoming(), '&euro;')?></td>
  </tr>
  <tr>
    <th><?php echo __('Totale')?>:</th>
    <td align="right"><?php echo format_currency($cf->getBalance(), '&euro;')?></td>
  </tr>
</table>

<?php
  slot('sidebar');
    include_partial('cashflow/sidebar');
  end_slot();
?>