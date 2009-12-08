<div class="navigator">
  <?php for($i = 1; $i <= $pager->getCountPages(); $i++) :?>
    <a <?php echo $i==$pager->getPage()?'class="selected"':''?> href="?page=<?php echo $i?>"><?php echo $i ?></a>
  <?php endfor;?>
  <a href="?page=all">Visualizza tutte</a>
</div>