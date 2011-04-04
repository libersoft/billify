<?php if (has_slot('infobox')) : ?>
  <div id="col-right" class="first box">
    <?php echo get_slot('infobox') ?>
  </div>
<?php endif ?>

<?php if (has_slot('infobox-2')) : ?>
  <div id="col-right" class="box">
    <?php echo get_slot('infobox-2') ?>
  </div>
<?php endif ?>

<?php if (has_slot('sidebar')) : ?>
  <div id="col-right">
    <?php echo get_slot('sidebar') ?>
  </div>
<?php endif ?>