<div class="topbar-wrapper" style="z-index:5;">
<div class="topbar" data-dropdown="dropdown">
<div class="topbar-inner">
<div class="fill">
<div class="container">
<h3><a href="<?php echo url_for('@homepage')?>" title="[<?php echo __('go to homepage')?>]">Billify<?php //echo image_tag('impress/logo.gif'); ?></a></h3>
<?php if ($sf_user->isAuthenticated()) : ?>


<ul class="nav">
  <li <?php echo $sf_request->getParameter('module') == 'main'?'class="active"':null?>><?php echo link_to(__('dashboard'), '@homepage')?></li>
  <li data-dropdown="dropdown" class="dropdown <?php echo $sf_request->getParameter('module') == 'contact'?'active':null?>">
	<a class="dropdown-toggle" href="<?php echo url_for('@customer')?>"><?php echo __('address book'); ?></a>
	
	<ul class="dropdown-menu">
		<li><a href="<?php echo url_for('@customer')?>"><?php echo __('customers list'); ?></a></li>
		<li><a href="<?php echo url_for('@customer_create')?>"><?php echo __('add new customer'); ?></a></li>
		<li class="divider"></li>
		<li><a href="<?php echo url_for('@provider')?>"><?php echo __('providers list'); ?></a></li>
		<li><a href="<?php echo url_for('@provider_create')?>"><?php echo __('add new provider'); ?></a></li>
	</ul>
 </li>
  <li data-dropdown="dropdown" class="dropdown <?php echo $sf_request->getParameter('module') == 'invoice' || $sf_request->getParameter('module') == 'fattura' ? 'active':null?>">
	<a class="dropdown-toggle" href="#"><?php echo __('invoices'); ?></a>
	<ul class="dropdown-menu">
    	<li><?php echo link_to(__('sales invoices list'), '@invoice')?></li>
		<li><?php echo link_to(__('add new sales invoice'), '@invoice_create')?></li>
		<li class="divider"></li>
		<li><?php echo link_to(__('purchase invoices list'), '@invoice_purchase')?></li>
		<li><?php echo link_to(__('add new purchase'), '@invoice_purchase_create')?></li>
	</ul>
</li>
  

  <li data-dropdown="dropdown" class="dropdown <?php echo $sf_request->getParameter('module') == 'cashflow'?'active':null?>">
	<a class="dropdown-toggle" href="#"><?php echo __('cash flow'); ?></a>
    
    <ul class="dropdown-menu">
    <li><?php echo link_to(__('cash flow'), '@cashflow')?></li>
	<li><?php echo link_to(__('add new income'), 'document_sales_create')?></li>
 	<li><?php echo link_to(__('add new outcome'), 'document_purchase_create')?></li>
	</ul>
  </li>


<li <?php echo $sf_request->getParameter('module') == 'analytics'?'class="active"':null?>><?php echo link_to(__('analytics'), '@analytics')?></li>
</ul>

<?php echo include_partial('global/userbar') ?>
<?php endif?>


</div>
</div>
</div>
</div>
</div>
