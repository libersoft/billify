<?php use_helper('Object') ?>

<div class="title">
  <h2><?php echo $fattura->getID()?'Modifica Fattura':'Nuova Fattura'?>&nbsp;
  <?php if($fattura->isProForma()):?>
    pro-forma
  <?php else:?>
    n. <?php echo $fattura->getNumFattura() ?>&nbsp;
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

<table class="edit" width="100%">
<tbody>
  <tr>
    <th>Pro forma</th>
    <td><?php echo $form['proforma'] ?></td>
  </tr>
  <?php if(!$fattura->isProForma() || $fattura->isNew()):?>
    <tr>
      <th>Num fattura</th>
      <td>
        <a href="#" id="num_fattura_label"><?php echo $fattura->getNumFattura() ?></a>
        <?php echo $form['num_fattura'] ?>
        <script type="text/javascript">
          $(document).ready(function(event){
            $('#num_fattura').hide();
            $('#num_fattura_label').click(function(){
              $(this).hide();
              $('#num_fattura').show();
              event.preventDefault();
            });
          });
        </script>
      </td>
      <?php if($sf_request->hasError('num_fattura')):?>
        <td class="validate-error">
          <?php echo image_tag('icons/icon_alert.gif')?>&nbsp;<?php echo $sf_request->getError('num_fattura')?>
        </td>
      <?php endif?>
    </tr>
  <?php else:?>
    <?php echo $form['num_fattura']->render(array('style'=> "display:none")) ?>
  <?php endif ?>

  <tr>
      <th>Cliente</th>
      <td>
      <?php if ($fattura->getClienteId()) : ?>
        <a href="<?php echo url_for('contact_show', array('id' => $fattura->getClienteId())) ?>"><?php echo $fattura->getCliente() ?></a>
        <?php echo $form['cliente_id']->render(array('style' => "display:none")) ?>
      <?php else : ?>
        <?php echo $form['cliente_id'] ?>
      <?php endif ?>
    </td>
  </tr>

  <?php if($sf_user->getAttribute('modifica_data')):?>
    <tr>
      <th>Data</th>
      <td><?php echo $form['data'] ?></td>
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
        <div style="display:none"><?php echo $form['data']->render(array('style'=> "display:none")) ?></div>
      </td>
    </tr>
  <?php endif?>
  <tr>
    <th>Modo pagamento</th>
    <td><?php echo $form['modo_pagamento_id']; ?></td>
  </tr>
  <tr>
    <th>Sconto</th>
    <td><?php echo $form['sconto'] ?> %</td>
    <?php if($sf_request->hasError('sconto')):?>
      <td class="validate-error">
        <?php echo image_tag('icons/icon_alert.gif')?>&nbsp;<?php echo $sf_request->getError('sconto')?>
      </td>
    <?php endif?>
  </tr>
  <tr>
    <th>Iva</th>
    <td><?php echo $form['vat'] ?></td>
    <?php if($sf_request->hasError('vat')):?>
      <td class="validate-error">
        <?php echo image_tag('icons/icon_alert.gif')?>&nbsp;<?php echo $sf_request->getError('vat')?>
      </td>
    <?php endif?>
  </tr>
  <tr>
    <th>Spese anticipate</th>
    <td><?php echo $form['spese_anticipate'] ?> &euro;</td>
    <?php if($sf_request->hasError('spese_anticipate')):?>
      <td class="validate-error">
        <?php echo image_tag('icons/icon_alert.gif')?>&nbsp;<?php echo $sf_request->getError('spese_anticipate')?>
      </td>
    <?php endif?>
  </tr>
  <tr>
    <th>Calcola ritenuta</th>
    <td><?php echo $form['calcola_ritenuta_acconto'] ?></td>
  </tr>
  <tr>
    <th>Calcola tasse</th>
    <td><?php echo $form['calcola_tasse'] ?></td>
  </tr>
  <tr>
    <th>Scorpora tasse</th>
    <td><?php echo select_tag('includi_tasse',options_for_select(array('s'=>'Si','n'=>'No'),$fattura->getIncludiTasse()))?></td>
  </tr>
  <tr>
    <th>Note</th>
    <td><?php echo $form['note']->render(array('cols' => '50', 'rows' => '5')) ?></td>
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
