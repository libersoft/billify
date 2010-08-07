<div id="contatti">
<p>
<?php echo stripcslashes($contact->getVia())?><br/>
<?php echo $contact->getCap() ?> <?php echo $contact->getCitta() ?> (<?php echo $contact->getProvincia() ?>)<br/>
Tel. <?php echo $contact->getTelefono() ?> / Fax. <?php echo $contact->getFax() ?><br/><br/>

<strong><?php echo __('Referent')?>:</strong> <?php echo $contact->getContatto() ?><br/>
<strong><?php echo __('E-Mail')?>:</strong> <?php echo $contact->getEmail() ?><br/>

<?php if($contact->getPiva()):?>
  <strong>P.IVA:</strong> <?php echo $contact->getPiva()?>
<?php elseif($contact->getCf()): ?>
  <strong>C.F:</strong> <?php echo $contact->getCf()?>
<?php endif ?>
</p>

</div>