<ul>
<li><em>Sei in:</em></li>
<li><?php echo link_to('Home','main/index')?> &raquo;</li>
<li><?php echo link_to('Temi Fattura','temafattura/list')?> &raquo;</li>
<?php if($temafattura) :?>
<li>Modifica <?php echo $temafattura->getNome()?></li>
<?php else: ?>
<li>Nuovo tema Fattura</li>
<?php endif?>
</ul>