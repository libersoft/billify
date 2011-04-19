<div class="title">
   <h4>
    <?php echo __(isset($label_total)?$label_total:'turnover from %from_date% to %to_date%',
                  array(
                    '%from_date%' => format_date($from_date, 'dd/MM/yyyy'),
                    '%to_date%' => format_date($to_date, 'dd/MM/yyyy')
                  )); ?></h4>
</div>

<table class="monitor">
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