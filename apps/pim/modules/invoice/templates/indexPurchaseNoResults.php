<div class="title">
  <h2><?php echo __('fatture di acquisto')?></h2>
</div>

<p>Nessuna fattura disponibile, <?php echo link_to(__('inserisci una nuova fattura'), '@invoice_purchase_create')?>.</p>

<?php
  slot('sidebar');
    include_partial('invoice/filter', array('filter' => $filter));
    include_partial('invoice/sidebar');
  end_slot();
?>