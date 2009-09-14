<?php use_helper('Number','Date')?>

<div class="title">
  <h2><?php echo __('outcoming invoices')?></h2>
</div>

<?php include_partial('fattura/list', array( 'fatture' => $fatture_da_inviare,
                                                                       'fatture_results'=>$fatture_da_inviare,
                                                                       'customer' => true,
                                                                       'checkbox' => false,
                                                                       'referrer' => 'main',
                                                                       'copia' => false) ) ?>
<div class="title">
  <h2><?php echo __('cashing invoices')?></h2>
</div>

<?php include_partial('fattura/list', array( 'fatture' => $fatture_da_incassare,
                                                                       'fatture_results'=>$fatture_da_incassare->getResults(),
                                                                       'customer' => true,
                                                                       'checkbox' => false,
                                                                       'referrer' => 'main',
                                                                       'copia' => false) )?>

<?php slot('sidebar')?>
  <?php include_partial('main/sidebar') ?>
<?php end_slot('sidebar')?>

<?php slot('infobox')?>
  <?php include_partial('main/resume', array(
    'fatturato_annuo' => $fatturato_annuo,
    'fatturato_annuo_netto' => $fatturato_annuo_netto,
    'fatturato_annuo_netto_incassato' => $fatturato_annuo_netto_incassato,
    'fatturato_annuo_incassato' => $fatturato_annuo_incassato,
    'conta_fatture_da_incassare' => $conta_fatture_da_incassare,
    'iva' => $iva,
    'iva_a_debito' => $iva_a_debito,
    'totale_da_incassare_netto' => $totale_da_incassare_netto,
    'totale_da_incassare' => $totale_da_incassare,
    'ritenuta_acconto' => $ritenuta_acconto,
  )) ?>
<?php end_slot('sidebar')?>
