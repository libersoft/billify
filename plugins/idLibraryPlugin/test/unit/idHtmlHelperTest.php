<?php
include(dirname(__FILE__).'/../bootstrap/unit.php');
require_once dirname(__FILE__).'/../../plugins/idLibrary/lib/helper/idHtmlHelper.php';

$t = new lime_test(2, new lime_output_color());
$t->comment('blankSpaceIfNull()');

$t->is(blankSpaceIfNull(null), '&nbsp;', 'blankSpaceIfNull() return &nbsp; if pass null value');
$t->is(blankSpaceIfNull('test'), 'test', 'blankSpaceIfNull() return the value if pass not null value');

?>
