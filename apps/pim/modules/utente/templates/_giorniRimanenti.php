<?php if($sf_user->getAttribute('tipo_utente') == Utente::DEMO && $sf_user->isAuthenticated()):?>
Giorni rimanenti: <?php echo intval(UtentePeer::countGiorniDemoRimasti())?> |
<?php endif?>
