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
      <td colspan="2" align="right">
        <?php if (!$form->getObject()->isNew()):?>
          <?php echo link_to(__('Elimina'), '@document_remove?id='.$form->getObject()->getId(), array('confirm' => 'Vuoi veramente eliminare questo documento?'));?>
        <?php endif;?>
        <?php echo submit_tag(__('Salva'))?>
      </td>
    </tr>
  </table>
</form>

<?php
  slot('sidebar');
    include_partial('cashflow/sidebar');
  end_slot();
?>