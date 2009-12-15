<?php //use_helper('Number','Javascript','Date')?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/2000/REC-xhtml1-200000126/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">
<head>

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
<div id="main">
  <div id="header">
    <h1 id="logo"><a href="<?php echo url_for('@homepage')?>" title="[<?php echo __('go to homepage')?>]"><?php echo image_tag('impress/logo.gif')?></a></h1>
    <hr class="noscreen"/>

    <?php echo include_partial('global/userbar') ?>
  </div>

  <div id="tray">
    <?php echo include_partial('global/topbar') ?>
  </div>

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
