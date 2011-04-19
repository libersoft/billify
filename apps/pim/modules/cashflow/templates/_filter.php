<?php include_stylesheets_for_form($filter) ?>
<?php include_javascripts_for_form($filter) ?>

<div class="title">
   <h4><?php echo __('filtro')?></h4>
</div>

<form action="<?php echo url_for($filter->getRoute()); ?>" method="get">
  <?php echo $filter; ?>
  <hr/>
  <div class="button-block">
    <input class="button" type="submit" value="Filtra" />
  </div>
</form>