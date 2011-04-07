<div class="title">
   <h4>
    <?php echo __(isset($label_total)?$label_total:'turnover from %from_date% to %to_date%',
                  array(
                    '%from_date%' => format_date($from_date, 'dd/MM/yyyy'),
                    '%to_date%' => format_date($to_date, 'dd/MM/yyyy')
                  )); ?></h4>
</div>

<ul class="ul-list nomb">
  <li><strong><?php echo __('incoming'); ?>:</strong> <?php echo format_currency($cf_paid_document->getIncoming(), 'EUR'); ?> (<?php echo format_currency($cf->getIncoming(), 'EUR'); ?>)</li>
  <li><strong><?php echo __('outcoming'); ?>:</strong> <?php echo format_currency($cf_paid_document->getOutcoming(), 'EUR'); ?> (<?php echo format_currency($cf->getOutcoming(), 'EUR'); ?>)</li>
  <li><strong><?php echo __('balance'); ?></strong> <?php echo format_currency($cf_paid_document->getBalance(), 'EUR'); ?> (<?php echo format_currency($cf->getBalance(), 'EUR'); ?>)</li>
</ul>

<div class="title">
   <h4>
    <?php echo __(isset($label_taxes)?$label_taxes:'vat from %from_date% to %to_date%',
                  array(
                    '%from_date%' => format_date($from_date, 'dd/MM/yyyy'),
                    '%to_date%' => format_date($to_date, 'dd/MM/yyyy')
                  )); ?></h4>
</div>

<ul class="ul-list nomb">
  <li><strong><?php echo __('encashment'); ?>:</strong> <?php echo format_currency($cf_paid_document->getIncomingTaxes(), 'EUR'); ?> (<?php echo format_currency($cf->getIncomingTaxes(), 'EUR'); ?>)</li>
  <li><strong><?php echo __('in charge'); ?>:</strong> <?php echo format_currency($cf_paid_document->getOutcomingTaxes(), 'EUR'); ?> (<?php echo format_currency($cf->getOutcomingTaxes(), 'EUR'); ?>)</li>
  <li><strong class="red"><?php echo __('payable'); ?>:</strong> <?php echo format_currency($cf_paid_document->getBalanceTaxes()*-1, 'EUR'); ?> (<?php echo format_currency($cf->getBalanceTaxes()*-1, 'EUR'); ?>)</li>
</ul>

