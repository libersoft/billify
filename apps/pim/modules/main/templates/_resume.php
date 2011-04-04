<div class="title">
   <h4><?php echo __('resume')?></h4>
</div>

<ul class="ul-list nomb" id="resume">
  
  <?php if( (int) UtentePeer::getImpostazione()->getRitenutaAcconto()) : ?>
    <li><strong><?php echo __('ritenuta d\'acconto versata')?>:</strong> <?php echo format_currency($ritenuta_acconto,'EUR')?></li>
  <?php endif ?>
  <li><strong class="red"><?php echo __('fatture da incassare')?>:</strong> <?php echo $conta_fatture_da_incassare ?></li>
  <li>
    <strong class="red"><?php echo __('totale da incassare')?>:</strong>
    <?php echo format_currency($totale_da_incassare_netto, 'EUR')?>
    <span class="hide">(<?php echo format_currency($totale_da_incassare, 'EUR')?> )</span>
  </li>
</ul>