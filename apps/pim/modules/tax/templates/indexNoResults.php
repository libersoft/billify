<h2><?php echo __('Tax list') ?></h2>

<p><?php echo __('No tax available, %insert_tax%.', array('%insert_tax%' => link_to(__('insert tax data'), 'tax/new', array('title' => 'create'))))?></p>

<?php
  slot('sidebar');
    include_partial('tax/sidebar');
  end_slot();
?>