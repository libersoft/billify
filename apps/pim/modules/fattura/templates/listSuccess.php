<div id="lista_fatture">
<?php include_partial('fattura/filter_success',array('anni_fatture'=>$anni_fatture,
													 'cliente' => $cliente,
													 'anno'=>$anno,
													 'stato'=>$stato,
													 'tipo' => $tipo,
													 'fatture'=>$fatture_pager,
													 'fatture_results'=>$fatture_pager->getResults(),
													 'form_action'=>'fattura/listAgain?',
													 'trimestre'=>$trimestre,
													 'fatture_iva_da_pagare'=>$fatture_iva_da_pagare,
													 'customer'=>true,
													 'copia'=>true,
													 'checkbox'=>true,
													 'div_to_update'=>'lista_fatture',
													 'tags'=>$tags,
													 'tag_selected'=>$tag));?>
</div>

<?php
  slot('sidebar');
    include_partial('invoice/sidebar');
  end_slot();
?>