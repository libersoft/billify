<?php if($utente->getTipo() == Utente::DEMO ):?>
<h2>Il periodo di prova &egrave; terminato!!</h2>
<p><?php echo link_to('Per continuare ad utilizzare il servizio devi iscriverti al servizio base o pro','utente/upgrade')?>.</p>
<?php else:?>
<h2>La tua iscrizione &egrave; scaduta!!</h2>
<p><?php echo link_to('Rinnova la tua iscrizione per continuare ad usufruire dei servizi PIM On-Line','utente/upgrade')?>.
Non rinnovando l'iscrizione, avrai comunque accesso ai tuoi dati, ma non potrai creare nuove fatture ed esportarle.</p>
<?php endif?>