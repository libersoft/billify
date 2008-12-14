<ul>
<li><em>Sei in:</em></li>
<li><?php echo link_to('Home','main/index')?> &raquo;</li>
<li><?php echo link_to('Fatture','fattura/list')?> &raquo;</li>
<?php if(isset($fattura)):?>
<li><?php echo link_to($fattura->toString(),'fattura/show?id='.$fattura->getId())?> &raquo;</li>
<li>Modifica</li>
<?php else:?>
<li>Nuova</li>
<?php endif?>
</ul>