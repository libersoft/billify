<?php if($sf_user->isAuthenticated()):?>
  <div id="breadcrumps">
    <?php echo include_component_slot('breadcrumps') ?>
  </div>
<?php endif?>