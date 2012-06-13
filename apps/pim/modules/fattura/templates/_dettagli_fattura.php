<?php echo jq_form_remote_tag(array('url'      => 'dettagliFattura/update',
								                 'update'   => 'dettaglio_edit',
								                 'loading'  => "$('#indicator').fadeIn();",
								                 'complete' => jq_visual_effect('fadeOut', '#indicator', array('duration' => 0)).jq_visual_effect('highlight', 'tabella_dettagli')), array('name'=>'fattura')) ?>

  
  <input type="hidden" name="fattura_id" id="fattura_id" value="<?php echo $fattura->getID();?>"/>
  <input type="hidden" name="insert_page" id="insert_page" value="no" />

  <?php if ($fattura->isEditable()): ?>
    <div class="dettagli-add" >
      <ul style="list-style-type: none">
        <li>
          <div class="input-prepend">
            <span class="add-on"><img src="<?php echo $sf_request->getRelativeUrlRoot()?>/images/icons/page_new.gif" /></span>
            <input class="tiny" type="submit" value="<?php echo __('add lines'); ?>" onClick="this.form.insert_page.value = 'yes'"/>
          </div>
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
