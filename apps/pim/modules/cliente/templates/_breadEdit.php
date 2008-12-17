<ul>
<li><em>Sei in:</em></li>
<li><?php echo link_to('Home','main/index')?> &raquo;</li>
<li><?php echo link_to('Cliente','cliente/index')?> &raquo;</li>
<?php if(isset($cliente)):?>
<li><?php echo link_to($cliente->toString(),'cliente/show?id='.$cliente->getID())?> &raquo;</li>
<li>Modifica</li>
<?php else:?>
<li>Nuovo</li>
<?php endif?>
</ul>