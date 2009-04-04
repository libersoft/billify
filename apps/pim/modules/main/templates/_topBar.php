<?php if($sf_user->isAuthenticated()):?>
<ul>
<li class="home"><?php echo link_to('Bacheca','main/index')?>

<?php if(!UtentePeer::getImpostazione()->getBoolRiepilogoHome()):?>
<ul>
<li><?php echo link_to('Riepilogo','main/riepilogo')?></li>
</ul>
<?php endif?>
</li>

<li><?php echo link_to('Contatti','@customer')?>
  <ul>
    <li><?php echo link_to('Clienti','@customer')?>
      <ul>
      <li><?php echo link_to('Crea Nuovo','@customer_create')?></li>
      <!--li><?php echo link_to('Cerca','@customer')?></li-->
      </ul>
    </li>

    <li><?php echo link_to('Fornitori','@provider')?>
      <ul>
        <li><?php echo link_to('Crea Nuovo','@provider_create')?></li>
      </ul>
    </li>
  </ul>
</li>


<li><?php echo link_to('Prodotti','prodotto/index')?>
	<ul>
	<li><?php echo link_to('Crea Nuovo','prodotto/create')?> </li>
	</ul>
</li>

<li><?php echo link_to('Fatture', '/#')?>
<ul>
  <li><?php echo link_to('Vendita', 'fattura/index')?>
    <ul>
      <li><?php echo link_to('Crea Nuova','fattura/create')?> </li>
      <li><?=link_to('Tags','fattura/tags')?></li>
      <li><?php echo link_to('Cerca','fattura/list')?></li>
    </ul>
  </li>

  <li><?php echo link_to('Acquisto', '@fatture_acquisto')?>
    <ul>
      <li><?php echo link_to('Crea Nuova', '@fatture_acquisto_create')?> </li>
    </ul>
  </li>
</ul>

<li><?php echo link_to('Cash Flow', 'cashflow/index')?>
  <ul>
    <li><?php echo link_to(__('Nuova entrata'), '@document_sales_create')?></li>
    <li><?php echo link_to(__('Nuova uscita'), '@document_purchase_create')?></li>
  </ul>
</li>

<li><?php echo link_to('Statistiche', 'statistiche/index')?></li>

<li><a>Opzioni</a>
	<ul>
	<!--li><?php echo link_to('Profilo', 'utente/edit')?></li-->
	<li><?php echo link_to(__('Banks'), 'bank/index')?>
	<ul><li><?php echo link_to(__('New'), 'bank/new')?></li></ul>
	</li>
	<li><?php echo link_to('Tasse', 'tax/index')?>
	<ul><li><?php echo link_to('Crea Nuova', 'tax/new')?></li></ul>
	</li>
	<li><?php echo link_to('Pagamenti', 'modipagamento/index')?>
	<ul><li><?php echo link_to('Crea Nuovo','modipagamento/create')?></li></ul>
	</li>
	<li><?php echo link_to('Codici iva', 'taxescode/index')?>
	<ul><li><?php echo link_to('Crea Nuovo','taxescode/new')?></li></ul>
	</li>
	<li><?php echo link_to('Temi Fattura', 'temafattura/list')?>
	<ul><li><?php echo link_to('Crea Nuovo','temafattura/create')?></li></ul>
	</li>
	<li><?php echo link_to('Impostazioni', 'impostazione/edit')?> </li>
	</ul>
</li>
</ul>
<?php endif?>
