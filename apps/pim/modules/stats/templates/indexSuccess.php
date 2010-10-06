<?php use_helper('SwfChart'); ?>

<div class="chart">
  <div class="title">
    <h2>Statistiche Annue</h2>
  </div>
  <?php echo swf_chart(url_for('statistiche/fatturatoannuo', true));?>
</div>


<div class="chart">
  <div class="title">
    <h2>Statistiche Mensili <?php echo $anno_precedente ?></h2>
  </div>
  <?php echo swf_chart(url_for('statistiche/fatturatomensile?year='.$anno_precedente, true));?>
</div>

<div class="chart">
  <div class="title">
    <h2>Statistiche Mensili <?php echo $anno ?></h2>
  </div>  
  <?php echo swf_chart(url_for('statistiche/fatturatomensile?year='.$anno, true));?>
</div>

<div class="chart">
  <div class="title">
    <h2>Statistiche Mensili <?php echo $anno_successivo ?></h2>
  </div>
  <?php echo swf_chart(url_for('statistiche/fatturatomensile?year='.$anno_successivo, true));?>
</div>

<?php
  slot('sidebar');
    include_partial('invoice/sidebar');
  end_slot();
?>