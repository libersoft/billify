<?php //use_helper('Number','Javascript','Date')?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2000/REC-xhtml1-200000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>

<?php echo include_http_metas() ?>
<?php echo include_metas() ?>

<?php echo include_title() ?>


<!--[if IE]>
  	<link rel="stylesheet" type="text/css" href="/progetti/pim/web/css/all-ie.css" />
<![endif]-->

<link rel="shortcut icon" href="/favicon.ico">

</head>
<body>

<div id="header-top">

<?php if($sf_user->isAuthenticated()):?>
  <div class="user-board">
    Benvenuto, <?php echo $sf_user->getAttribute('nome').' '.$sf_user->getAttribute('cognome')?>&nbsp;
    <?php echo link_to('Mio Profilo','utente/edit')?> | <span class="logout"><?php echo link_to('Esci','login/logout')?></span>
  </div>
<?php endif?>

<?php echo link_to(image_tag('logo.jpg'),($sf_user->isAuthenticated()?'main/index':'main/index'))?>

</div>

<div class="header_date" align="right">
  <span id="dateTime"><?php echo format_date((time()/*+(9*3600)*/),'dd MMMM yyyy - HH:mm'); ?></span>
</div>

<div id="hormenu">
  <?php echo include_component_slot('topbar') ?>
</div>

<?php if($sf_user->isAuthenticated()):?>
  <div id="bread-crumps">
    <?php echo include_component_slot('breadcrumps') ?>
  </div>
<?php endif?>


<div id="content">
  <?php echo $sf_content ?>
</div>


<div id="footer">
All &copy; ideato srl 2006 - <?php echo date('Y')?>
</div>

</body>
</html>
