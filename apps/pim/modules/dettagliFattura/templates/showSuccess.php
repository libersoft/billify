<div id="tabella_dettagli">
<?php include_partial('dettagliFattura/dettaglio',array('dettagli_fattura' => $dettagli_fattura,'viewSconto'=>$viewSconto,'fattura'=>$fattura));?>
</div>
<?php include_partial('fattura/calcola_fattura',array('fattura'=>$fattura))?>