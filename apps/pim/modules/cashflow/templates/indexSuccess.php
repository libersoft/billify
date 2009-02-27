<h2><?php echo __('Cash Flow')?></h2>

<table class="fatture">
  <tr>
    <th><?php echo __('Date')?></th>
    <th><?php echo __('Description')?></th>
    <th><?php echo __('Entrate')?></th>
    <th><?php echo __('Uscite')?></th>
  </tr>
  <?php foreach ($cf->getRows() as $row) : ?>
    <tr>
      <td><?php echo $row->getDate('Y-m-d')?></td>
      <td><?php echo $row->getDescription()?></td>
      <td><?php echo $row instanceof  CashFlowVenditaAdapter ? format_currency($row->getImponibile(), '&euro;') : '' ?></td>
      <td><?php echo $row instanceof CashFlowAcquistoAdapter ? format_currency($row->getImponibile(), '&euro;') : ''?></td>
    </tr>
  <?php endforeach; ?>
</table>

<table class="banca" style="margin: 10px 0px; border: 1px solid #AAA;">
  <tr>
    <th><?php echo __('Incoming')?>:</th>
    <td align="right"><?php echo format_currency($cf->getIncoming(), '&euro;')?></td>
  </tr>
  <tr>
    <th><?php echo __('Outcoming')?>:</th>
    <td align="right"><?php echo format_currency($cf->getOutcoming(), '&euro;')?></td>
  </tr>
  <tr>
    <th><?php echo __('Balance')?>:</th>
    <td align="right"><?php echo format_currency($cf->getBalance(), '&euro;')?></td>
  </tr>
</table>