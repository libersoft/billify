<?php if ($pager->haveToPaginate()): ?>
  <div class="pagination">
    <ul>
    <?php for($i = 1; $i <= $pager->getCountPages(); $i++) :?>
      <li <?php echo $i==$pager->getPage()?'class="active" ':''?>><a href="?page=<?php echo $i?>"><?php echo $i ?></a></li>
    <?php endfor;?>
      <li><a href="?page=all">Visualizza tutte</a></li>
    </ul>
  </div>
<?php endif; ?>