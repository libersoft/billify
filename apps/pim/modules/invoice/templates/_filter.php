
<div class="title">
   <h4><?php echo __('filtro')?></h4>
</div>

<form action="<?php echo url_for('@invoice_purchase'); ?>" method="get">
  <ul class="ul-list nomb">
    <li><?php echo $filter['data']->render(); ?></li>
    <li><?php echo $filter['stato']->render(); ?></li>
  </ul>
  <?php echo $filter->renderHiddenFields(); ?>
  <?php //echo $filter; ?>
  <input type="submit" value="Filtra" />
  <a href="<?php echo url_for('@invoice_purchase'); ?>" >Reset</a>
</form>