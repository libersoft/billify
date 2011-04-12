<?php use_helper('Number','Date')?>

<div class="title">
  <h2><?php echo __('outcoming invoices')?></h2>
</div>

<?php

include_partial('fattura/list', array('fatture' => $fatture_da_inviare,
                                      'fatture_results'=> $fatture_da_inviare,
                                      'customer' => true,
                                      'checkbox' => false,
                                      'referrer' => 'main',
                                      'copia' => false));
?>

<div class="title">
  <h2><?php echo __('cashing invoices')?></h2>
</div>

<?php

include_partial('fattura/list', array('fatture' => $fatture_da_incassare,
                                      'fatture_results'=> $fatture_da_incassare,
                                      'customer' => true,
                                      'checkbox' => false,
                                      'referrer' => 'main',
                                      'copia' => false));
?>

<?php slot('sidebar')?>
  <?php include_partial('main/sidebar') ?>
<?php end_slot('sidebar')?>

<?php slot('infobox')?>
  <?php
  include_component('cashflow', 'monitor', array('label_total' => 'fatturato ultimo anno', 'label_taxes' => 'iva ultimo anno'));
    include_component('cashflow', 'monitor', array(
        'label_total' => 'fatturato ultimo mese',
        'label_taxes' => 'iva ultimo mese',
        'from_date' => date('01/m/Y', strtotime('-1 month')),
        'to_date' => date('t/m/Y', strtotime('-1 month'))));
   ?>
<?php end_slot(); ?>
