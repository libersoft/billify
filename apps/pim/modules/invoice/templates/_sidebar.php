<div class="title">
   <h4><?php echo __('sales invoices')?></h4>
</div>

<ul class="ul-list nomb">
  <li>+ <?php echo link_to(__('sales invoices list'), '@invoice')?></li>
  <li>+ <?php echo link_to(__('add new sales invoice'), '@invoice_create')?></li>
</ul>

<div class="title">
   <h4><?php echo __('purchase invoices')?></h4>
</div>

<ul class="ul-list nomb">
  <li>+ <?php echo link_to(__('purchase invoices list'), '@invoice_purchase')?></li>
  <li>+ <?php echo link_to(__('add new purchase'), '@invoice_purchase_create')?></li>
</ul>