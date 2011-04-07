<div class="title">
  <h2><?php echo __('tax list') ?></h2>
</div>

<p><?php echo __('No tax available, %insert_tax%.', array('%insert_tax%' => link_to(__('insert tax data'), 'tax/new', array('title' => 'create'))))?></p>

<?php
  slot('sidebar');
    include_partial('tax/sidebar');
  end_slot();
?>