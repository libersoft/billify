<?php echo form_remote_tag(array('url'      => 'dettagliFattura/update',
								                 'update'   => 'dettaglio_edit',
								                 'loading'  => 'Element.show(\'indicator\')',
								                 'complete' => 'Element.hide(\'indicator\');'.visual_effect('highlight', 'tabella_dettagli')), array('name'=>'fattura')) ?>

  <?php echo input_hidden_tag('fattura_id', $fattura->getID());?>
  <?php echo input_hidden_tag('insert_page', 'no');?>

  <?php if ($fattura->isEditable()): ?>
    <div class="actions dettagli-add" >
      <ul>
        <li>
          <input type="image" src="<?php echo $sf_request->getRelativeUrlRoot()?>/images/icons/page_new.gif" onClick="this.form.insert_page.value = 'yes'"/>
        </li>
      </ul>
    </div>
  <?php else: ?>
    <div class="actions" >
      <?php echo _('La fattura non può essere modificata o cancellata, cambia lo stato in <strong><em>non inviata</em></strong>'); ?>
    </div>
  <?php endif; ?>

  <div id="dettaglio_edit">
    <div id="tabella_dettagli">
      <?php include_partial('dettagliFattura/dettaglio', array('dettagli_fattura' => $fattura->getDettagliFatturas(), 'viewSconto' => $viewSconto, 'fattura' => $fattura));?>
    </div>
    <?php include_partial('fattura/calcola_fattura',array('fattura'=>$fattura));?>
  </div>

</form>
