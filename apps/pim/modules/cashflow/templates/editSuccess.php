<div class="title">
  <h2>
    <?php echo $form->getObject() instanceof Entrata ? __('Nuova entrata') : __('Nuova uscita') ?>
    <?php if ($sf_user->hasFlash('notice')): ?>
      <span class="notice">- <?php echo __($sf_user->getFlash('notice')); ?></span>
    <?php endif; ?>
  </h2>
</div>

<form action="<?php echo url_for($form->getRoute())?>" method="post">
  <table class="edit" width="100%">
    <?php echo $form; ?>
    <tr>
      <td colspan="2" align="right"><?php echo submit_tag('Salva')?></td>
    </tr>
  </table>
</form>

<?php
  slot('sidebar');
    include_partial('cashflow/sidebar');
  end_slot();
?>