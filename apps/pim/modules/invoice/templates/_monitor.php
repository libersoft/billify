<div class="title">
   <h4><?php echo __('monitor')?></h4>
</div>

<ul class="ul-list nomb">
  <li><strong>Entrate:</strong> <?php echo format_currency($cf->getIncoming(), 'EUR'); ?></li>
  <li><strong>Uscite:</strong> <?php echo format_currency($cf->getOutcoming(), 'EUR'); ?></li>
  <li><strong>Bilancio:</strong> <?php echo format_currency($cf->getBalance(), 'EUR'); ?></li>
</ul>


