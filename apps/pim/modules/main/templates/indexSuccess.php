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

<?php slot('sidebar')?><?php include_partial('main/sidebar') ?><?php end_slot('sidebar')?>
