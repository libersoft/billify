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

function swf_chart($xml_source, $width = 400, $height = 250, $bg_color="#ffffff")
{
  $flash_file = _compute_public_path('chart', 'swfcharts', 'swf');
  $library_path = dirname($flash_file).DIRECTORY_SEPARATOR;

  $movie = $flash_file.'?library_path='.$library_path.'&amp;php_source='.$xml_source;

  return '<object type="application/x-shockwave-flash" data="'.$movie.'" width="'.$width.'" height="'.$height.'">
  	         <param name="movie" value="'.$movie.'" />
  	         <param name="quality value="high" />
  	         <param name="bgcolor" value="'.$bg_color.'" />
              </object>';

}

?>
