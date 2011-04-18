<?php include_stylesheets_for_form($filter) ?>
<?php include_javascripts_for_form($filter) ?>

<div class="filter">
  <form method="get">
    <?php echo $filter ?>
    <input type="submit" value="<?php echo __('Filter')?>" />
  </form>
</div>