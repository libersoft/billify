<div class="title">
  <h4><?php echo __('info fattura')?></h4>
</div>

<ul class="ul-list nomb">
  <li>
    <strong><?php echo __('stato')?>:</strong>
    <?php echo  $fattura->getStato('true') ?>
    <?php echo ($fattura->getStato()=='p' || $fattura->getStato()=='r' || $fattura->getStato()=='i') ? 'il '.format_date($fattura->getDataStato()) : ''?>
  </li>
  <?php include_partial('fattura/fattura', array('fattura' => $fattura));?>
</ul>

<div id="stato-fattura" style="display: none;">
  <div class="title">
    <h4><?php echo __('seleziona stato')?></h4>
  </div>
  <ul class="ul-list nomb">
		<li class="non_inviata">+ <?php echo link_to('non inviata', 'fattura/stato?stato=n&id='.$fattura->getID(), array('title' => 'Segna come non inviata'))?></li>
		<li class="inviata">
		  + <?php echo link_to_function('inviata', 
                                    jq_visual_effect('fadeOut', '#data_stato_rifiutata').
                                    jq_visual_effect('fadeOut', '#data_stato_pagata').
                                    jq_visual_effect('fadeIn', '#data_stato_inviata'),
                                    array('title'=>'Segna come inviata'))?>
		</li>
		<li class="pagata">
		  + <?php echo link_to_function('pagata',
                                    jq_visual_effect('fadeOut', '#data_stato_rifiutata').
                                    jq_visual_effect('fadeOut', '#data_stato_inviata').		                                
                                    jq_visual_effect('fadeIn', '#data_stato_pagata'),
                                    array('title'=>'Segna come pagata'))?>
    </li>
		<li class="rifiutata">
		  + <?php echo link_to_function('rifiutata',
                                    jq_visual_effect('fadeOut', '#data_stato_inviata').
                                    jq_visual_effect('fadeOut', '#data_stato_pagata').       
                                    jq_visual_effect('fadeIn', '#data_stato_rifiutata'),
                                    array('title' => 'Segna come rifiutata'))?>
    </li>
	</ul>
</div>

<div id="data_stato_pagata" style="display: none;" class="box">
  <div class="title" style="margin-bottom: 10px;">
    <h4>Data pagamento</h4>
  </div>
  <?php echo form_tag('fattura/stato')?>
    <small class="nomargin">Pagata il</small>
    <input type="text" name="data_stato" id="button_data_stato_pagata" value="<?php echo $fattura->getDataStato()?>" size="12" />
    <small class="nomargin">(dd/mm/yy)</small>
    <div align="<?php echo $fattura->isProForma()?'left':'right'; ?>" class="data">
      <?php if($fattura->isProForma()):?>
        <input type="checkbox" name="regolare" value="y"><small style="margin-left: 5px">Trasforma in fattura regolare</small>
      <?php endif?>
      <input type="submit" value="Salva" />&nbsp;
      <input type="button" value="Annulla" onclick="<?php echo jq_visual_effect('slideUp','#data_stato_pagata',array('duration'=>0.5))?>">
    </div>
    <input type="hidden" name="stato" value="p">
    <input type="hidden" name="id" id="id" value="<?php echo $fattura->getID();?>" /> 
  </form>
</div>

<div id="data_stato_rifiutata" style="display: none;">
  <div class="title" style="margin-bottom: 10px;">
    <h4>Data rifiuto</h4>
  </div>
  <?php echo form_tag('fattura/stato')?>
    <small class="nomargin">Rifiutata il</small>
    <input type="text" name="data_stato" id="button_data_stato_rifiutata" value="<?php echo $fattura->getDataStato()?>" size="12" />
    <small class="nomargin">(dd/mm/yy)</small>
    <div align="right" class="data">
      <input type="submit" value="Salva" />&nbsp;
      <input type="button" value="Annulla" onclick="<?php echo jq_visual_effect('slideUp','#data_stato_rifiutata',array('duration'=>0.5))?>">
    </div>
    <input type="hidden" name="stato" value="r">
    <input type="hidden" name="id" id="id" value="<?php echo $fattura->getID();?>" /> 
  </form>
</div>

<div id="data_stato_inviata" style="display: none;">
  <div class="title" style="margin-bottom: 10px;">
    <h4>Data invio</h4>
  </div>
  <?php echo form_tag('fattura/stato')?>
    <small class="nomargin">Inviata il</small>
    <input type="text" name="data_stato" id="button_data_stato_inviata" value="<?php echo $fattura->getDataStato()?>" size="12" />
    <small class="nomargin">(dd/mm/yy)</small>
    <div align="right" class="data">
      <input type="submit" value="Salva" />&nbsp;
      <input type="button" value="Annulla" onclick="<?php echo jq_visual_effect('slideUp','#data_stato_inviata',array('duration'=>0.5))?>">
    </div>
    <input type="hidden" name="stato" value="i">
    <input type="hidden" name="id" id="id" value="<?php echo $fattura->getID();?>" /> 
  </form>
</div>
