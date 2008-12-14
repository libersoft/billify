
<p><div class="search"><?php echo isset($string_search)?'Stringa cercata: <strong>'.$string_search.'</strong>':''?></div>

<?php $results = $pager->getResults()?>

<?php if(count($results)>0):?>
<p><ul id="lista">
<?php foreach ($results as $cliente): ?>
<li class="">
<div style="float: right"><?php echo format_currency($cliente->getTotaleFatture($sf_request->getParameter('year')),'&euro;')?> (<?php echo link_to($cliente->countFatturas(),'fattura/create?id_cliente='.$cliente->getID(),array('title'=>'Nuova Fattura'))?>)</div>
<strong><?php echo link_to($cliente->toString(), 'cliente/show?id='.$cliente->getId()) ?></strong>
 - <?php echo $cliente->getCitta()?> (<?php echo $cliente->getProvincia() ?>)
</li>
<?php endforeach ?>
</ul></p>

<div class="navigator">
<?php if ($pager->haveToPaginate()): ?>

  <?php echo link_to_remote('&laquo;',array('url'=>'cliente/search?page='.$pager->getFirstPage().(isset($string_search)?'&string_search='.$string_search:''),
  											'update'=>'lista_clienti',
  											'loading' => "Element.show('indicator')",
								 			'complete' => "Element.hide('indicator');".visual_effect('highlight', 'lista'))) ?>
  											
  <?php echo link_to_remote('&lt;',array('url' => 'cliente/search?page='.$pager->getPreviousPage().(isset($string_search)?'&string_search='.$string_search:''),
  										 'update'=>'lista_clienti',
  										 'loading' => "Element.show('indicator')",
								 		 'complete' => "Element.hide('indicator');".visual_effect('highlight', 'lista'))) ?>
								 		 
  <?php $links = $pager->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $pager->getPage()) ? $page : link_to_remote($page, array('url' => 'cliente/search?page='.$page.(isset($string_search)?'&string_search='.$string_search:''),
    																			  'update'=>'lista_clienti',
  										 										  'loading' => "Element.show('indicator')",
								 		 										  'complete' => "Element.hide('indicator');".visual_effect('highlight', 'lista'))) ?>
    <?php if ($page != $pager->getCurrentMaxLink()): ?><?php endif ?>
  <?php endforeach ?>
  <?php echo link_to_remote('&gt;',array('url' => 'cliente/search?page='.$pager->getNextPage().(isset($string_search)?'&string_search='.$string_search:''),
  										 'update'=>'lista_clienti',
  										 'loading' => "Element.show('indicator')",
								 		 'complete' => "Element.hide('indicator');".visual_effect('highlight', 'lista'))) ?>
  <?php echo link_to_remote('&raquo;',array('url' => 'cliente/search?page='.$pager->getLastPage().(isset($string_search)?'&string_search='.$string_search:''),
  										 'update'=>'lista_clienti',
  										 'loading' => "Element.show('indicator')",
								 		 'complete' => "Element.hide('indicator');".visual_effect('highlight', 'lista'))) ?>
<?php endif ?>
</div>

<?php else:?>
<p>Non &egrave; stato trovato nessun cliente. <?php echo link_to("Crea un nuovo cliente",'cliente/create')?>.</p>
<?php endif?>
