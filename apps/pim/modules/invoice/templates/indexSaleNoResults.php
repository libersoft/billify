<div class="title">
  <h2><?php echo __('fatture di vendita')?></h2>
</div>

<p>Nessuna fattura disponibile.</p>

<?php
  slot('sidebar');
    include_partial('invoice/sidebar');
  end_slot();
?>

<?php
  slot('infobox');
    include_partial('invoice/filter', array('filter' => $filter));
  end_slot('sidebar');
?>