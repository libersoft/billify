<?php include_component('analytics', 'contact', array('contact' => $contact, 'total' => $totale, 'year' => $year)); ?>

<div class="title">
    <h2><?php echo $contact ?></h2>
    
    <?php if ($sf_user->hasFlash('notice')): ?>
      <span class="notice">- <?php echo __($sf_user->getFlash('notice')); ?></span>
    <?php endif; ?>
</div>

<?php include_partial('contact/info', array('contact' => $contact)); ?>

<div class="title">    
    <h2><?php echo __('Invoices list'); ?></h2>
</div>

<form method="get">
    <select name="year" onchange="this.form.submit()">
      <option value="all"><?php echo __('All')?></option>
    <?php for($i = date('Y'); $i >= date('Y') - 4; $i--): ?>
        <option value="<?php echo $i?>" <?php if($i == $year):?>selected="selected"<?php endif?>><?php echo $i ?></option>
    <?php endfor; ?>
    </select>
</form>

<?php include_partial('invoice/list', array(
    'results' => $invoices,
    'taxes' => $sf_user->getUser()->getTassas(),
    'copy'  => false,
    'batch' => false
)); ?>

<?php slot('sidebar'); ?>
  <div class="total">
    <span title="il totale è calcolato al netto di IVA"><?php echo format_currency($totale, '&euro;') ?></span>
    <div class="stimato"><?php echo __('previsione su pro-forma:'); ?> <strong><?php echo format_currency($totale_proforma, '&euro;') ?></strong></div>
  </div>

  <div class="title">
    <h4><?php echo __('actions')?></h4>
  </div>

  <ul class="ul-list nomb">
    <li>+ <?php echo link_to(__('edit'),'@contact_edit?id='.$contact->getID())?></li>
    <li>+ <?php echo link_to(__('delete'), '@contact_delete?id='.$contact->getId(), 'post=true&confirm='.__('vuoi cancellare questo contatto?').' title=delete') ?></li>
    <?php if ($contact->getClassKey() == 2): ?>      
      <li>+ <?php echo link_to(__('new invoice'),'@invoice_purchase_create?fornitore='.$contact->getId()); ?></li>
    <?php else: ?>
      <li>+ <?php echo link_to(__('new invoice'),'@invoice_create_for_client?id_cliente='.$contact->getId()); ?></li>
    <?php endif; ?>
  </ul>

<?php
    include_partial('contact/sidebar');
    end_slot();
?>
