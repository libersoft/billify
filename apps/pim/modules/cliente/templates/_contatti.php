<div id="contatti">
<?php if($cliente->getVia() && $cliente->getCap() && $cliente->getCitta() && $cliente->getProvincia()):?>
<p><?php echo stripcslashes($cliente->getVia())?> -
<?php echo $cliente->getCap()?> <?php echo $cliente->getCitta()?> (<?php echo $cliente->getProvincia()?>)
<?php echo $cliente->getTelefono()!=""?'- Tel. '.$cliente->getTelefono():''?>
<?php echo $cliente->getFax()!=""?'- Fax. '.$cliente->getFax():''?>
</p>
<?php if($cliente->getPiva()):?>
<p>P.IVA: <?php echo $cliente->getPiva()?></p><?php endif ?>
<?php if($cliente->getCf()):?>
<p>C.F: <?php echo $cliente->getCf()?></p>
<?php endif ?>

<?php else:?>
<p>Indirizzo del cliente incompleto, <?php echo link_to('compila tutti i dati','cliente/edit?id='.$cliente->getId())?>.</p>
<?php endif?>
</div>