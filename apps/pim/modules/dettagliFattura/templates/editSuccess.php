<div id="tabella_dettagli">
<?php javascript_tag('window.name="fattura"')?>
<?php use_helper('jQuery');?>

<table class="dettagli_fattura" width="100%">
  <tr>
    <th><?php echo stripcslashes(UtentePeer::getImpostazione()->getLabelQuantita());?></th>
    <th><?php echo stripcslashes(UtentePeer::getImpostazione()->getLabelDescrizione());?></th>
    <th><?php echo stripcslashes(UtentePeer::getImpostazione()->getLabelPrezzoSingolo());?></th>
    <th><?php echo stripcslashes(UtentePeer::getImpostazione()->getLabelSconto());?></th>
    <?php if($fattura->getIncludiTasse() == 's' && $fattura->getCalcolaTasse() == 's'):?>
      <th width="15%">Prezzo Tot. Lordo</th>
    <?php endif?>
    <th><?php echo stripcslashes(UtentePeer::getImpostazione()->getLabelPrezzoTotale());?></th>
    <th><?php echo stripcslashes(UtentePeer::getImpostazione()->getLabelIva());?></th>
    <th></th>
  </tr>
<?php if(count($dettagli_fatturas)>0 || $sf_user->getAttribute('conta_dettagli')>0):?>
  <?php foreach ($dettagli_fatturas as $dettaglio):?>
    <?php if(in_array($dettaglio->getID(),$sf_user->getAttribute('dettagli_in_modifica'))):?>
      <tr>
        <input type="hidden" name="ids[]" value="<?php echo $dettaglio->getID();?>"/>
        <td><input type="text" name="qty[]" id="qty<?php echo $dettaglio->getId()?>" value="<?php echo $dettaglio->getQty()?>" size="3"></td>
        <td valign="top"><textarea name="descrizione[]" id="desc<?php echo $dettaglio->getId()?>" rows="5" cols="50"><?php echo $dettaglio->getDescrizioneEditing()?></textarea>
        <?php echo link_to(image_tag('icons_tango/open.png',array('align'=>'top')),'/#',array('title'=>'Seleziona Prodotto','onClick'=>"window.open('".url_for('prodotto/choose?id='.$dettaglio->getID())."','chooseProdotto','width=600,height=500 ,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes')"))?></td>
        <td><input type="text" name="prezzo[]" id="prezzo<?php echo $dettaglio->getId()?>" value="<?php echo $dettaglio->getPrezzo()?>" size="5">&euro;</td>
        <td><input type="text" name="sconto[]" id="sconto" value="<?php echo $dettaglio->getSconto()?>" size="3">%</td>
        <?php if($dettaglio->getFattura()->getIncludiTasse() == 's' && $fattura->getCalcolaTasse() == 's'):?>
        <td><input type="text" name="prezzo_totale[]" id="" value="<?php echo $dettaglio->getTotale()?>" disabled="disabled" size="5">&euro;</td>
        <?php endif?>
        <td><input type="text" name="prezzo_totale[]" id="" value="<?php echo $dettaglio->getFattura()->getIncludiTasse()=='s' && $fattura->getCalcolaTasse() == 's'?fattura::calcDettaglioScorporato($dettaglio->getTotale(),$fattura->getCalcolaTasse() == 's'):$dettaglio->getTotale()?>" disabled="disabled" size="5">&euro;</td>
        <td><select name="iva[]" id=iva>
        <?php $options = CodiceIvaPeer::doSelect(new Criteria());
          foreach ($options as $option):?>
          <option value ="<?php echo $option?>"<?php if ($option->getValore() == $dettaglio->getIva()):?> selected <?php endif?>><?php echo $option?></option>
        <?php endforeach;?>
        </td>
        <td><?php echo jq_link_to_remote(image_tag('/images/icons/page_delete.gif',array('alt'=>'Elimina Dettaglio')),array('url'=>'dettagliFattura/delete?id='.$dettaglio->getID().'&fattura_id='.$dettaglio->getFatturaID(),
        										   'update' => 'dettaglio_edit',
        										   'loading' => jq_visual_effect('fadeIn', '#indicator'),
        								 		    'complete' => jq_visual_effect('fadeOut', '#indicator')."$(tabella_dettagli).effect('highlight', {}, 1000);"))?></td>

      </tr>
    <?php else:?>
      <tr>
        <td><?php echo $dettaglio->getQty()?></td>
        <td class="align-left"><?php echo jq_link_to_remote(stripcslashes($dettaglio->getDescrizione()),array('url'=>'dettagliFattura/edit?id='.$dettaglio->getID().'&fattura_id='.$dettaglio->getFatturaID(),
        										   'update' => 'dettaglio_edit',
        										   'loading' => jq_visual_effect('fadeIn', '#indicator'),
        								 		    'complete' => jq_visual_effect('fadeOut', '#indicator')/*.jq_visual_effect('highlight', 'dettaglio_edit')*/),array('title'=>'Modifica dettaglio fattura'))?></td>
        <td><?php echo $dettaglio->getFattura()->getIncludiTasse() == 's' && $fattura->getCalcolaTasse() == 's'?format_currency(fattura::calcDettaglioScorporato($dettaglio->getPrezzo(),$fattura->getCalcolaTasse() == 's'),'EUR'):format_currency($dettaglio->getPrezzo(),'EUR')?></td>
        <td><?php echo $dettaglio->getSconto()?>%</td>
        <?php if($dettaglio->getFattura()->getIncludiTasse() == 's' && $fattura->getCalcolaTasse() == 's'):?><td><?php echo format_currency($dettaglio->getTotale(),'EUR')?></td><?php endif?>
        <td><?php echo $dettaglio->getFattura()->getIncludiTasse() == 's' && $fattura->getCalcolaTasse() == 's'?format_currency(fattura::calcDettaglioScorporato($dettaglio->getTotale(),$fattura->getCalcolaTasse() == 's'),'EUR'):format_currency($dettaglio->getTotale(),'EUR')?></td>
        <td><?php echo $dettaglio->getIva()?>%</td>
        <td><?php echo jq_link_to_remote(image_tag('/images/icons/page_delete.gif',array('alt'=>'Elimina Dettaglio')),array('url'=>'dettagliFattura/delete?id='.$dettaglio->getID().'&fattura_id='.$dettaglio->getFatturaID(),
        										   'update' => 'dettaglio_edit',
        										   'loading' => jq_visual_effect('fadeIn', '#indicator'),
        								 		    'complete' => jq_visual_effect('fadeOut', '#indicator')."$(tabella_dettagli).effect('highlight', {}, 1000);"))?></td>
      </tr>
    <?php endif ?>
  <?php endforeach;?>

  <?php for($i=0;$i < $sf_user->getAttribute('conta_dettagli');$i++):$dettaglio = new DettagliFattura()?>

    <tr>
      <input type="hidden" name="ids_new[]" id="ids_new" value="">
      <td><input type="text" name="qty_new[]" id="qty<?php echo $i?>" value="0" size="3"></td>
      <td valign="top" width="50%">
      <textarea name="descrizione_new[]" id="desc<?php echo $i?>" rows="3" cols="40"></textarea>&nbsp;</td>
      <td><input type="text" name="prezzo_new[]" id="prezzo<?php echo $i?>" value="0" size="5"> &euro;</td>
      <td><input type="text" name="sconto_new[]" id="sconto_new_<?php echo $i?>" value="0" size="3">%</td>
      <?php if($fattura->getIncludiTasse() == 's' && $fattura->getCalcolaTasse() == 's'):?>
      <td width="10%"><input type="text" name="" id="" value="" disabled="disabled" size="5"> &euro;</td>
      <?php endif ?>
      <td><input type="text" name="" id="" value="" disabled="disabled" size="5"> &euro;</td>
      <td><select name="iva_new[]" id=iva_new>
        <?php $options = CodiceIvaPeer::doSelect(new Criteria());
          foreach ($options as $option):?>
          <option value ="<?php echo $option?>"<?php if ($option->getValore() == $fattura->getVat()):?> selected <?php endif?>><?php echo $option?></option>
        <?php endforeach;?>
      </td>
      <td><?php echo jq_link_to_remote(image_tag('/images/icons/page_delete.gif',array('alt'=>'Elimina Dettaglio')),array('url'=>'dettagliFattura/delete?fattura_id='.$fattura_id,
      										   'update' => 'dettaglio_edit',
      										   'loading' => jq_visual_effect('fadeIn', '#indicator'),
      								 		    'complete' => jq_visual_effect('fadeOut', '#indicator')."$(tabella_dettagli).effect('highlight', {}, 1000);"))?></td>
    </tr>
  <?php endfor;?>
<?php else: ?>
  <tr><td colspan="6">Nessun dettaglio per questa fattura</td></tr>
<?php endif ?>
</table>

<input type="submit" name="commit" value="Salva" class="button_submit large btn primary" onclick="this.form.insert_page.value='no'">&nbsp;
<?php echo jq_link_to_remote('Annulla',array('url'=>'dettagliFattura/show?fattura_id='.$fattura_id,
										   'update' => 'dettaglio_edit',
										   'loading' => jq_visual_effect('fadeIn', '#indicator'),
								 		    'complete' => jq_visual_effect('fadeOut', '#indicator')."$(tabella_dettagli).effect('highlight', {}, 1000);"))?>

</div>

<div id="indicator" style="display: none;"></div>
<?php include_partial('fattura/calcola_fattura',array('fattura'=>$fattura));?>
