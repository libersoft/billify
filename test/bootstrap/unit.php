<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!isset($app)) {
  $app = 'pim';
}

$_test_dir = realpath(dirname(__FILE__).'/..');
define('SF_ROOT_DIR', realpath($_test_dir.'/..'));
define('SF_APP',         $app);
define('SF_ENVIRONMENT', 'test');
define('SF_DEBUG', true);

// symfony directories
require(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

require_once($sf_symfony_lib_dir.'/util/sfCore.class.php');

sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);

require_once($sf_symfony_lib_dir.'/vendor/lime/lime.php');

set_include_path(get_include_path().':'.SF_ROOT_DIR . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'vendor');

