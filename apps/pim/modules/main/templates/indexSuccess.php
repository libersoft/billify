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
  <?php include_partial('main/resume', array(
    'fatturato_annuo' => $invoice_repository->fatturato_annuo,
    'fatturato_annuo_netto' => $invoice_repository->fatturato_annuo_netto,
    'fatturato_annuo_netto_incassato' => $invoice_repository->fatturato_annuo_netto_incassato,
    'fatturato_annuo_incassato' => $invoice_repository->fatturato_annuo_incassato,
    'conta_fatture_da_incassare' => $invoice_repository->conta_fatture_da_incassare,
    'iva' => $invoice_repository->iva,
    'iva_a_debito' => $invoice_repository->iva_a_debito,
    'totale_da_incassare_netto' => $invoice_repository->totale_da_incassare_netto,
    'totale_da_incassare' => $invoice_repository->totale_da_incassare,
    'ritenuta_acconto' => $invoice_repository->ritenuta_acconto,
  )) ?>
<?php end_slot('sidebar')?>
