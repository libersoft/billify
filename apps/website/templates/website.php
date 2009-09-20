<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="en" />
    <meta name="robots" content="all,follow" />

    <meta name="author" lang="en" content="All: Francesco Trucchia [www.cphp.it]; e-mail: ft@ideato.it" />
    <meta name="copyright" lang="en" content="Webdesign: Nuvio [www.nuvio.cz]; e-mail: ahoj@nuvio.cz" />

    <!--[if lte IE 6]><link rel="stylesheet" type="text/css" href="css/impress/main-msie.css" /><![endif]-->

    <title>phpAccount - Simplify business management</title>
</head>

<body>

<div id="main">
    <div id="header">
        <h1 id="logo"><a href="./" title="[Go to homepage]"><img src="/images/impress/logo.gif" alt="" /></a></h1>
        <hr class="noscreen" />
        <div id="nav">
            <a href="/" id="nav-active">Home</a> <span>|</span>
            <a href="http://www.ideato.it/Azienda/Chi-siamo" target="_blank"><?php echo __('About')?></a> <span>|</span>
            <a href="<?php echo url_for('@content?page=support')?>"><?php echo __('Support')?></a> <span>|</span>
            <a href="http://www.ideato.it/Azienda/Contatti" target="_blank"><?php echo __('Contat us')?></a>
        </div>
    </div>
    
    <div id="tray">
        <ul>
            <li><a href="/billify.php" target="_blank">Demo</a></li>
            <li><a href="<?php echo url_for('@download')?>">Download</a></li>
        </ul>
    <hr class="noscreen" />
    </div>

    <div id="col-top"></div>
    <div id="col" class="box">
        <div id="ribbon"></div>
        <div id="col-browser"><img src="/images/screenshot/dashboard.jpg" width="255" height="177" alt="" /></div>
        <div id="col-text">
	  <?php echo $sf_content; ?>
        </div>
    </div>
    <div id="col-bottom"></div>

    <hr class="noscreen" />

    <div id="cols3-top"></div>
    <div id="cols3" class="box">
        <div class="col">
            <h3><a href="#"><?php echo __('Address book')?></a></h3>

            <!--p class="nom t-center"><a href="#"><img src="tmp/200x140.gif" alt="" /></a></p-->

            <!--div class="col-text">

                <p>Lorem ipsum dolor sit amet <a href="#">consectetuer</a> amit adipiscing elit. <strong>Nunc feugiat.</strong>
                Inam massa est feugiat <a href="#">pharetra</a> lacus. In non arcu nec liberom pharetra rutrum est.</p>

                <ul class="ul-01">
                    <li>Provider contacts</li>
                    <li>Customer contacts</li>
                </ul>

            </div--> <!-- /col-text -->

            <!--div class="col-more"><a href="#"><img src="design/cols3-more.gif" alt="" /></a></div-->
        </div>

        <hr class="noscreen" />

        <div class="col">
            <h3><a href="#"><?php echo __('Payments and invoices')?></a></h3>
        </div>

        <hr class="noscreen" />

        <div class="col last">
            <h3><a href="#"><?php echo __('Cash flow')?></a></h3>
            <!--p class="nom t-center"><a href="#"><img src="tmp/200x140.gif" alt="" /></a></p-->
        </div>
        <hr class="noscreen" />
    </div>
    <div id="cols3-bottom"></div>
<!--
    <div id="cols2-top"></div>
    <div id="cols2" class="box">

        <div id="col-left">
            <div class="title">
                <span class="f-right"><a href="#" class="ico-rss">RSS feed</a></span>
                <h4><?php echo __('Latest news')?></h4>
            </div>

            <ul class="ul-list nomb">
                <li><span class="f-right"><a href="#" class="ico-comment">1 commento</a></span> <span class="date">27.09.2008</span> <a href="#" class="article">L'amministrazione aziendale si fa Open Source</a></li>
                <li><span class="f-right"><a href="#" class="ico-comment">0 commenti</a></span> <span class="date">27.09.2008</span> <a href="#" class="article">Completata la suite dei test automatici</a></li>
                <li><span class="f-right"><a href="#" class="ico-comment">0 commenti</a></span> <span class="date">27.09.2008</span> <a href="#" class="article">Dalle ceneri di PIM Online nasce Billify</a></li>
            </ul>
        </div>

        <hr class="noscreen" />

        <div id="col-right">
            <h4><span><?php echo __('From web')?></span></h4>

            <div class="box">
                    <p><em>Con Billify gestiamo tutta l'amministrazione dell'azienda. Con questo prodotto abbiamo sempre in tempo reale la situazione finanziare.</em></p>
                    <p class="high smaller">&ndash; <cite>Francesco Trucchia, ideato srl</cite></p>
            </div>
        </div>

    </div>
    <div id="cols2-bottom"></div>
-->
    <hr class="noscreen" />

    <!-- Footer -->
    <div id="footer">

        <!-- Do you want remove this backlinks? Look at www.nuviotemplates.com/payment.php -->
        <p class="f-right"><a href="http://www.nuviotemplates.com/">Free web templates</a> presented by <a href="http://www.qartin.cz/">QARTIN</a> &ndash; Our tip: <a href="http://last-minute.invia.pl">Wakacje</a> <a href="http://dovolenka.invia.sk">Dovolenka</a></p>
        <!-- Do you want remove this backlinks? Look at www.nuviotemplates.com/payment.php -->

        <p>Copyright &copy;&nbsp;2009 <strong><a href="#">ideato srl</a></strong>, All Rights Reserved &reg;</p>

    </div>

</div>

</body>
</html>
