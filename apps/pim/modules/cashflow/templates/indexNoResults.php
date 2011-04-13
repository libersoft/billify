<div class="title">
  <h2><?php echo __('Cash Flow')?></h2>
</div>

<?php include_partial('cashflow/filter', array('filter' => $filter))?>

<p><?php echo __('No entrances in cash flow.');?></p>

<?php
  slot('sidebar');
    include_partial('cashflow/sidebar');
  end_slot();
?>