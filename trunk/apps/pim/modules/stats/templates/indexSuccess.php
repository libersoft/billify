<?php

$anno_precedente = date('Y', time())-1;
$anno = date('Y', time());
$anno_successivo = date('Y', time())+1;

if($sf_request->hasParameter('year')){
  $anno_precedente = $sf_request->getParameter('year')-1;
  $anno = $sf_request->getParameter('year');
  $anno_successivo = $sf_request->getParameter('year')+1;
}

?>
<?php use_helper('DateForm');use_helper('SwfChart'); ?>

<div style="float: left; margin-right: 20px;">
<h2>Statistiche Annue</h2>

<?php echo swf_chart("/statistiche/fatturatoannuo", 400, 250);?>
</div>

<div style="float: left; margin-right: 20px;">
<h2>Statistiche Mensili <?php echo $anno_precedente ?></h2>

<?php echo swf_chart("/statistiche/fatturatomensile?year=".$anno_precedente, 400, 250);?>
</div>

<div style="float: left; margin-right: 20px;">
<h2>Statistiche Mensili <?php echo $anno ?></h2>

<?php echo swf_chart("/statistiche/fatturatomensile?year=".$anno, 400, 250);?>
</div>

<div style="float: left; margin-right: 20px;">
<h2>Statistiche Mensili <?php echo $anno_successivo ?></h2>

<?php echo swf_chart("/statistiche/fatturatomensile?year=".$anno_successivo, 400, 250);?>
</div>
