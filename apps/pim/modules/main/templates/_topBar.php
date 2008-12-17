<?php if((!$sf_user->isAuthenticated() && ($sf_context->getModuleName() != 'login')) or $sf_context->getModuleName() == 'sito'):?>
<ul>
<li class="home"><?php echo link_to('Che cos\'&egrave;','/')?>
<li><?php echo link_to('Chi Siamo','@pagina?titolo=chi-siamo')?></li>
<li><?php echo link_to('FAQ','@pagina?titolo=faq')?></li>
<li><?php echo link_to('Contatti','@pagina?titolo=contatti')?></li>
<li><?php echo link_to('Blog','http://www.personal-invoice-manager.net')?></li>
<?php if(!$sf_user->isAuthenticated()):?>
<li><?php echo link_to('Login','login')?></li>
<?php else:?>
<li><?php echo link_to('Torna a PIM','main/index')?></li>
<?php endif?>
</ul>
<?php elseif($sf_user->isAuthenticated()):?>
<ul>
<li class="home"><?php echo link_to('Bacheca','main/index')?>

<?php if(!UtentePeer::getImpostazione()->getBoolRiepilogoHome()):?>
<ul>
<li><?php echo link_to('Riepilogo','main/riepilogo')?></li>
</ul>
<?php endif?>
</li>

<li><?php echo link_to('Clienti','cliente/index')?>
	<ul>
	<li><?php echo link_to('Crea Nuovo','cliente/create')?></li>
	<li><?php echo link_to('Cerca','cliente/list')?></li>
	</ul>
</li>

<li><?php echo link_to('Prodotti','prodotto/index')?>
	<ul>
	<li><?php echo link_to('Crea Nuovo','prodotto/create')?> </li>
	</ul>
</li>

<li><?php echo link_to('Fatture','fattura/index')?>
	<ul>
	<li><?php echo link_to('Crea Nuova','fattura/create')?> </li>
	<li><?=link_to('Tags','fattura/tags')?></li>
	<li><?php echo link_to('Cerca','fattura/list')?></li>
	</ul>
</li>

<li><?php echo link_to('Statistiche', 'statistiche/index')?></li>

<li><a>Opzioni</a>
	<ul>
	<!--li><?php echo link_to('Profilo','utente/edit')?></li-->
	<li><?php echo link_to('Banche','banca/list')?>
	<ul><li><?php echo link_to('Crea Nuova','banca/create')?></li></ul>
	</li>
	<li><?php echo link_to('Tasse','tassa/list')?>
	<ul><li><?php echo link_to('Crea Nuova','tassa/create')?></li></ul>
	</li>
	<li><?php echo link_to('Pagamenti','modipagamento/index')?>
	<ul><li><?php echo link_to('Crea Nuovo','modipagamento/create')?></li></ul>
	</li>
	<li><?php echo link_to('Codici Iva','codiciiva/index')?>
	<ul><li><?php echo link_to('Crea Nuovo','codiciiva/create')?></li></ul>
	</li>
	<li><?php echo link_to('Temi Fattura','temafattura/list')?>
	<ul><li><?php echo link_to('Crea Nuovo','temafattura/create')?></li></ul>
	</li>
	<li><?php echo link_to('Impostazioni','impostazione/edit')?> </li>
	</ul>
</li>
</ul>
<?php endif?>
