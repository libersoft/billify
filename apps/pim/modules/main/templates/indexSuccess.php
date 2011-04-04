<?php use_helper('Number','Date')?>

<div class="title">
  <h2><?php echo __('outcoming invoices')?></h2>
</div>

<?php

include_partial('fattura/list', array('fatture' => $invoice_repository->fatture_da_inviare,
                                      'fatture_results'=> $invoice_repository->fatture_da_inviare,
                                      'customer' => true,
                                      'checkbox' => false,
                                      'referrer' => 'main',
                                      'copia' => false));
?>

<div class="title">
  <h2><?php echo __('cashing invoices')?></h2>
</div>

<?php

include_partial('fattura/list', array('fatture' => $invoice_repository->fatture_da_incassare,
                                      'fatture_results'=> $invoice_repository->fatture_da_incassare->getResults(),
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

  include_partial('main/resume', array(
    'conta_fatture_da_incassare' => $invoice_repository->conta_fatture_da_incassare,
    'totale_da_incassare_netto' => $invoice_repository->totale_da_incassare_netto,
    'totale_da_incassare' => $invoice_repository->totale_da_incassare,
    'ritenuta_acconto' => $invoice_repository->ritenuta_acconto,
  ));

  include_component('cashflow', 'monitor', array('label_total' => 'fatturato ultimo anno', 'label_taxes' => 'iva ultimo anno'));
    include_component('cashflow', 'monitor', array(
        'label_total' => 'fatturato ultimo mese',
        'label_taxes' => 'iva ultimo mese',
        'from_date' => date('01/m/Y', strtotime('-1 month')),
        'to_date' => date('t/m/Y', strtotime('-1 month'))));
   ?>
<?php end_slot(); ?>
