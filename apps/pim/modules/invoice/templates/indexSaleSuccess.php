<?php include_stylesheets_for_form($pager->getFilter()) ?>
<?php include_javascripts_for_form($pager->getFilter()) ?>

<div class="title">
  <h2><?php echo __('fatture di vendita'); ?></h2>
</div>

<?php include_partial('pager', array('pager' => $pager, 'route' => '@invoice')); ?>

<form action="<?php echo url_for('invoice/batch'); ?>" method="post">


<?php include_partial('invoice/list', array('results' => $pager->getResults(), 'taxes' => $taxes)); ?>
  
<input type="submit" name="delete_button" value="Elimina" onclick="return confirm('Vuoi eliminare le fatture selezionate');" />
</form>

<?php include_partial('pager', array('pager' => $pager, 'route' => '@invoice')); ?>

<?php
  slot('sidebar');
    include_partial('invoice/sidebar');
  end_slot();
?>

<?php
  slot('infobox');
    include_partial('invoice/filter', array('filter' => $pager->getFilter()));
  end_slot();
?>

<?php
  slot('infobox-2');
    include_component('cashflow', 'monitor');
  end_slot();
?>
