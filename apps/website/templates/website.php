<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta http-equiv="content-language" content="en" />
  <meta name="robots" content="all,follow" />

  <meta name="author" lang="en" content="All: Francesco Trucchia [www.cphp.it]; e-mail: ft@ideato.it" />
  <meta name="copyright" lang="en" content="Webdesign: Nuvio [www.nuvio.cz]; e-mail: ahoj@nuvio.cz" />

  <!--[if lte IE 6]><link rel="stylesheet" type="text/css" href="css/impress/main-msie.css" /><![endif]-->

  <title>Billify - Simplify business management</title>

  <?php include_stylesheets() ?>
  <?php include_javascripts() ?>

  <script type="text/javascript">
  $(function() {
    // Use this example, or...
    $('a[@rel*=lightbox]').lightBox(); // Select all links that contains lightbox in the attribute rel
  });
  </script>
</head>

<body>

<div id="main">
    <div id="header">
        <h1 id="logo"><a href="./" title="[Go to homepage]"><img src="<?php echo image_path('impress/logo.gif')?>" alt="" /></a></h1>
        <hr class="noscreen" />
        <div id="nav">
            <a href="<?php echo url_for('@homepage')?>" id="nav-active">Home</a> <span>|</span>
            <a href="http://www.ideato.it/Azienda/Chi-siamo" target="_blank"><?php echo __('About')?></a> <span>|</span>
            <!--a href="<?php echo url_for('@content?page=support')?>"><?php echo __('Support')?></a> <span>|</span-->
            <a href="http://www.ideato.it/Azienda/Contatti" target="_blank"><?php echo __('Contat us')?></a>
        </div>
    </div>
    
    <div id="tray">
        <ul>
            <li><a href="<?php echo url_for('@content?page=demo')?>">Demo</a></li>
            <li><a href="<?php echo url_for('@content?page=download')?>">Download</a></li>
        </ul>
    <hr class="noscreen" />
    </div>

    <div id="col-top"></div>
    <div id="col" class="box">
        <div id="ribbon"></div>
        <div id="col-browser"><a href="<?php echo image_path('screenshot/dashboard.jpg')?>" rel="lightbox"><img src="<?php echo image_path('screenshot/thumb_dashboard.jpg')?>" width="255" height="177" alt="" /></a></div>
        <div id="col-text">
	  <?php echo $sf_content; ?>
        </div>
    </div>
    <div id="col-bottom"></div>

    <hr class="noscreen" />

    <div id="cols3-top"></div>
    <div id="cols3" class="box">
        <div class="col">
            <h3><?php echo __('Address book')?></h3>
            
            <div class="col-text">
              <p><?php echo __('Manage your contacts. Both clients than providers.')?></p>
              
              <ul class="ul-01">
                <li><?php echo __('Manage clients contacts')?></li>
                <li><?php echo __('Manage providers contacts')?></li>
              </ul>
            </div>

        </div>

        <hr class="noscreen" />

        <div class="col">
            <h3><?php echo __('Payments and invoices')?></h3>
            
            <div class="col-text">
              <p><?php echo __('Manage your business documents. Both purchase than sales invoices.')?></p>
              
              <ul class="ul-01">
                <li><?php echo __('Manage purchase invoices')?></li>
                <li><?php echo __('Manage sales invoices')?></li>
                <li><?php echo __('Manage payment details')?></li>
              </ul>
            </div>
            
        </div>

        <hr class="noscreen" />

        <div class="col last">
            <h3><?php echo __('Cash flow')?></h3>
            
            <div class="col-text">
              <p><?php echo __('Manage your incoming and outcoming flow.')?></p>
              
              <ul class="ul-01">
                <li><?php echo __('Manage incoming documents')?></li>
                <li><?php echo __('Manage outcoming documents')?></li>
                <li><?php echo __('Filter on cash flow')?></li>
              </ul>
            </div>
            
        </div>
        <hr class="noscreen" />
    </div>
    <div id="cols3-bottom"></div>

    <div id="cols2-top"></div>
    <div id="cols2" class="box">

        <div id="col-left">
            <div class="title">
                <h4><?php echo __('Some screenshot from billify')?></h4>
            </div>

            <ul class="ul-list nomb list-images">
                <li><a href="<?php echo image_path('screenshot/invoice.jpg')?>" rel="lightbox"><img src="<?php echo image_path('screenshot/thumb_invoice.jpg')?>" width="170" alt="" /></a></li>
                <li><a href="<?php echo image_path('screenshot/cashflow.jpg')?>" rel="lightbox"><img src="<?php echo image_path('screenshot/thumb_cashflow.jpg')?>" width="170" alt="" /></a></li>
                <li><a href="<?php echo image_path('screenshot/stats.jpg')?>17" rel="lightbox"><img src="<?php echo image_path('screenshot/thumb_stats.jpg')?>" width="170" alt="" /></a></li>
            </ul>
        </div>

        <hr class="noscreen" />

        <div id="col-right">
            <h4><span><?php echo __('From web')?></span></h4>

            <div class="box">
                    <p><em>
                    <?php echo __('With Billify we manage all business tasks. With this product we have always the updated real time financial situation.');?>
                    </em></p>
                    <p class="high smaller">&ndash; <cite>Francesco Trucchia, ideato srl</cite></p>
            </div>
        </div>

    </div>
    <div id="cols2-bottom"></div>

    <hr class="noscreen" />

    <!-- Footer -->
    <div id="footer">

        <!-- Do you want remove this backlinks? Look at www.nuviotemplates.com/payment.php -->
        <p class="f-right"><a href="http://www.nuviotemplates.com/">Free web templates</a> presented by <a href="http://www.qartin.cz/">QARTIN</a> &ndash; Our tip: <a href="http://last-minute.invia.pl">Wakacje</a> <a href="http://dovolenka.invia.sk">Dovolenka</a></p>
        <!-- Do you want remove this backlinks? Look at www.nuviotemplates.com/payment.php -->

        <p>Copyright &copy;&nbsp;2009 <strong><a href="http://www.ideato.it">ideato srl</a></strong>, All Rights Reserved &reg;</p>

    </div>

</div>

</body>
</html>
