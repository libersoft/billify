<?php if ($pager->haveToPaginate()): ?>
<?php $filters = http_build_query(array('fattura_filters' => $sf_request->getGetParameter('fattura_filters'))); ?>

<div class="pagination">
  <ul>
    
    <li><?php echo link_to('&laquo;', $route, array('query_string' => 'page='.$pager->getFirstPage().'&'.$filters)); ?></li>
    <li><?php echo link_to('&lt;', $route, array('query_string' => 'page='.$pager->getPreviousPage().'&'.$filters)) ?></li>

  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
    <?php $class = ($page == $pager->getPage()) ? 'active': null; ?>
    <li class="<?php echo $class; ?>"><?php echo link_to($page, $route,array('query_string' => 'page='.$page.'&'.$filters)); ?></li>
  <?php endforeach ?>
    
    <li><?php echo link_to('&gt;', $route, array('query_string' => 'page='.$pager->getNextPage().'&'.$filters)); ?></li>
    <li><?php echo link_to('&raquo;', $route, array('query_string' => 'page='.$pager->getLastPage().'&'.$filters)) ?></li>
    
  </ul>
  
</div>
<?php endif ?>
