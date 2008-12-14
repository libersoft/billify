<ul>
<li><em>Sei in:</em></li>
<li><?php echo link_to('Home','main/index')?> &raquo;</li>
<li><?php echo link_to('Bug','bug/index')?> &raquo;</li>
<?php if(isset($bug)):?>
<li>Modifica</li>
<?php else:?>
<li>Nuovo</li>
<?php endif?>
</ul>