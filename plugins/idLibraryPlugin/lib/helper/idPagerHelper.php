<?php

function pager($pager, $request, $options = array())
{
  $class = '';
  if(isset($options['class']))
  {
    $class = ' '.$options['class'];
  } 

  $output = '<div class="'.$class.'">';

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
    
    $output .= '<li>'.link_to(__('&laquo;'), $url.$pager->getFirstPage(), array('class' => 'first').'</li>');
    $output .= '<li>'.link_to(__('&lt;'), $url.$pager->getPreviousPage(), array('class' => 'prev')).'</li>';
    
    foreach ($pager->getLinks() as $page) {
      $output .= '<li class="'. (($page == $pager->getPage())?' active ': null ).'">'.link_to($page, $url.$page, array('title' => $page)).'</li>';
    }

    $output .= '<li>'.link_to(__('&gt;'), $url.$pager->getNextPage(), array('class' => 'next')).'</li>';
    $output .= '<li>'.link_to(__('&raquo;'), $url.$pager->getLastPage(), array('class' => 'next')).'</li>';

  }
  $output .= '</div>';

  return $output;
}
?>