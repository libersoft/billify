<?php use_helper('Javascript');?>
<div class="filter" id="filter">

<?php echo form_remote_tag(array('url' => $form_action,
								 'update' => $div_to_update,
								 'loading' => "Element.show('indicator')",
								 'complete' => "Element.hide('indicator');"))?>
<table width="100%" class="filter" cellspacing="0">
<!--tr>
<td colspan="6" class="border_window" align="right">
<?php echo link_to_function(image_tag('/images/icons/action_stop.gif',array('alt'=>'Chiudi','align'=>'absmiddle')),visual_effect('appear','filter_link',array('duration'=>0)).visual_effect('fade','filter',array('duration'=>0)),array('title'=>'Chiudi'))?>&nbsp;&nbsp;
</td>
</tr-->
<tr>
<td>
<label for="anno">Anno:</label> <select id="anno" name="<?php echo $select_name_anno ?>">
<option value="all">Tutte</option>
<?php echo options_for_select($anni_fatture,$anno_selected);?>
</select>
</td>
<?php if(!isset($cliente_id)):?>
<td>
<label for="cliente">Cliente:</label>
<?php echo input_tag('cliente',$cliente,array('size'=>15))?>
</td>
<?php endif?>
<td>
<label for="stato">Stato:</label> <select id="stato" name="<?php echo $select_name_stato ?>">
<option value="all" <?php echo $stato=='all'?'selected="selected"':''?>>Tutte</option>
<option value="p" <?php echo $stato=='p'?'selected="selected"':''?>>Pagate</option>
<option value="i" <?php echo $stato=='i'?'selected="selected"':''?>>Inviate</option>
<option value="n" <?php echo $stato=='n'?'selected="selected"':''?>>Non Inviate</option>
<option value="r" <?php echo $stato=='r'?'selected="selected"':''?>>Rifiutate</option>
</select>
</td>
<td>
<label for="tipo">Tipo:</label> <select id="tipo" name="tipo">
<option value="all" <?php echo $tipo=='all'?'selected="selected"':''?>>Tutte</option>
<option value="1" <?php echo $tipo=='1'?'selected="selected"':''?>>Regolare</option>
<option value="2" <?php echo $tipo=='2'?'selected="selected"':''?>>Pro-Forma</option>
</select>
</td>
<?php if($trimestre != ""):?>
<td>
<label for="trimestre">Trimestre:</label> <select id="trimestre" name="trimestre">
<option value="all" <?php echo $trimestre==0?'selected="selected"':''?>>Tutti (1 Gen - 31 Dic)</option>
<option value="1" <?php echo $trimestre==1?'selected="selected"':''?>>Primo (1 Gen - 31 Mar)</option>
<option value="2" <?php echo $trimestre==2?'selected="selected"':''?>>Secondo (1 Apr - 30 Giu)</option>
<option value="3" <?php echo $trimestre==3?'selected="selected"':''?>>Terzo (1Lug - 30 Set)</option>
<option value="4" <?php echo $trimestre==4?'selected="selected"':''?>>Quarto (1 Ott - 31 Dic)</option>
</select>
</td>
<?php endif ?>
<td>
<input type="submit" value="Filtra">
</td>

</tr>
</table>
</form>
</div>
