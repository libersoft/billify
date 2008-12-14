<?php if($sf_user->isAuthenticated() && UtentePeer::countGiorniDemoRimasti() <= 0 && $sf_context->getActionName() != 'upgrade'):?>
<div id="update-profile" class="update-profile">
<p><strong class="red">Il periodo di prova &egrave; terminato!!</strong></p>
<p><?php echo link_to('Per continuare ad utilizzare il servizio devi iscriverti al servizio base o pro','utente/upgrade')?>.</p>
</div>
<?php endif?>