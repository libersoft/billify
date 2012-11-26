<div class="title">
  <h2><?php echo __('Category') ?></h2>
</div>

<p><?php echo __('No categories available, %insert_category%.', array('%insert_category%' => link_to(__('insert a new category'), 'categoria/new', array('title' => 'create'))))?></p>

<?php
  slot('sidebar');
    include_partial('categoria/sidebar');
  end_slot();
?>
