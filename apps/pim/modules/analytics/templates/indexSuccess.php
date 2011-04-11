<?php

$sf_response->addJavascript('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
$sf_response->addJavascript('/sfHighchartsPlugin/js/highcharts.js');

?>

<div id="turnover" style="width: 100%; height: 500px;"></div>
<div id="monthly_turnover" style="width: 100%; height: 500px"></div>
<div id="cashflow" style="width: 100%; height: 500px"></div>

<script language="javascript">

var chart;
$(document).ready(function() {
  turnover = <?php echo $turnover_graph; ?>;
  monthly_turnover = <?php echo $monthly_turnover_graph; ?>;
  cashflow = <?php echo $cashflow_graph; ?>;
});
   
</script>