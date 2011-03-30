<?php use_helper('Javascript');?>
<span id="new_tag"><?php echo link_to_function(image_tag('icons/add.png',array('align'=>'absmiddle')),visual_effect('appear','new_tag_input'))?></span>
Tags: 
<?php $tags = $fattura->getTags()?>
<?php if(count($tags) > 0):?>
<?php foreach($tags as $index => $tag):?>
<?php if($index >= count($tags)-1):?>
<small>[<?php echo link_to_remote('x',array('url'=>'fattura/deleteTag?id_tag='.$tag->getId().'&id_fattura='.$tag->getIdFattura(),'update'=>'tags'))?>]</small>&nbsp;<?php echo link_to($tag->getTagNormalizzato(),'@invoice?tag='.$tag->getTagNormalizzato(),'rel="tag"')?>
<?php else:?>
<small>[<?php echo link_to_remote('x',array('url'=>'fattura/deleteTag?id_tag='.$tag->getId().'&id_fattura='.$tag->getIdFattura(),'update'=>'tags'))?>]</small>&nbsp;<?php echo link_to($tag->getTagNormalizzato(),'@invoice?tag='.$tag->getTagNormalizzato(),'rel="tag"')?>,
<?php endif?>
<?php endforeach?>
<?php else:?>
No Tags
<?php endif?>
<?php if($sf_request->hasError('tag')):?>
&nbsp;- <span class="error"><em><?php echo $sf_request->getError('tag')?></em></span>
<?php endif?>