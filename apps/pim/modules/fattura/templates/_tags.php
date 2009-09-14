<div id="tags">
  <span id="new_tag"><?php echo link_to_function(image_tag('icons/add.png',array('align'=>'absmiddle')),visual_effect('appear','new_tag_input'))?></span>
  Tags:
  <?php $tags = $fattura->getTags()?>
  <?php if(count($tags) > 0):?>
    <?php foreach($tags as $index => $tag):?>
      <?php if($index >= count($tags)-1):?>
        <small>[<?php echo link_to_remote('x',array('update'=>'tags','url'=>'fattura/deleteTag?id_tag='.$tag->getId().'&id_fattura='.$tag->getIdFattura()))?>]</small>&nbsp;<?php echo link_to($tag->getTagNormalizzato(),'fattura/list?tag='.$tag->getTagNormalizzato(),'rel="tag"')?>
      <?php else:?>
        <small>[<?php echo link_to_remote('x',array('update'=>'tags','url'=>'fattura/deleteTag?id_tag='.$tag->getId().'&id_fattura='.$tag->getIdFattura()))?>]</small>&nbsp;<?php echo link_to($tag->getTagNormalizzato(),'fattura/list?tag='.$tag->getTagNormalizzato(),'rel="tag"')?>,
      <?php endif?>
    <?php endforeach?>
  <?php else:?>
    No Tags
  <?php endif?>
  </div>

  <div id="new_tag_input" style="display: none;">
    <?php echo form_remote_tag(array('url'=>'fattura/addTag?id_fattura='.$fattura->getId(),'update'=>'tags','complete'=>visual_effect('fade','new_tag_input').visual_effect('highlight','tags')))?>
    <?php echo input_auto_complete_tag('new_tag', '', 'fattura/tagAutocomplete', 'autocomplete=off', 'use_style=true') ?>
    <?php echo submit_tag('Tag') ?>
  </form>
</div>