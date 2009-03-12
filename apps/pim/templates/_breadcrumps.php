<ul>
  <li><em><?php echo __('You are in')?>:</em></li>
  <?php foreach($items as $index => $item): ?>
    <li><?php echo $item ?> <?php echo ($index == count($items) - 1) ? '' : '&raquo;' ?></li>
  <?php endforeach; ?>
</ul>