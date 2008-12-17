<ul>
<li><em>Sei in:</em></li>
<li><?php echo link_to('Home','main/index')?> &raquo;</li>
<li><?php echo link_to('Banche','banca/list')?> &raquo;</li>
<li><?php echo is_object($banca)?'Modifica '.$banca->getNomeBanca():'Nuova banca'?></li>
</ul>