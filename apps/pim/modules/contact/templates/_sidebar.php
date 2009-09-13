<div class="title">
   <h4><?php echo __('customers address book')?></h4>
</div>

<ul class="ul-list nomb">
  <li>+ <?php echo link_to(__('customers list'), '@customer')?></li>
  <li>+ <?php echo link_to(__('add new customer'), '@customer_create')?></li>
</ul>

<div class="title">
   <h4><?php echo __('providers address book')?></h4>
</div>

<ul class="ul-list nomb">
  <li>+ <?php echo link_to(__('providers list'), '@provider')?></li>
  <li>+ <?php echo link_to(__('add new provider'), '@provider_create')?></li>
</ul>