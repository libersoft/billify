<div class="title">
  <h2><?php echo __('taxes code list') ?></h2>
</div>

<p><?php echo __('No taxes codes available, %insert_taxes_code%.', array('%insert_taxes_code%' => link_to(__('insert new tax code'), 'taxescode/new', array('title' => 'create'))))?></p>

<?php
  slot('sidebar');
    include_partial('taxescode/sidebar');
  end_slot();
?>