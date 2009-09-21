<?php
 
function pdf($html,$size,$orientation,$output_file)
{
	require_once(sfConfig::get('sf_lib_dir') .'/vendor/dompdf/dompdf_config.inc.php');
	$dompdf = new DOMPDF();
	$dompdf->set_paper('a4','portrait');
  	$dompdf->load_html($html);
	$dompdf->render();
 	$dompdf->stream("$output_file.pdf");
 	exit();
}
 
?>
