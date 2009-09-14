<?php use_helper('Javascript', 'Object');?>

<div class="title">
  <h2>
    <?php echo __('%invoice% del %date%', array('%invoice%' => $fattura->toString(), '%date%' => format_date($fattura->getData())))?>&nbsp;
    <?php echo include_partial('fattura/menu', array('fattura' => $fattura));?>
  </h2>
</div>

<?php include_partial('fattura/tags', array('fattura' => $fattura));?>

<h3><?php echo link_to($fattura->getCliente()->toString(), '@contact_show?id='.$fattura->getClienteID(), array('title' => __('Gestione Cliente')))?></h3>
<?php include_partial('cliente/contatti',array('cliente'=>$fattura->getCliente(),'margin_left'=> '0px;'));?>


<?php include_partial('fattura/dettagli_fattura',array('fattura'=>$fattura,'viewSconto'=>$viewSconto))?>

<?php if($fattura->isProForma()):?>
  <small>
    <p><?php echo __('La presente non costituisce fattura a norma dell\'articolo 21 del DTR numero 633/72 e non deve essere da voi annotata sul libro degli acquisti.')?></p>
    <p><?php echo __('A ricevimento del saldo sar&agrave; emessa regolare fattura.')?></p>
  </small>
<?php endif?>

<?php
  slot('sidebar');
    include_partial('invoice/sidebar');
  end_slot();
?>

<?php
  slot('infobox');
    include_partial('fattura/payment_forms', array('fattura' => $fattura));
  end_slot();
?>