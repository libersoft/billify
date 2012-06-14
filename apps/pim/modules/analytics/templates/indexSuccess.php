<?php
$sf_response->addJavascript('/sfHighchartsPlugin/js/highcharts.js');
?>

<div class="title">
  <h2><?php echo __('analytics')?></h2>
</div>

<div id="turnover" style="width: 50%; height: 300px; float: left; padding-top: 10px;"></div>

<div id="cashflow" style="width: 50%; height: 300px; float: left; padding-top: 10px;"></div>

<div id="monthly_turnover" style="width: 100%; height: 400px; clear: left; padding-top: 30px;"></div>

<div id="clients_graph" style="width: 100%; height: 400px; float: left; padding-top: 30px;"></div>
<div id="supplier_graph" style="width: 100%; height: 400px; clear: left; padding-top: 30px;"></div>

<script language="javascript">

var chart;
$(document).ready(function() {
  turnover = <?php echo $turnover_graph; ?>;
  monthly_turnover = <?php echo $monthly_turnover_graph; ?>;
  cashflow = <?php echo $cashflow_graph; ?>;
  clients_graph = <?php echo $clients_graph; ?>;
  supplier_graph = <?php echo $supplier_graph; ?>;
});
   
</script>

<?php slot('sidebar')?>
  <?php include_partial('main/sidebar') ?>
<?php end_slot('sidebar')?>
