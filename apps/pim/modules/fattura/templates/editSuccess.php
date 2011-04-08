<?php use_helper('Object') ?>

<div class="title">
  <h2><?php echo $fattura->getID()?'Modifica Fattura':'Nuova Fattura'?>&nbsp;
  <?php if($fattura->isProForma()):?>
    pro-forma
  <?php else:?>
    n. <?php echo $fattura->getNumberDecorated() ?>&nbsp;
  <?php endif?>
  del <?php echo format_date($fattura->getData()); ?>
  </h2>
</div>

<?php echo form_tag('fattura/update') ?>

<?php echo object_input_hidden_tag($fattura, 'getId') ?>

<?php if ($sf_request->hasErrors()): ?>
<div class="validate-error">
  <p>I dati inseriti non sono corretti.
  Correggi i seguenti errori e salva i dati di nuovo:</p>
</div>
<?php endif ?>

<?php if (isset($error_message)): ?>
  <ul class="list-error">
    <li><?php echo $error_message; ?></li>
  </ul>
<?php endif; ?>

<table class="edit" width="100%">
<tbody>
  <tr>
    <th>Pro forma</th>
    <td><input type="checkbox" name="proforma" value="y" <?php if($fattura->isProForma() && !$fattura->isNew()):?>checked="checked"<?php endif?>></td>
  </tr>
  <?php if(!$fattura->isProForma() || $fattura->isNew()):?>
    <?php if($sf_user->getAttribute('modifica_num_fattura')):?>
      <tr>
        <th>Num fattura</th>
        <td><?php echo object_input_tag($fattura,'getPlainNumFattura',array('size' => 4, 'control_name' => 'num_fattura'))?></td>
        <?php if($sf_request->hasError('num_fattura')):?>
          <td class="validate-error">
            <?php echo image_tag('icons/icon_alert.gif')?>&nbsp;<?php echo $sf_request->getError('num_fattura')?>
          </td>
        <?php endif?>
      </tr>
    <?php else:?>
      <tr>
        <th>Num fattura</th>
        <td>
          <?php echo link_to($fattura->getNumberDecorated(),'fattura/'.($fattura->getId()?'edit':'create').'?modifica_num_fattura=true&id_cliente='.$fattura->getClienteID().($fattura->getID()?'&id='.$fattura->getID():''))?>
          <?php echo input_hidden_tag('num_fattura', $fattura->getPlainNumFattura());?>
        </td>
      </tr>
    <?php endif ?>
  <?php else:?>
    <?php echo input_hidden_tag('num_fattura', $fattura->getPlainNumFattura())?>
  <?php endif ?>

  <tr>
      <th>Cliente</th>
      <td>
      <?php if ($fattura->getClienteId()) : ?>
        <?php echo link_to($fattura->getCliente(), '@contact_show?id='.$fattura->getClienteId())?>
        <?php echo input_hidden_tag('cliente_id', $fattura->getClienteId());?>
      <?php else : ?>
        <?php echo object_select_tag($fattura, 'getClienteId', array('related_class' => 'Cliente', 'peer_method' => 'doSelectClienti')) ?>
      <?php endif ?>
    </td>
  </tr>

  <?php if($sf_user->getAttribute('modifica_data')):?>
    <tr>
      <th>Data</th>
      <td><?php echo object_input_date_tag($fattura, 'getData', array('rich' => true)) ?></td>
        <?php if($sf_request->hasError('data')):?>
          <td class="validate-error">
            <?php echo image_tag('icons/icon_alert.gif')?>&nbsp;<?php echo $sf_request->getError('data')?>
          </td>
        <?php endif?>
    </tr>
  <?php else:?>
    <tr>
      <th>Data</th>
      <td>
        <?php echo link_to($fattura->getData('d M y'),'fattura/'.($fattura->getId()?'edit':'create').'?modifica_data=true&id_cliente='.$fattura->getClienteID().($fattura->getID()?'&id='.$fattura->getID():''))?>
        <?php echo input_hidden_tag('data',format_date($fattura->getData()))?>
      </td>
    </tr>
  <?php endif?>
  <tr>
    <th>Modo pagamento</th>
    <td><?php echo object_select_tag($fattura, 'getModoPagamentoId', array('related_class' => 'ModoPagamento')) ?></td>
  </tr>
  <tr>
    <th>Sconto</th>
    <td><?php echo object_input_tag($fattura, 'getSconto', array('size' => 3)) ?> %</td>
    <?php if($sf_request->hasError('sconto')):?>
      <td class="validate-error">
        <?php echo image_tag('icons/icon_alert.gif')?>&nbsp;<?php echo $sf_request->getError('sconto')?>
      </td>
    <?php endif?>
  </tr>
  <tr>
    <th>Iva</th>
    <td><?php echo select_tag('vat',objects_for_select(CodiceIvaPeer::doSelect(new Criteria),'getValore','getNome',$fattura->getVat()))?></td>
    <?php if($sf_request->hasError('vat')):?>
      <td class="validate-error">
        <?php echo image_tag('icons/icon_alert.gif')?>&nbsp;<?php echo $sf_request->getError('vat')?>
      </td>
    <?php endif?>
  </tr>
  <tr>
    <th>Spese anticipate</th>
    <td><?php echo object_input_tag($fattura, 'getSpeseAnticipate', array('size' => 10),0) ?> &euro;</td>
    <?php if($sf_request->hasError('spese_anticipate')):?>
      <td class="validate-error">
        <?php echo image_tag('icons/icon_alert.gif')?>&nbsp;<?php echo $sf_request->getError('spese_anticipate')?>
      </td>
    <?php endif?>
  </tr>
  <tr>
    <th>Calcola ritenuta</th>
    <td><?php echo select_tag('calcola_ritenuta_acconto',options_for_select(Array('a' => 'Auto', 's' => 'Si', 'n' => 'No'), $fattura->getCalcolaRitenutaAcconto()))?></td>
  </tr>
  <tr>
    <th>Calcola tasse</th>
    <td><?php echo select_tag('calcola_tasse',options_for_select(array('s'=>'Si','n'=>'No'),$fattura->getCalcolaTasse()))?></td>
  </tr>
  <tr>
    <th>Scorpora tasse</th>
    <td><?php echo select_tag('includi_tasse',options_for_select(array('s'=>'Si','n'=>'No'),$fattura->getIncludiTasse()))?></td>
  </tr>
  <tr>
    <th>Note</th>
    <td><?php echo object_textarea_tag($fattura, 'getNote', array('cols' => '50', 'rows' => '5')) ?></td>
  </tr>
  <tr>
    <td align="right" colspan="2"><?php echo submit_tag('Salva e vai ai dettagli',array('class' => 'button_submit'))?></td>
  </tr>
</tbody>
</table>
</form>

<?php
  slot('sidebar');
    include_partial('invoice/sidebar');
  end_slot();
?>
