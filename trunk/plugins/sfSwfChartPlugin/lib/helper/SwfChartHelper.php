<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Dustin Whittle <dustin.whittle@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * @package    symfony.runtime.addon
 * @author     Dustin Whittle <dustin.whittle@symfony-project.com>
 * @version    SVN: $Id: sfSwfChart.class.php 1519 2006-06-24 03:44:30Z dwhittle $
 */

  function swf_chart($xml_source, $width=400, $height=250, $bg_color="#ffffff", $transparent = false, $license = null )
  {
    $library_path = sfConfig::get('sf_swfchart_dir', '/swfcharts/');
    $flash_file = $library_path . 'chart.swf';

  	$u = (strpos($flash_file,"?") === false) ? "?" : ((substr($flash_file, -1) === "&") ? "" : "&");

    $license_query = ($license != null) ? '&license=' . $license : '' ;
    $transparent_html = ($transparent) ? '<param name="wmode" value="transparent" />' : '' ;
    $movie = $flash_file.$u.'library_path='.$library_path.'&amp;php_source='.$xml_source.$license_query;

  	return '<object type="application/x-shockwave-flash" data="'.$movie.'" width="'.$width.'" height="'.$height.'" id="chart">
  	         <param name="movie" value="'.$movie.'" />
  	         <param name="quality value="high" />
  	         <param name="bgcolor" value="'.$bg_color.'" />'
  	         . $transparent_html.
  	        '</object>';

  }

?>
