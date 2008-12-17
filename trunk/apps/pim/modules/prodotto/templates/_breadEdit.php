<ul>
<li><em>Sei in:</em></li>
<li><?php echo link_to('Home','main/index')?> &raquo;</li>
<li><?php echo link_to('Prodotti','prodotto/index')?> &raquo;</li>
<?php if(isset($prodotto)):?>
<li><?php echo link_to($prodotto,'prodotto/show?id='.$prodotto->getID())?> &raquo;</li>
<li>Modifica</li>
<?php else:?>
<li>Nuovo</li>
<?php endif?>
</ul>