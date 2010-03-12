<ul>
  <li><?php echo link_to('Gestione Fattura','fattura/show?id='.$id)?>
  <ul>
    <li><?php echo link_to('Cliente','cliente/index')?>
    <ul>
      <li><?php echo link_to('Nuovo','cliente/edit')?></li>
      <?php if(isset($cliente)):?>
        <li><?php echo link_to('Anagrafica','cliente/show?id='.$cliente->getID())?></li>
        <li><?php echo link_to('Modifica','cliente/edit?id='.$cliente->getID())?></li>
        <li><?php echo link_to('Elimina','cliente/delete?id='.$cliente->getID(), 'post=true&confirm=Sei sicuro di eliminare il cliente '.$cliente->toString().'?\n(Eliminando il cliente verranno eliminate anche tutte le corrispettive fatture)') ?></li>
      <?php endif?>
    </ul>
    </li>

		<li><?php echo link_to('Modifica','fattura/edit?id='.$fattura->getID().'&id_cliente='.$fattura->getClienteID())?></li>
		<li><?php echo link_to('Elimina','fattura/delete?id='.$fattura->getID(), array('title'=>'Elimina la fattura','confirm' => 'Sei Sicuro di eliminare la Fattura N.'.$fattura->getNumFattura().' del '.$fattura->getData('d/m/y').'?'))?></li>
		<li><a href="#">Segna come &raquo;</a>
		<ul>
      <li><?php echo link_to('Non Inviata','fattura/stato?stato=n&id='.$fattura->getID(),array('title'=>'Segna come non inviata'))?></li>
      <li><?php echo link_to_function('Inviata',visual_effect('fade','data_stato_rifiutata',array('duration'=>0)).visual_effect('fade','data_stato_pagata',array('duration'=>0)).visual_effect('appear','data_stato_inviata',array('duration'=>0.5)),array('title'=>'Segna come inviata'))?></li>
      <li><?php echo link_to_function('Pagata',visual_effect('fade','data_stato_rifiutata',array('duration'=>0)).visual_effect('fade','data_stato_inviata',array('duration'=>0)).visual_effect('appear','data_stato_pagata',array('duration'=>0.5)),array('title'=>'Segna come pagata'))?></li>
      <li><?php echo link_to_function('Rifiutata',visual_effect('fade','data_stato_pagata',array('duration'=>0)).visual_effect('fade','data_stato_inviata',array('duration'=>0)).visual_effect('appear','data_stato_rifiutata',array('duration'=>0.5)),array('title'=>'Segna come rifiutata'))?></li>
    </ul>
		</li>
		<li><?php echo link_to('Crea PDF','fattura/export?id='.$fattura->getID())?></li>
  </ul>
</li>
</ul>