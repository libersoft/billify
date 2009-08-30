<div class="title">
  <h2><?php echo __('bank accounts list') ?></h2>
</div>

<p><?php echo __('No bank available, %insert_bank%.', array('%insert_bank%' => link_to(__('insert your bank data'), 'bank/new', array('title' => 'create'))))?></p>

<?php
  slot('sidebar');
    include_partial('bank/sidebar');
  end_slot();
?>