<?php include_stylesheets_for_form($pager->getFilter()) ?>
<?php include_javascripts_for_form($pager->getFilter()) ?>

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
    include_partial('invoice/filter', array('filter' => $pager->getFilter()));
  end_slot('sidebar');
?>

<?php
  slot('infobox-2');
    include_component('cashflow', 'monitor');
  end_slot();
?>