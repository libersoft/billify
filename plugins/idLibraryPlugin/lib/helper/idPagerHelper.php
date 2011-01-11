<?php

function pager($pager, $request, $options = array())
{
  $class = '';
  if(isset($options['class']))
  {
    $class = ' '.$options['class'];
  } 

  $output = '<div class="paging'.$class.'">';

  if ($pager->haveToPaginate()) {

    $parameters = $request->getParameterHolder()->getAll();
    
    if(method_exists($parameters, 'getRawValue')) 
    {
      $parameters = $parameters->getRawValue();
    }
    
    $module = $parameters['module'];
    $action = $parameters['action'];

    $page = '';
    if (isset($parameters['page'])) {
      $page = $parameters['page'];
    }
    $parameters = array_diff_key($parameters, array('page' => $page, 'module' => $module, 'action' => $action));

    $url = $module.'/'.$action.'?'.http_build_query($parameters).'&page=';
    
    $output .= link_to(__('&laquo;'), $url.$pager->getFirstPage(), array('class' => 'first'));
    $output .= link_to(__('&lt;'), $url.$pager->getPreviousPage(), array('class' => 'prev'));
    
    foreach ($pager->getLinks() as $page) {
      $output .= link_to_unless($page == $pager->getPage(), $page, $url.$page, array('title' => $page));
    }

    $output .= link_to(__('&gt;'), $url.$pager->getNextPage(), array('class' => 'next'));
    $output .= link_to(__('&raquo;'), $url.$pager->getLastPage(), array('class' => 'next'));

  }
  $output .= '</div>';

  return $output;
}
?>