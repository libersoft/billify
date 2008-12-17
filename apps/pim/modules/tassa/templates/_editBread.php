<ul>
<li><em>Sei in:</em></li>
<li><?php echo link_to('Home','main/index')?> &raquo;</li>
<li><?php echo link_to('Tasse','tassa/list')?> &raquo;</li>
<li><?php echo is_object($tassa)?'Modifica '.$tassa->getNome():'Nuova tassa'?></li>
</ul>