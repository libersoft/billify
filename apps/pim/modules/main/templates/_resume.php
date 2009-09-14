<div class="title">
   <h4><?php echo __('resume')?></h4>
</div>

<ul class="ul-list nomb" id="resume">
  <li>
    <strong><?php echo __('year turnover')?>:</strong>
    <?php echo format_currency($fatturato_annuo_netto, 'EUR') ?>
    <span class="hide">(<?php echo format_currency($fatturato_annuo, 'EUR') ?>)</span>
  </li>
  <li>
    <strong><?php echo __('fatturato annuo incassato')?>:</strong>
    <?php echo format_currency($fatturato_annuo_netto_incassato,'EUR') ?>
    <span class="hide">(<?php echo format_currency($fatturato_annuo_incassato, 'EUR') ?>)</span>
  </li>
  <?php if(UtentePeer::getImpostazione()->getBoolDepositaIva()) : ?>
    <li><strong><?php echo __('situazione deposito Iva')?>:</strong> <?php echo format_currency($iva_depositata,'EUR')?>  depositata - <?php echo format_currency($iva_da_depositare,'EUR')?>  da depositare</li>
  <?php endif ?>
  <?php if( (int) UtentePeer::getImpostazione()->getRitenutaAcconto()) : ?>
    <li><strong><?php echo __('ritenuta d\'acconto versata')?>:</strong> <?php echo format_currency($ritenuta_acconto,'EUR')?></li>
  <?php endif ?>
  <li><strong class="red"><?php echo __('fatture da incassare')?>:</strong> <?php echo $conta_fatture_da_incassare ?></li>
  <li>
    <strong class="red"><?php echo __('iva da pagare')?>:</strong>
    <?php echo format_currency($iva, 'EUR') ?>
    <span class="hide">(A debito: <?php echo format_currency($iva_a_debito,'EUR') ?>  - A credito: <?php echo format_currency(($iva - $iva_a_debito),'EUR')?>)</span>
  </li>
  <li>
    <strong class="red"><?php echo __('totale da incassare')?>:</strong>
    <?php echo format_currency($totale_da_incassare_netto, 'EUR')?>
    <span class="hide">(<?php echo format_currency($totale_da_incassare, 'EUR')?> )</span>
  </li>
</ul>