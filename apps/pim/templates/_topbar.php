<?php if ($sf_user->isAuthenticated()) : ?>
<ul>
  <li <?php echo $sf_request->getParameter('module') == 'main'?'id="tray-active"':null?>><?php echo link_to(__('dashboard'), '@homepage')?></li>
  <li <?php echo $sf_request->getParameter('module') == 'contact'?'id="tray-active"':null?>><?php echo link_to(__('address book'), '@customer')?></li>
  <li <?php echo $sf_request->getParameter('module') == 'invoice' || $sf_request->getParameter('module') == 'fattura' ? 'id="tray-active"':null?>><?php echo link_to(__('invoices'), '@invoice')?></li>
  <li <?php echo $sf_request->getParameter('module') == 'cashflow'?'id="tray-active"':null?>><?php echo link_to(__('cash flow'), '@cashflow')?></li>
  <li <?php echo $sf_request->getParameter('module') == 'analytics'?'id="tray-active"':null?>><?php echo link_to(__('analytics'), '@analytics')?></li>
</ul>
<?php endif?>
