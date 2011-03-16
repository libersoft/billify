<?php if ($pager->haveToPaginate()): ?>
<div class="navigator"><?php echo __('Pagina') ?> <?php echo $pager->getPage()?> di <?php echo $pager->getLastPage();?>&nbsp;&nbsp;
  <?php echo link_to('&laquo;','@fatture_acquisto?page='.$pager->getFirstPage()) ?>
  <?php echo link_to('&lt;','@fatture_acquisto?page='.$pager->getPreviousPage()) ?>

  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $pager->getPage()) ? "<strong>$page</strong>" : link_to($page, '@fatture_acquisto?page='.$page) ?>
  <?php endforeach ?>
  
  <?php echo link_to('&gt;','@fatture_acquisto?page='.$pager->getNextPage()) ?>
  <?php echo link_to('&raquo;','@fatture_acquisto?page='.$pager->getLastPage()) ?>
</div>
<?php endif ?>