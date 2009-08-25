<?php if(count($fatture_results)>0):?>


<?php if ($fatture instanceof sfPager && $fatture->haveToPaginate()): ?>
<div class="navigator">Pagina <?php echo $fatture->getPage()?> di <?php echo $fatture->getLastPage();?>&nbsp;&nbsp;
  <?php echo link_to_remote('&laquo;',array('url'=>$form_action.'page='.$fatture->getFirstPage().'&tag='.$tag,
  											'update'=>$div_to_update,
  											'loading' => "Element.show('indicator')",
								 			'complete' => "Element.hide('indicator');".visual_effect('highlight', $div_to_update))) ?>

  <?php echo link_to_remote('&lt;',array('url' => $form_action.'page='.$fatture->getPreviousPage().'&tag='.$tag,
  										 'update'=>$div_to_update,
  										 'loading' => "Element.show('indicator')",
								 		 'complete' => "Element.hide('indicator');".visual_effect('highlight', $div_to_update))) ?>

  <?php $links = $fatture->getLinks(); foreach ($links as $page): ?>
    <?php echo ($page == $fatture->getPage()) ? "<strong>$page</strong>" : link_to_remote($page, array('url' => $form_action.'page='.$page.'&tag='.$tag,
    																			  'update'=>$div_to_update,
  										 										  'loading' => "Element.show('indicator')",
								 		 										  'complete' => "Element.hide('indicator');".visual_effect('highlight', $div_to_update))) ?>
    <?php if ($page != $fatture->getCurrentMaxLink()): ?><?php endif ?>
  <?php endforeach ?>
  <?php echo link_to_remote('&gt;',array('url' => $form_action.'page='.$fatture->getNextPage().'&tag='.$tag,
  										 'update'=> $div_to_update,
  										 'loading' => "Element.show('indicator')",
								 		 'complete' => "Element.hide('indicator');".visual_effect('highlight', $div_to_update))) ?>
  <?php echo link_to_remote('&raquo;',array('url' => $form_action.'page='.$fatture->getLastPage().'&tag='.$tag,
  										 'update'=> $div_to_update,
  										 'loading' => "Element.show('indicator')",
								 		 'complete' => "Element.hide('indicator');".visual_effect('highlight', $div_to_update))) ?>
</div>
<?php endif ?>


<table width="100%" class="fatture" style="margin-bottom: 5px;margin-top: 10px;">
<?php if($checkbox):?>
  <th></th>
<?php endif ?>
<th>N.</th>
<?php if($customer):?>
  <th class="cliente">Ragione sociale</th>
<?php endif ?>
<th>Data</th>
<!--th>Scadenza</th-->
<!--th>Imponibile</th-->
<th>Totale</th>
<th>Stato</th>
<?php if(UtentePeer::getImpostazione()->getBoolConsegnaCommercialista()):?>
  <th><abbr title="Consegnata al commercialista">Commer.ta</abbr></th>
<?php endif?>
<?php if(UtentePeer::getImpostazione()->getBoolDepositaIva()):?>
  <th><abbr title="Iva depositata">Iva Dep.</abbr></th>
<?php endif?>
<th>Ritardo</th>
<?php if($copia):?>
  <th>Copia</th>
<?php endif?>
<th>Pdf</th>
<!--th>Elimina</th-->
<?php
$tasse = TassaPeer::doSelect(new Criteria());
foreach ($fatture_results as $fattura) :
  $fattura->calcolaFattura($tasse, UtentePeer::getImpostazione()->getTipoRitenuta(), UtentePeer::getImpostazione()->getRitenutaAcconto());
?>

<tr>
<?php if($checkbox):?><td><?php echo checkbox_tag('ids[]',$fattura->getID())?></td><?php endif?>
<td>

<?php if($fattura->isProForma()):?>
  <?php echo link_to('Pro-Forma','fattura/show?id='.$fattura->getID())?>
<?php else:?>
  <?php echo link_to($fattura->getNumFattura(),'fattura/show?id='.$fattura->getID())?>
<?php endif?>
</td>

<?php if($customer):?>
  <td class="cliente"><?php echo link_to($fattura->getCliente(),'@contact_show?id='.$fattura->getClienteID())?></td>
<?php endif ?>

<td><?php echo format_date($fattura->getData())?></td>
<!--td><?php echo format_date($fattura->getDataPagamento())?></td-->
<td><?php echo format_currency($fattura->getImponibile(), 'EUR')?> (<?php echo format_currency($fattura->getTotale(), 'EUR')?>)</td>
<td style="font-weight: bold;background-color:<?php echo $fattura->getColorStato()?>;color: <?php echo $fattura->getFontColorStato()?>"><?php echo $fattura->getStato(true)?></td>

<?php if(UtentePeer::getImpostazione()->getBoolConsegnaCommercialista()):?>
  <td><?php echo link_to($fattura->getCommercialista()=='s'?'si':'no','fattura/consegnaCommercialista?id='.$fattura->getID().'&redirect=list')?></td>
<?php endif?>

<?php if(UtentePeer::getImpostazione()->getBoolDepositaIva()):?>
  <td><?php echo link_to($fattura->getIvaDepositata()=='s'?'si':'no','fattura/depositaIva?id='.$fattura->getID().'&redirect=list')?></td>
<?php endif?>

<td class="<?php echo $fattura->checkInRitardo()?'red':'none'?>"><?php echo $fattura->checkInRitardo()?'<strong>si</strong>':'no'?></td>
<?php if($copia):?>
<td><?php echo link_to(image_tag('/images/icons_tango/copy.png',array('alt'=>'crea copia fattura')),'fattura/copia?id='.$fattura->getID())?></td>
<?php endif ?>
<td><?php echo link_to(image_tag('/images/icons/file_acrobat.gif',array('alt'=>'esporta in pdf')),'fattura/export?id='.$fattura->getID(),array('target' => '_blank'))?></td>
</tr>
<?php endforeach;?>
</table>


<?php else:?>
<p>Nessuna fattura trovata</p>
<?php endif ?>
