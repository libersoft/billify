<?php

$sf_response->addJavascript('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js');
$sf_response->addJavascript('/sfHighchartsPlugin/js/highcharts.js');

?>

<div id="pie" style="width: 75%; height: 200px; float: right; padding: 10px;"></div>

<script language="javascript">

var chart;
$(document).ready(function() {
  pie = <?php echo $pie_graph; ?>;
});
   
</script>

