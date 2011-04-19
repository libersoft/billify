<?php include_stylesheets_for_form($form) ?>

<?php use_helper('Asset') ?>

<div class="title">
  <h2>
    <?php echo __('nuova fattura d\'acquisto')?>
    <?php if ($sf_user->hasFlash('notice')): ?>
      <span class="notice">- <?php echo __($sf_user->getFlash('notice')); ?></span>
    <?php endif; ?>
  </h2>
</div>
  
<form action="<?php echo url_for('@invoice_purchase_create')?>" method="post">
  <table class="edit" width="100%">
    <?php echo $form; ?>
    <tr>
      <td colspan="2" align="right"><?php echo submit_tag('Salva')?></td>
    </tr>
  </table>
</form>
<?php include_javascripts_for_form($form); ?>

<?php
  slot('sidebar');
    include_partial('invoice/sidebar');
  end_slot();
?>