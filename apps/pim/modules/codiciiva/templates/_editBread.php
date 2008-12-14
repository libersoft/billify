<ul>
<li><em>Sei in:</em></li>
<li><?php echo link_to('Home','main/index')?> &raquo;</li>
<li><?php echo link_to('Codici Iva','codiciiva/list')?> &raquo;</li>
<li><?php echo is_object($codice)?'Modifica codice '.$codice->getNome():'Nuovo codice'?></li>
</ul>