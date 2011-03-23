<?php if ($pager->haveToPaginate()): ?>
<?php $filters=http_build_query(array('fattura_filters' => $sf_request->getGetParameter('fattura_filters'))); ?>

<div class="navigator"><?php echo __('Pagina') ?> <?php echo $pager->getPage()?> di <?php echo $pager->getLastPage();?>&nbsp;&nbsp;
  <?php echo link_to('&laquo;','@fatture_acquisto', array('query_string' => 'page='.$pager->getFirstPage().'&'.$filters)); ?>
  <?php echo link_to('&lt;','@fatture_acquisto', array('query_string' => 'page='.$pager->getPreviousPage().'&'.$filters)) ?>

  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $pager->getPage()) ? "<strong>$page</strong>" : link_to($page, '@fatture_acquisto',array('query_string' => 'page='.$page.'&'.$filters)) ?>
  <?php endforeach ?>
  
  <?php echo link_to('&gt;','@fatture_acquisto', array('query_string' => 'page='.$pager->getNextPage().'&'.$filters)); ?>
  <?php echo link_to('&raquo;','@fatture_acquisto', array('query_string' => 'page='.$pager->getNextPage().'&'.$filters)) ?>
</div>
<?php endif ?>
