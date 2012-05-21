<div id="tabella_dettagli">
<?php javascript_tag('window.name="fattura"')?>
<?php use_helper('Object') ?>
<?php use_helper('JavascriptBase') ?>
<?php use_helper('Javascript') ?>

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
        <td><?php echo object_input_tag($dettaglio, 'getQty', array('id'=>'qty'.$dettaglio->getID(),'size' => 3, 'name' => 'qty[]')) ?></td>
        <td valign="top"><?php echo object_textarea_tag($dettaglio, 'getDescrizioneEditing', array('id'=>'desc'.$dettaglio->getID(),'size' => '50x5','name' => 'descrizione[]')) ?>&nbsp;
        <?php echo link_to(image_tag('icons_tango/open.png',array('align'=>'top')),'/#',array('title'=>'Seleziona Prodotto','onClick'=>"window.open('".url_for('prodotto/choose?id='.$dettaglio->getID())."','chooseProdotto','width=600,height=500 ,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=yes')"))?></td>
        <td><?php echo object_input_tag($dettaglio, 'getPrezzo', array('id'=>'prezzo'.$dettaglio->getID(),'size' => 5,'name'=>'prezzo[]')) ?> &euro;</td>
        <td><?php echo object_input_tag($dettaglio, 'getSconto', array('size' => 3,'name'=>'sconto[]')) ?>%</td>
        <?php if($dettaglio->getFattura()->getIncludiTasse() == 's' && $fattura->getCalcolaTasse() == 's'):?>
        <td><?php echo input_tag('',$dettaglio->getTotale(),array('disabled'=>'disabled','size'=>5,'name'=>'prezzo_totale[]'))?> &euro;
        <?php endif?>
        <td><?php echo input_tag('',$dettaglio->getFattura()->getIncludiTasse()=='s' && $fattura->getCalcolaTasse() == 's'?fattura::calcDettaglioScorporato($dettaglio->getTotale(),$fattura->getCalcolaTasse() == 's'):$dettaglio->getTotale(),array('disabled'=>'disabled','size'=>5,'name'=>'prezzo_totale[]'))?> &euro;</td>
        <td><?php echo select_tag('iva[]',objects_for_select(CodiceIvaPeer::doSelect(new Criteria),'getValore','getNome',$dettaglio->getIva()))?></td>
        <td><?php echo link_to_remote(image_tag('/images/icons/page_delete.gif',array('alt'=>'Elimina Dettaglio')),array('url'=>'dettagliFattura/delete?id='.$dettaglio->getID().'&fattura_id='.$dettaglio->getFatturaID(),
        										   'update' => 'dettaglio_edit',
        										   'loading' => "Element.show('indicator')",
        								 		   'complete' => "Element.hide('indicator');".visual_effect('highlight', 'tabella_dettagli')))?></td>

      </tr>
    <?php else:?>
      <tr>
        <td><?php echo $dettaglio->getQty()?></td>
        <td class="align-left"><?php echo link_to_remote(stripcslashes($dettaglio->getDescrizione()),array('url'=>'dettagliFattura/edit?id='.$dettaglio->getID().'&fattura_id='.$dettaglio->getFatturaID(),
        										   'update' => 'dettaglio_edit',
        										   'loading' => "Element.show('indicator')",
        								 		   'complete' => "Element.hide('indicator');".visual_effect('highlight', 'dettaglio_edit')),array('title'=>'Modifica dettaglio fattura'))?></td>
        <td><?php echo $dettaglio->getFattura()->getIncludiTasse() == 's' && $fattura->getCalcolaTasse() == 's'?format_currency(fattura::calcDettaglioScorporato($dettaglio->getPrezzo(),$fattura->getCalcolaTasse() == 's'),'EUR'):format_currency($dettaglio->getPrezzo(),'EUR')?></td>
        <td><?php echo $dettaglio->getSconto()?>%</td>
        <?php if($dettaglio->getFattura()->getIncludiTasse() == 's' && $fattura->getCalcolaTasse() == 's'):?><td><?php echo format_currency($dettaglio->getTotale(),'EUR')?></td><?php endif?>
        <td><?php echo $dettaglio->getFattura()->getIncludiTasse() == 's' && $fattura->getCalcolaTasse() == 's'?format_currency(fattura::calcDettaglioScorporato($dettaglio->getTotale(),$fattura->getCalcolaTasse() == 's'),'EUR'):format_currency($dettaglio->getTotale(),'EUR')?></td>
        <td><?php echo $dettaglio->getIva()?>%</td>
        <td><?php echo link_to_remote(image_tag('/images/icons/page_delete.gif',array('alt'=>'Elimina Dettaglio')),array('url'=>'dettagliFattura/delete?id='.$dettaglio->getID().'&fattura_id='.$dettaglio->getFatturaID(),
        										   'update' => 'dettaglio_edit',
        										   'loading' => "Element.show('indicator')",
        								 		   'complete' => "Element.hide('indicator');".visual_effect('highlight', 'tabella_dettagli')))?></td>
      </tr>
    <?php endif ?>
  <?php endforeach;?>

  <?php for($i=0;$i < $sf_user->getAttribute('conta_dettagli');$i++):$dettaglio = new DettagliFattura()?>

    <tr>
      <?php echo input_hidden_tag('ids_new[]','')?>
      <td><?php echo input_tag('qty_new[]','0',array('id'=>'qty'.$i,'size'=>3))?></td>
      <td valign="top" width="50%">
      <?php echo textarea_tag('descrizione_new[]', null, array('id' => 'desc'.$i, 'size' => '40x3'))?>&nbsp;
      <td><?php echo input_tag('prezzo_new[]','0',array('id'=>'prezzo'.$i,'size'=>5))?> &euro;</td>
      <td><?php echo input_tag('sconto_new[]','0',array('size'=>3))?>%</td>
      <?php if($fattura->getIncludiTasse() == 's' && $fattura->getCalcolaTasse() == 's'):?><td width="10%"><?php echo input_tag('','',array('disabled' => 'disabled', 'size'=>5))?> &euro;</td><?php endif?>
      <td><?php echo input_tag('','',array('disabled' => 'disabled', 'size'=>5))?> &euro;</td>
      <td><?php echo select_tag('iva_new[]',objects_for_select(CodiceIvaPeer::doSelect(new Criteria),'getValore','getNome',$fattura->getVat()))?></td>
      <td><?php echo link_to_remote(image_tag('/images/icons/page_delete.gif',array('alt'=>'Elimina Dettaglio')),array('url'=>'dettagliFattura/delete?fattura_id='.$fattura_id,
      										   'update' => 'dettaglio_edit',
      										   'loading' => "Element.show('indicator')",
      								 		   'complete' => "Element.hide('indicator');".visual_effect('highlight', 'tabella_dettagli')))?></td>
    </tr>
  <?php endfor;?>
<?php else: ?>
  <tr><td colspan="6">Nessun dettaglio per questa fattura</td></tr>
<?php endif ?>
</table>

<?php echo submit_tag('Salva',array('class'=>'button_submit large btn primary','onclick'=>"this.form.insert_page.value='no'")) ?>&nbsp;
<?php echo link_to_remote('Annulla',array('url'=>'dettagliFattura/show?fattura_id='.$fattura_id,
										   'update' => 'dettaglio_edit',
										   'loading' => "Element.show('indicator')",
								 		   'complete' => "Element.hide('indicator');".visual_effect('highlight', 'tabella_dettagli')))?>

</div>

<div id="indicator" style="display: none;"></div>
<?php include_partial('fattura/calcola_fattura',array('fattura'=>$fattura));?>
