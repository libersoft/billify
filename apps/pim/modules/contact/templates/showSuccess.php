<?php include_component('analytics', 'contact', array('contact' => $contact, 'total' => $totale, 'year' => $year)); ?>

<div class="title">
    <h2><?php echo $contact ?></h2>
    
    <?php if ($sf_user->hasFlash('notice')): ?>
      <span class="notice">- <?php echo __($sf_user->getFlash('notice')); ?></span>
    <?php endif; ?>
</div>

<?php include_partial('contact/info', array('contact' => $contact)); ?>

<div class="title">    
    <h2><?php echo __('Invoices list'); ?></h2>
</div>

<form method="get">
    <select name="year" onchange="this.form.submit()">
      <option value="all"><?php echo __('All')?></option>
    <?php for($i = date('Y'); $i >= date('Y') - 4; $i--): ?>
        <option value="<?php echo $i?>" <?php if($i == $year):?>selected="selected"<?php endif?>><?php echo $i ?></option>
    <?php endfor; ?>
    </select>
</form>

<table class="fatture" width="100%" style="margin-bottom: 5px;">
<thead>
<tr>
  <th><?php echo __('n.')?></th>
  <th><?php echo __('data')?></th>
  <th><?php echo __('totale')?></th>
  <th><?php echo __('stato')?></th>
  <th><?php echo __('ritardo')?></th>
  <th></th>
</tr>
</thead>
<tbody>
<?php foreach($invoices as $invoice): $invoice->calcolaFattura(); ?>
  <tr>
    <td align="center"><?php echo link_to($invoice->getShortName(), $invoice->getRoutingRule().'?id='.$invoice->getId()) ?></td>
    <td align="center"><?php echo $invoice->getData('d/m/Y') ?></td>
    <td align="right"><?php echo format_currency($invoice->getTotale(), '&euro;') ?></td>
    <td style="font-weight: bold; background-color: <?php echo $invoice->getColorStato()?>; color: <?php echo $invoice->getFontColorStato()?>"><?php echo $invoice->getStato(true)?></td>
    <td align="center" class="<?php echo $invoice->checkInRitardo()?'red':'none'?>"><?php echo $invoice->checkInRitardo()?'<strong>si</strong>':'no'?></td>
    <td><a href="<?php echo url_for('fattura/export?id='.$invoice->getID()); ?>" target="_blank"><img src="/images/icons/file_acrobat.gif" alt="<?php echo __('esporta in pdf'); ?>" /></a></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php slot('sidebar'); ?>
  <div class="total">
    <span title="il totale è calcolato al netto di IVA"><?php echo format_currency($totale, '&euro;') ?></span>
    <div class="stimato"><?php echo __('previsione su pro-forma:'); ?> <strong><?php echo format_currency($totale_proforma, '&euro;') ?></strong></div>
  </div>

  <div class="title">
    <h4><?php echo __('actions')?></h4>
  </div>

  <ul class="ul-list nomb">
    <li>+ <?php echo link_to(__('edit'),'@contact_edit?id='.$contact->getID())?></li>
    <li>+ <?php echo link_to(__('delete'), '@contact_delete?id='.$contact->getId(), 'post=true&confirm='.__('vuoi cancellare questo contatto?').' title=delete') ?></li>
    <?php if ($contact->getClassKey() == 2): ?>      
      <li>+ <?php echo link_to(__('new invoice'),'@invoice_purchase_create?fornitore='.$contact->getId()); ?></li>
    <?php else: ?>
      <li>+ <?php echo link_to(__('new invoice'),'@invoice_create_for_client?id_cliente='.$contact->getId()); ?></li>
    <?php endif; ?>
  </ul>
<?php
    include_partial('contact/sidebar');
    end_slot();
?>
