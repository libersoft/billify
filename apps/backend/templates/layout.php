<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2000/REC-xhtml1-200000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<?php echo include_http_metas() ?>
<?php echo include_metas() ?>

<?php echo include_title() ?>


<!--[if IE]>
  	<link rel="stylesheet" type="text/css" href="/software/fatture/web/css/all-ie.css" />
<![endif]-->

<link rel="shortcut icon" href="/favicon.ico">

</head>
<body>

<div id="header">
<h1 align="center" style="border-bottom: 3px solid #888">PIM ON-Line - Administrator Back-End</h1>
</div>
<div class="header_date" align="right">
<span id="dateTime"><?php echo format_date(time(),'dd MMMM yyyy - HH:mm'); ?> | <?php if ($sf_user->isAuthenticated()):?><?php echo link_to('ESCI','login/logout')?><?php endif?></span>
</div>

<?php if($sf_user->isAuthenticated()):?>
<div id="hormenu">
<?php //echo include_component_slot('topbar') ?>
</div>
<?php endif?>

<?php if($sf_user->isAuthenticated()):?>
<div id="bread-crumps">
<?php //echo include_component_slot('breadcrumps') ?>
</div>
<?php endif?>


<div id="content">
<?php echo $content ?>
</div>

<div id="footer" style="border-top: 1px solid #888; margin-top: 20px; text-align: center;">
All &copy; Francesco Trucchia 2006
</div>

</body>
</html>
