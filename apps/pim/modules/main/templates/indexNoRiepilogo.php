<h2>PIM Home</h2>

<table width="100%" cellspacing="10">
<tr>
<td width="50%" valign="top">
<fieldset class="normal">
<legend>CLIENTI</legend>
<ul class="home">
<li><?php echo link_to('Inserisci cliente','cliente/edit')?></li>
<li><?php echo link_to('Lista Clienti','cliente/list')?></li>
<li>							 
<?php echo link_to_function('Cerca Cliente',visual_effect('appear','search_form',array('duration'=>0.5)),array('title'=>'Cerca Cliente'))?>
								 
<div id="search_cliente">
<div id="search_form" style="display: none;">
<?php echo form_remote_tag(array('url' => 'cliente/search',
								 'update' => 'lista_clienti',
								 'loading' => "Element.show('indicator')",
								 'complete' => "Element.hide('indicator');Element.hide('search_form');".visual_effect('highlight', 'lista')),array('style'=>'margin: 0px; padding: 0px;'))?>
<?php echo input_tag('string_search',isset($string_search)?$string_search:'','size=20')?>
&nbsp;<?php echo submit_tag('Cerca')?>
</form>
<div id="indicator" style="display: none;"></div>
</div>

<div id="lista_clienti">
</div>

</div>
</li>
</ul>
</fieldset>
</td>
<td width="50%" valign="top">
<fieldset class="normal">
<legend>PRODOTTI</legend>
<ul class="home">
<li><?php echo link_to('Visualizza Prodotti','prodotto/list')?></li>
<li><?php echo link_to('Inserisci Prodotto','prodotto/create')?></li>
</ul>
</fieldset>
</td>
</tr>
<tr></tr>
<td width="50%" valign="top">
<fieldset class="normal">
<legend>FATTURE</legend>
<ul class="home">
<li><?php echo link_to('Visualizza Riepilogo','main/riepilogo')?></li>
<li><?php echo link_to('Emetti fattura','fattura/create')?></li>
<li><?php echo link_to('Lista Fatture','@invoice')?></li>
</ul>
</fieldset>
</td>
<td width="50%" valign="top">
<fieldset class="normal">
<legend>OPZIONI</legend>
<ul class="home">
<li><?php echo link_to('Banche','banca/list')?></li>
<li><?php echo link_to('Tasse','tassa/list')?></li>
<li><?php echo link_to('Temi Fattura','temafattura/list')?></li>
<li><?php echo link_to('Impostazioni','impostazione/edit')?></li>
</ul>
</fieldset>
</td>
</td>
</tr>
</table>