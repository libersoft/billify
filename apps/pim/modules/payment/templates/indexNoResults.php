<div class="title">
  <h2><?php echo __('Payment\'s types') ?></h2>
</div>

<p><?php echo __('No payment\'s type available, %insert_payment%.', array('%insert_payment%' => link_to(__('insert a new type'), 'payment/new', array('title' => 'create'))))?></p>

<?php
  slot('sidebar');
    include_partial('payment/sidebar');
  end_slot();
?>