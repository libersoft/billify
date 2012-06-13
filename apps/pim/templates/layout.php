<?php use_helper('jQuery')?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2000/REC-xhtml1-200000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans|Droid+Sans+Mono|Sansita+One' rel='stylesheet' type='text/css'>

<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<?php include_stylesheets() ?>
<?php include_javascripts() ?>

<!--[if IE]>
  	<link rel="stylesheet" type="text/css" href=<?php echo url_for("css/impress/main-msie.css.css")?>" />
<![endif]-->

</head>
<body>
<?php echo include_partial('global/topbar'); ?>

<div id="main">
  <?php echo include_partial('global/bread') ?>

  <div id="cols2" class="box">
    <div id="col-left">
      <?php echo $sf_content ?>
    </div>
    <hr class="noscreen"/>
    <?php echo include_partial('global/sidebar') ?>
  </div>

  <div id="footer">
    <?php echo include_partial('global/footer') ?>
  </div>
</div>
</body>
</html>
