<?php use_helper('jQuery');?>

<div class="title">
  <h2>
    <?php echo __('%invoice% del %date%', array('%invoice%' => $fattura->toString(), '%date%' => format_date($fattura->getData())))?>&nbsp;
  </h2>
</div>

<h3><?php echo link_to($fattura->getCliente()->toString(), '@contact_show?id='.$fattura->getClienteID(), array('title' => __('Gestione Cliente')))?></h3>
<?php include_partial('contact/details',array('cliente'=>$fattura->getCliente(),'margin_left'=> '0px;'));?>
<?php include_partial('fattura/dettagli_fattura',array('fattura'=>$fattura,'viewSconto'=>$viewSconto))?>

<?php if($fattura->isProForma()):?>
  <small>
    <p><?php echo __('La presente non costituisce fattura a norma dell\'articolo 21 del DTR numero 633/72 e non deve essere da voi annotata sul libro degli acquisti.')?></p>
    <p><?php echo __('A ricevimento del saldo sar&agrave; emessa regolare fattura.')?></p>
  </small>
<?php endif?>

<?php slot('sidebar'); ?>
    <div class="title">
       <h4><?php echo __('actions')?></h4>
    </div>
    <ul class="ul-list nomb">
      <li>+ <?php echo link_to(__('edit'),'fattura/edit?id='.$fattura->getID().'&id_cliente='.$fattura->getClienteID(),array('title'=>'Modifica Fattura'))?></li>

      <li>+ <?php echo link_to_function(
      __('edit state'),
      'if($(\'element\').css(\'stato-fattura\',\'display\') == \'none\')
      {
        $(\'#stato-fattura\').toggle();
      }
      else
      { 
        $(\'#stato-fattura\').toggle();
      }',
      array(
        'title' => 'Cambia Stato Fattura',
        //'style' => 'color:'.$fattura->getColorStato().';',
        'class'=>'link_stato menu-expand',
        'id'=>'link-stato'
      ))?></li>

      <li>+ <?php echo link_to(__('copy'),'fattura/copia?id='.$fattura->getID().'&actions=show',array('title'=>'Copia Fattura'))?></li>
      <li>+ <?php echo link_to(__('print'),'fattura/export?id='.$fattura->getID(),array('title'=>'Crea PDF Fattura','target'=>'_blank'))?></li>
      <li>+ <?php echo link_to(__('delete'),'fattura/delete?id='.$fattura->getID(),array('title'=>'Elimina fattura','confirm' => 'Vuoi veramente eliminare la '.$fattura->toString().'?'))?></li>
    </ul>
<?php
  include_partial('invoice/sidebar');
  end_slot();
?>

<?php
  slot('infobox');
    include_partial('fattura/payment_forms', array('fattura' => $fattura));
  end_slot();
?>
