<ul>
<li><em>Sei in:</em></li>
<li><?php echo link_to('Home','main/index')?> &raquo;</li>
<li><?php echo link_to('Pagamento','modipagamento/list')?> &raquo;</li>
<?php if($pagamento):?>
<li>Modifica tipologia <?=$pagamento->getDescrizione()?></li>
<?php else:?>
<li>Nuova tipologia</li>
<?php endif?>
</ul>