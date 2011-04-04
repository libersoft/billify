<div class="title">
   <h4>
    <?php echo __('Fatturato dal %from_date% al %to_date%',
                  array(
                    '%from_date%' => format_date($from_date, 'dd/MM/yyyy'),
                    '%to_date%' => format_date($to_date, 'dd/MM/yyyy')
                  )); ?></h4>
</div>

<ul class="ul-list nomb">
  <li><strong>Entrate:</strong> <?php echo format_currency($cf->getIncoming(), 'EUR'); ?></li>
  <li><strong>Uscite:</strong> <?php echo format_currency($cf->getOutcoming(), 'EUR'); ?></li>
  <li><strong>Bilancio:</strong> <?php echo format_currency($cf->getBalance(), 'EUR'); ?></li>
</ul>

<div class="title">
   <h4>
    <?php echo __('Tasse dal %from_date% al %to_date%',
                  array(
                    '%from_date%' => format_date($from_date, 'dd/MM/yyyy'),
                    '%to_date%' => format_date($to_date, 'dd/MM/yyyy')
                  )); ?></h4>
</div>

<ul class="ul-list nomb">
  <li><strong>Fatturate:</strong> <?php echo format_currency($cf->getIncomingTaxes(), 'EUR'); ?></li>
  <li><strong>Pagate:</strong> <?php echo format_currency($cf->getOutcomingTaxes(), 'EUR'); ?></li>
  <li><strong>Credito:</strong> <?php echo format_currency($cf->getBalanceTaxes(), 'EUR'); ?></li>
</ul>

