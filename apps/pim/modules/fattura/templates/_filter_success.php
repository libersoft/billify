<div id="indicator" style="display:none"></div>

<a name="lista_fatture"></a>

<div class="title">
  <h2>Lista Fatture <?php echo $anno=='all'?'Anni '.implode('/',$anni_fatture):'Anno '.$anno ?></h2>
</div>


<?php if(count($tags)>0):?>
<div>
<ul id="tag_cloud" style="display: none;">
  <li class="title">Tag pi&ugrave; usati:</li>
  <?php foreach($tags as $tag => $count): ?>
  <li class="tag_popularity_<?php echo $count ?>"><?php echo link_to($tag, 'fattura/list?tag='.$tag, 'rel=tag') ?></li>
  <?php endforeach; ?>
</ul>
</div>
<?php endif?>

<div id="filter_link" class="filter_link" style="display: none">
<?php echo link_to_function(image_tag('/images/icons/arrow_right.gif',array('alt'=>'Filtra Lista','align'=>'absmiddle')).'Filtra la lista',visual_effect('appear','filter',array('duration'=>0)).visual_effect('fade','filter_link',array('duration'=>0)),array('title'=>'Filtra'),array('title'=>'Filtra'))?>
</div>

<?php
$array_filter = array('form_action' => $form_action,
											 'select_name_anno' => 'anno',
											 'anni_fatture' => $anni_fatture,
											 'anno_selected' => $anno,
											 'select_name_stato' => 'stato',
											 'stato' => $stato,
											 'tipo' => $tipo,
											 'cliente' => $cliente,
											 'trimestre'=>isset($trimestre)?$trimestre:'',
											 'div_to_update'=>$div_to_update);

if(isset($cliente_id))$array_filter['cliente_id'] = $cliente_id;

include_partial('fattura/filter',$array_filter);
?>

<?php if(count($fatture_results)>0):?>

<?php if(!isset($cliente_id)):?>

<?php echo form_remote_tag(array('url'      => 'fattura/actions',
								 'update'   => $div_to_update,
								 'loading'  => "Element.show('indicator')",
								 'complete' => "Element.hide('indicator');",
								 'confirm'  => 'Sei sicuro?'))?>

<?php echo form_tag('fattura/actions')?>

<?php endif?>

<?php include_partial('fattura/list',array('tag'=>$tag_selected,'fatture' => $fatture,'fatture_results'=>$fatture_results,'checkbox'=>$checkbox, 'customer'=>$customer,'copia'=>$copia,'div_to_update'=>$div_to_update,'form_action'=>$form_action));?>

<?php if(!isset($cliente_id)):?>
<?php echo input_hidden_tag('todo','');?>
<?php if(UtentePeer::getImpostazione()->getBoolConsegnaCommercialista()):?>
<?php echo submit_tag('Consegnata al commercialista',array('onClick'=>'this.form.todo.value=\'c\''))?>&nbsp;
<?php endif?>
<?php if(UtentePeer::getImpostazione()->getBoolDepositaIva()):?>
<?php echo submit_tag('Deposita Iva',array('onClick'=>'this.form.todo.value=\'i\''))?>&nbsp;
<?php endif?>
<?php echo submit_tag('Elimina',array('onClick'=>'this.form.todo.value=\'d\''))?>
</form>
<?php endif?>

<?php if(isset($trimestre) && $anno != "all" && $stato=='all' && $trimestre >= 1 && $fatture_iva_da_pagare > 0):?>

<?php echo form_remote_tag(array('url'=>'fattura/pagaiva',
								 'update'=> $div_to_update,
								 'loading' => "Element.show('indicator')",
								 'complete' => "Element.hide('indicator');".visual_effect('highlight', 'scheda_cliente')))?>

<?php echo input_hidden_tag('anno',$anno);?>
<?php echo input_hidden_tag('trimestre',$trimestre);?>
<?php echo submit_tag('Paga Iva',array('class'=>'button_submit'));?>
<?php endif ?>

<?php if(!isset($cliente_id) && count($fatture_results) > 0):?><p>(Per effettuare il pagamento dell'Iva seleziona l'anno, il trimestre e tutte le fatture)</p><?php endif ?>

<?php else:?>
<p>Non hai emesso nessuna fattura <?php if(isset($cliente_id)):?>per questo cliente<?php endif?></p>
<?php endif ?>
